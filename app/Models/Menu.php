<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $with = ['child'];

    protected $guarded = ['id'];

    public function child(): HasMany
    {
        return $this->hasMany(Submenu::class);
    }
}
