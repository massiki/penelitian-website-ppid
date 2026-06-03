<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InformasiPublikDetail extends Model
{
    use HasFactory;

    protected $table = 'informasi_publik_details';

    // protected $with = ['infopub'];

    protected $guarded = ['id'];

    // function di bawah masih null
    public function infopub(): BelongsTo
    {
        return $this->belongsTo(InformasiPublik::class, 'id');
    }
}
