<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PermohonanInformasi extends Model
{
    use HasFactory;

    protected $table = 'permohonan_informasi';

    protected $with = ['status', 'memperoleh', 'mendapat'];

    protected $guarded = ['id'];
    
    // public function memperolehinformasi(): BelongsTo
    // {
    //     return $this->belongsTo(MemperolehInformasi::class, 'id_memperoleh_informasi');
    // }

    // public function mendapatkansalinaninformasi(): BelongsTo
    // {
    //     return $this->belongsTo(MendapatkanSalinanInformasi::class, 'id_mendapatkan_salinan_informasi');
    // }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function memperoleh(): BelongsTo
    {
        return $this->belongsTo(Reference::class, 'memperoleh_informasi_id');
    }
    
    public function mendapat(): BelongsTo
    {
        return $this->belongsTo(Reference::class, 'mendapatkan_salinan_informasi_id');
    }

    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class);
    }
}
