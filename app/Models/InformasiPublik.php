<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InformasiPublik extends Model
{
    use HasFactory;

    protected $table = 'informasi_publik';

    protected $guarded = ['id'];

    protected $with = ['informasi', 'penyimpanan','infopubdet'];

    public function informasi(): BelongsTo
    {
        return $this->belongsTo(Reference::class, 'kategori_informasi_id');
    }

    public function penyimpanan(): BelongsTo
    {
        return $this->belongsTo(Reference::class, 'waktu_penyimpanan_id');
    }

    public function infopubdet(): HasMany
    {
        return $this->hasMany(InformasiPublikDetail::class);
    }
}
