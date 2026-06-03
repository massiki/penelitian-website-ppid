<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemperolehInformasi;
use App\Models\MendapatkanSalinanInformasi;
use App\Models\PermohonanInformasi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Events\PermohonanInformasiEvent;
use App\Mail\NotifMengambil;
use App\Mail\NotifTolakPermohonan;
use App\Models\Rating;
use App\Models\Reference;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use ParagonIE\Sodium\Compat;

class PermohonanInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $information = PermohonanInformasi::latest();
        if(request('cari')){
            $information = $information->where('nama', 'like', '%'.request('cari').'%');
        }
        $information = $information->paginate(5);

        return view('admin.menuUtama.permohonanInformasi.index', compact('information'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getInformation = Reference::where('slug', 'memperoleh')->get();
        $copyInformation = Reference::where('slug', 'mendapat')->get();
        return view('user.formulir.form-permohonan', compact('getInformation', 'copyInformation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'no_telepon' => 'required|numeric',
            'pekerjaan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'nik' => 'required|digits:16|numeric',
            'file_ktp' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'informasi_yang_dibutuhkan' => 'required',
            'alasan_penggunaan_informasi' => 'required',
            'memperoleh_informasi_id' => 'required',
            'mendapatkan_salinan_informasi_id' => 'required',
            'captcha' => 'required|captcha',
        ],$this->feedback_validate);

        $ktp = $request->file('file_ktp');
        $file_org =  $ktp->getClientOriginalName();
        $randomName = Str::random(5);
        $file_name = $randomName . '-' . $file_org;
        $file_path = $ktp->storeAs('ktp', $file_name, 'public');

        PermohonanInformasi::create(array_merge($request->except(['file_ktp', 'captcha']), ['file_ktp' => $file_path]));

        return redirect('/')->with([
            'success' => 'Permohonan informasi anda berhasil terkirim',
            'email' => $request->email
        ]);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(PermohonanInformasi $permohonanInformasi)
    {
        if ($permohonanInformasi->status_id == 2 && Auth::user()->role != 'operator') {
            $id = PermohonanInformasi::find($permohonanInformasi->id);
            $id->update([
                'status_id' => '3'
            ]);
            $permohonanInformasi->refresh();
        }
        return view('admin.menuUtama.permohonanInformasi.show', ['item' => $permohonanInformasi]);
    }

    public function reject(Request $request, PermohonanInformasi $permohonanInformasi)
    {
        $data = $permohonanInformasi;
        $request->validate([
            'pesan_ditolak' => 'required',
        ],$this->feedback_validate);

        // dd($request);

        $permohonanInformasi->update([
            'status_id' => '0',
            'pesan_ditolak' => $request->pesan_ditolak
        ]);

        Mail::to($permohonanInformasi->email)->send(new NotifTolakPermohonan($data, $request));

        return redirect('/permohonan_informasi/'.$permohonanInformasi->id)->with('success', 'Permohonan berhasil ditolak');
    }
    public function accept(PermohonanInformasi $permohonanInformasi)
    {
        $permohonanInformasi->update([
            'status_id' => '1',
        ]);

        return redirect('/permohonan_informasi/'.$permohonanInformasi->id)->with('success', 'Permohonan berhasil diterima');
    }

    public function upload(Request $request, PermohonanInformasi $permohonanInformasi)
    {
        $request->validate([
            'file_acc_permohonan' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ],$this->feedback_validate);

        $file = $request->file('file_acc_permohonan');
        $file_org =  $file->getClientOriginalName();
        $randomName = Str::random(5);
        $file_name = $randomName . '-' . $file_org;
        $file_path = $file->storeAs('file_acc', $file_name, 'public');

        // dd($permohonanInformasi->mendapatkan_salinan_informasi_id);

        $permohonanInformasi->update([
            'file_acc_permohonan' => $file_path
        ]);

        if ($permohonanInformasi->mendapatkan_salinan_informasi_id == 4) {
            $data = $permohonanInformasi;
            Mail::to($permohonanInformasi->email)->send(new NotifMengambil($data));
        }

        return redirect('/permohonan_informasi/'.$permohonanInformasi->id)->with('success', 'File berhasil diupload');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermohonanInformasi $permohonanInformasi)
    {
        $getInformation = Reference::where('slug', 'memperoleh')->get();
        $copyInformation = Reference::where('slug', 'mendapat')->get();
       return view('admin.menuUtama.permohonanInformasi.edit', compact('getInformation', 'copyInformation', 'permohonanInformasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PermohonanInformasi $permohonanInformasi)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'no_telepon' => 'required|numeric',
            'pekerjaan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'nik' => 'required|digits:16|numeric',
            'informasi_yang_dibutuhkan' => 'required',
            'alasan_penggunaan_informasi' => 'required',
            'file_ktp' => 'file|mimes:jpg,png,jpeg,pdf|max:2048',
            'memperoleh_informasi_id' => 'required',
            'mendapatkan_salinan_informasi_id' => 'required',
        ],$this->feedback_validate);

        if ($request->file_ktp) {
            $ktp = $request->file('file_ktp');
            $file_org =  $ktp->getClientOriginalName();
            $randomName = Str::random(5);
            $file_name = $randomName . '-' . $file_org;
            $file_path = $ktp->storeAs('ktp', $file_name, 'public');
            Storage::disk('public')->delete($permohonanInformasi->file_ktp);
        } else {
            $file_path = $permohonanInformasi->file_ktp;
        }

        $permohonanInformasi->update(array_merge($request->except('file_ktp'), ['file_ktp' => $file_path]));

        return redirect('/permohonan_informasi')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PermohonanInformasi $permohonanInformasi)
    {
        $file_name = $permohonanInformasi->file_ktp;
        if ($file_name && Storage::disk('public')->exists($file_name)) {
            Storage::disk('public')->delete($file_name);
        }
        $permohonanInformasi->delete();
        return redirect('/permohonan_informasi')->with('success', 'Data berhasil dihapus');
    }

    public function riwayat()
    {
        $information = [];
        if (request('email')) {
            $information = PermohonanInformasi::where('email', request('email'))->latest()->paginate(5);
        }
  
        return view('user.formulir.riwayat-user', compact('information'));
    }

    public function form(string $id)
    {
        return view('user.verifikasidata.index', compact('id'));
    }

    public function get(Request $request, PermohonanInformasi $permohonanInformasi)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|max:255',
            'nik' => 'required|digits:16|numeric',
        ],$this->feedback_validate);

        if ($request->nik == $permohonanInformasi->nik && $request->email == $permohonanInformasi->email) {
            return redirect('/permohonan-informasi/'.$permohonanInformasi->id.'/download');
        } else {
            return redirect()->back()->with('failed', 'NIK dan Email salah');
        }
    }

    public function download(string $id)
    {
        $information = PermohonanInformasi::where('id', $id)->select(['id','file_acc_permohonan'])->first();
        $rating = Rating::where('permohonan_informasi_id', $information->id)->first();
        return view('user.download.permohonan', compact('information', 'rating'));
    }

    public function rating(Request $request, Rating $rating)
    {
        $request->validate([
            'star' => 'required|numeric',
            'comment' => 'required|max:255'
        ], $this->feedback_validate);

        $rating->create(array_merge($request->except('id'), ['permohonan_informasi_id' => $request->id]));

        return redirect()->back()->with('success', 'Terima kasih atas ulasannya');
    }    
}