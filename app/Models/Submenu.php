<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submenu extends Model
{
    use HasFactory;

    protected $table = 'submenus';

    // protected $with = 'menu';

    protected $guarded = ['id'];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
