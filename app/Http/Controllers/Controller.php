<?php

namespace App\Http\Controllers;

abstract class Controller
{
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
}
