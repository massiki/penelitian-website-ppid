<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MemperolehInformasi extends Model
{
    use HasFactory;

    protected $table = 'memperoleh_informasi';

    public function permohonaninformasi(): HasMany
    {
        return $this->hasMany(PermohonanInformasi::class);
    }

}
