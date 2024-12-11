<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index() {
        $imagePath = public_path('image');
        $images = collect(File::files($imagePath))
                    ->map(function ($file) {
                        return asset('image/' . $file->getFilename());
                    });
        return view('user.menu', ['images' => $images]);
    }
}
