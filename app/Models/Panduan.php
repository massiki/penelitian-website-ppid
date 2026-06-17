<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panduan extends Model
{
  use HasFactory;

  protected $table = 'panduan';

  protected $guarded = ['id'];

  protected function casts(): array
  {
    return [
      'persyaratan' => 'array',
      'langkah' => 'array',
      'status_list' => 'array',
      'is_active' => 'boolean',
    ];
  }
}
