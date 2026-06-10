<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

abstract class Controller
{
    public $seconds = 60;

    public $feedback_validate = [
        'required' => 'Data harus diisi.',
        'max' => 'Karakter :attribute maksimal :max.',
        'file' => ':attribute harus berupa file jpg, png, jpeg, atau pdf.',
        'exists' => ':attribute tidak valid.',
        'mimes' => ':attribute harus berupa file jpg, png, jpeg, atau pdf.',
        'numeric' => ':attribute harus berupa angka.',
        'email' => ':attribute harus berupa email yang valid.',
        'digits' => ':attribute harus :digits digit.',
        'image' => ':attribute harus berupa file jpg, png, jpeg, atau pdf.',
        'url' => ':attribute harus berupa URL yang valid.',
        'unique' => ':attribute sudah terdaftar',
        'in' => ':attribute tidak valid'
    ];

    public static function compressImage($file, $folder = 'image')
    {
        $filename = Str::uuid() . '.webp';
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->scale(width: 1200);
        $image->save(
            storage_path("app/public/{$folder}/{$filename}"),
            quality: 80
        );
        return "{$folder}/{$filename}";
    }
}
