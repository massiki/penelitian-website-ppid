<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MendapatkanSalinanInformasi extends Model
{
    use HasFactory;

    protected $table = 'mendapatkan_salinan_informasi';

    public function MendapatkanSalinanInformasi(): HasMany
    {
        return $this->hasMany(PermohonanInformasi::class);
    }
}
