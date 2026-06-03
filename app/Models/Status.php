<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    public function status(): HasMany
    {
        return $this->hasMany(PermohonanInformasi::class);
    }

    public function statuskeberatan(): HasMany
    {
        return $this->hasMany(PengajuanKeberatan::class);
    }
}
