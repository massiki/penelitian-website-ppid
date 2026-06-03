<?php

namespace App\Http\Controllers;

use App\Mail\AcceptPengajuan;
use App\Mail\Information;
use App\Mail\RejectPengajuan;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {;
        $informations = PermohonanInformasi::latest()
            ->where('status_id', 1)
            ->whereNotNull('file_acc_permohonan');
        $submissions = PengajuanKeberatan::latest()
            ->whereIn('status_id', [0, 1]);
        if (request('cari')) {
            $informations = $informations->where('nama', 'like', '%' . request('cari') . '%'); 
            $submissions = $submissions->where('nama', 'like', '%' . request('cari') . '%'); 
        }
        $informations = $informations->paginate(5); 
        $submissions = $submissions->paginate(5); 
        return view('admin.menuUtama.email.index', compact('informations', 'submissions'));
    }

    public function send(PermohonanInformasi $permohonanInformasi)
    {
        $data = $permohonanInformasi;
        $data->update([
            'status_pengiriman' => true
        ]);
        Mail::to($data->email)->send(new Information($data));
        return redirect()->back()->with('success', 'berhasil dikirim');
    }

    public function rejectPengajuan(PengajuanKeberatan $pengajuanKeberatan)
    {
        $data = $pengajuanKeberatan;
        $pengajuanKeberatan->update([
            'status_pengiriman' => 1
        ]);

        Mail::to($pengajuanKeberatan->email)->send(new RejectPengajuan($data));
        return redirect()->back()->with('success', 'berhasil dikirim');
    }

    public function acceptPengajuan(PengajuanKeberatan $pengajuanKeberatan)
    {
        $data = $pengajuanKeberatan;
        $pengajuanKeberatan->update([
            'status_pengiriman' => 1
        ]);

        Mail::to($pengajuanKeberatan->email)->send(new AcceptPengajuan($data));
        return redirect()->back()->with('success', 'berhasil dikirim');
    }
}
