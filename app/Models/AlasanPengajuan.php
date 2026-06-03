<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlasanPengajuan extends Model
{
    use HasFactory;

    protected $table = 'alasan_pengajuan';

    public function alasan(): HasMany
    {
        return $this->hasMany(PengajuanKeberatan::class, 'id_alasan_pengajuan');
    }
}
