<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\Reference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class PengajuanKeberatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submission = PengajuanKeberatan::latest();
        if (request('cari')) {
            $submission = $submission->where('nama', 'like', '%' . request('cari') . '%');
        }
        $submission = $submission->paginate(5);
        return view('admin.menuUtama.pengajuanKeberatan.index', compact('submission'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reason = Reference::where('slug', 'pengajuan')->get();
        $applicant = request('pemohon') ? PermohonanInformasi::where('id', Crypt::decrypt(request('pemohon')))->first() : [];
        return view('user.formulir.form-pengajuan', compact('reason', 'applicant'));
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
            'alasan_pengajuan_id' => 'required',
            'tujuan_penggunaan_informasi' => 'required',
            'captcha' => 'required|captcha',
        ],$this->feedback_validate);

        $data = $request->except('captcha');
        PengajuanKeberatan::create($data);

        return redirect('/')->with('success', 'Pengajuan keberatan anda berhasil dikirim, balasan akan dikirim melalui email');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanKeberatan $pengajuanKeberatan)
    {
        if ($pengajuanKeberatan->status_id == 2 && Auth::user()->role != 'operator') {
            $pengajuanKeberatan->update([
                'status_id' => '3'
            ]);
            $pengajuanKeberatan->refresh();
        }
        return view('admin.menuUtama.pengajuanKeberatan.show', [
            'item' => $pengajuanKeberatan
        ]);
    }

    public function reject(Request $request, PengajuanKeberatan $pengajuanKeberatan)
    {
        // dd($request);
        $pengajuanKeberatan->update([
            'pesan_ditolak' => $request->pesan_ditolak,
            'status_id' => 0,
        ]);

        return redirect('/pengajuan_keberatan/' . $pengajuanKeberatan->id)->with('success', 'Pengajuan keberatan berhasil ditolak');
    }

    public function accept(Request $request, PengajuanKeberatan $pengajuanKeberatan)
    {
        $pengajuanKeberatan->update([
            'status_id' => '1',
        ]);

        return redirect('/pengajuan_keberatan/' . $pengajuanKeberatan->id)->with('success', 'Pengajuan keberatan berhasil diterima');
    }

    public function upload(Request $request, PengajuanKeberatan $pengajuanKeberatan)
    {
        $request->validate([
            'file_acc_pengajuan' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ],$this->feedback_validate);

        $file = $request->file('file_acc_pengajuan');
        $file_org =  $file->getClientOriginalName();
        $randomName = Str::random(5);
        $file_name = $randomName . '-' . $file_org;
        $file_path = $file->storeAs('file_acc', $file_name, 'public');

        $pengajuanKeberatan->update([
            'file_acc_pengajuan' => $file_path
        ]);

        return redirect('/pengajuan_keberatan/' . $pengajuanKeberatan->id)->with('success', 'Pengajuan keberatan berhasil diterima');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanKeberatan $pengajuanKeberatan)
    {
        $reason = Reference::where('slug', 'pengajuan')->get();
        return view('admin.menuUtama.pengajuanKeberatan.edit', compact('reason', 'pengajuanKeberatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanKeberatan $pengajuanKeberatan)
    {
        $data = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns,rfc|max:255',
            'no_telepon' => 'required|numeric',
            'pekerjaan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'alasan_pengajuan_id' => 'required',
            'tujuan_penggunaan_informasi' => 'required|max:255',
        ],$this->feedback_validate);

        $pengajuanKeberatan->update($data);

        return redirect('/pengajuan_keberatan')->with('success', 'Pengajuan keberatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanKeberatan $pengajuanKeberatan)
    {
        $pengajuanKeberatan->delete();
        return redirect('/pengajuan_keberatan')->with('success', 'Pengajuan keberatan berhasil dihapus');
    }

    public function download(string $id)
    {
        $information = PengajuanKeberatan::where('id', $id)->select(['id','file_acc_pengajuan'])->first();
        return view('user.download.pengajuan', compact('information'));
    }
}
