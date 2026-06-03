<?php

namespace App\Http\Controllers;

use App\Models\BackgroundImage;
use App\Models\Berita;
use App\Models\Card;
use App\Models\InfoBanner;
use App\Models\InfoService;
use App\Models\PermohonanInformasi;
use App\Models\PengajuanKeberatan;
use App\Models\InformasiPublik;
use App\Models\QuestAnswer;
use App\Models\Rating;
use App\Models\Reference;
use App\Models\Video;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // permohonan informasi
        $information = PermohonanInformasi::when(request('year'), function ($query) {
            $query->whereYear('created_at', request('year'));
        })->when(request('month'), function ($query) {
            $query->whereMonth('created_at', request('month'));
        })->get();

        // pengajuan keberatan
        $submission = PengajuanKeberatan::when(request('year'), function ($query) {
            $query->whereYear('created_at', request('year'));
        })->when(request('month'), function ($query) {
            $query->whereMonth('created_at', request('month'));
        })->get();
        
        // informasi publik
        $public = InformasiPublik::when(request('year'), function ($query) {
            $query->whereYear('created_at', request('year'));
        })->when(request('month'), function ($query) {
            $query->whereMonth('created_at', request('month'));
        })->get();

        // rata rata
        $ratings = Rating::when(request('year'), function ($query) {
            $query->whereYear('created_at', request('year'));
        })->when(request('month'), function ($query) {
            $query->whereMonth('created_at', request('month'));
        })->latest()->get();
        $totalRatings = $ratings->sum('star');
        $averageRating = round($totalRatings / Rating::count(), 2);

        // ulasan terbaru
        $newComments = $ratings->take(10);

        // jumlah data status pada permohonan dan pengajuan
        $sendPer = $information->where('status_id', 2)->count();
        $processPer = $information->where('status_id', 3)->count();
        $rejectPer = $information->where('status_id', 0)->count();
        $acceptPer = $information->where('status_id', 1)->count();

        $sendPeng = $submission->where('status_id', 2)->count();
        $processPeng = $submission->where('status_id', 3)->count();
        $rejectPeng = $submission->where('status_id', 0)->count();
        $acceptPeng = $submission->where('status_id', 1)->count();

        // permohonan dan pengajuan grafik
        $year = request('year', date('Y'));
        if (request('month')) {
            for ($i = 1; $i <= 12; $i++) {
                $month = 0;
                // permohonan informasi
                if (request('month') == $i) {
                    $month = request('month');
                }
                $permohonanInforamsiMonth = PermohonanInformasi::whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->count();
                $arrayPermohonanInformasiMonth[$i] = $permohonanInforamsiMonth;

                // pengajuan keberatan grafik
                $pengajuanKeberatanMonth = PengajuanKeberatan::whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->count();
                $arrayPengajuanKeberatanMonth[$i] = $pengajuanKeberatanMonth; 
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                // permohonan informasi grafik
                $permohonanInforamsiMonth = PermohonanInformasi::whereMonth('created_at', $i)
                    ->whereYear('created_at', $year)
                    ->count();
                $arrayPermohonanInformasiMonth[$i] = $permohonanInforamsiMonth;

                // pengajuan keberatan grafik
                $pengajuanKeberatanMonth = PengajuanKeberatan::whereMonth('created_at', $i)
                    ->whereYear('created_at', $year)
                    ->count();
                $arrayPengajuanKeberatanMonth[$i] = $pengajuanKeberatanMonth; 
            }
        }


        // informasi publik grafik
        $referencesInfo = Reference::where('slug', 'informasi');
        $referencesInformasi = $referencesInfo->get();
        $referencesInformasiCount = $referencesInfo->count();
        for ($i=0; $i < $referencesInformasiCount; $i++) { 
            $InformasiPublikCount = $public->where('kategori_informasi_id', $referencesInformasi->skip($i)->first()->id)->count();
            $arrayInformasiPublik[$i] = $InformasiPublikCount;
        }

        // permohonan informasi berdasarkan salinan
        $referencesDapat = Reference::where('slug', 'mendapat');
        $referencesMedapat = $referencesDapat->get();
        $referencesMedapatCount = $referencesDapat->count();
        for ($i=0; $i < $referencesMedapatCount; $i++) { 
            $permohonanSalinanCount = $information->where('mendapatkan_salinan_informasi_id', $referencesMedapat->skip($i)->first()->id)->count();
            
            if ($information->count() > 0) {
                $arrayPermohonanSalinan[$i] = round($permohonanSalinanCount / $information->count() * 100, 2);
            } else {
                $arrayPermohonanSalinan[$i] = 0;
            }
        }

        return view('admin.dashboard', compact('information', 'submission', 'public', 'averageRating', 'newComments', 'sendPer', 
            'processPer', 'rejectPer', 'acceptPer', 'sendPeng', 'processPeng', 'rejectPeng', 'acceptPeng','referencesInformasi', 'arrayInformasiPublik', 
            'referencesInformasiCount', 'arrayPermohonanInformasiMonth', 'arrayPengajuanKeberatanMonth', 'referencesMedapatCount','arrayPermohonanSalinan'));
    }

    public function home()
    {
        $ratings = Rating::where('status_post', 2)->take(6)->latest()->get();
        $cards = Card::take(4)->latest()->get();
        $video = Video::latest()->first();
        $news = Berita::take(3)->latest()->get();
        $infoServices = InfoService::take(2)->latest()->get();
        $thumbnail = BackgroundImage::where('slug', 'thumbnail')->take(2)->get();
        $questAnswers = BackgroundImage::where('slug', 'q&a')->first();
        $quest = QuestAnswer::all();
        return view('user.index', compact('ratings', 'cards', 'video', 'news', 'infoServices', 'thumbnail', 'questAnswers', 'quest'));
    }
}
