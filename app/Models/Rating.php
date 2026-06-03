<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $with = ['pemohon'];

    protected $guarded = ['id'];

    public function pemohon(): BelongsTo
    {
        return $this->belongsTo(PermohonanInformasi::class, 'permohonan_informasi_id');
    }

}
