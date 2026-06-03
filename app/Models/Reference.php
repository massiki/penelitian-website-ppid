<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reference extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['pemohon'];

    public function pemohon(): HasMany
    {
        return $this->hasMany(PermohonanInformasi::class, 'memperoleh_informasi_id');
    }

    public function pengaju(): HasMany
    {
        return $this->hasMany(PengajuanKeberatan::class, 'alasan_pengajuan_id');
    }


    public function informasi(): HasMany
    {
        return $this->hasMany(InformasiPublik::class, 'kategori_informasi_id');
    }
}
