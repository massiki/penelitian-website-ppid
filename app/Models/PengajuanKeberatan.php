<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanKeberatan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_keberatan';

    protected $with = ['status', 'pengajuan'];

    protected $guarded = ['id'];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Reference::class, 'alasan_pengajuan_id');
    }

    // public function alasan(): BelongsTo
    // {
    //     return $this->belongsTo(AlasanPengajuan::class, 'id_alasan_pengajuan');
    // }
}
