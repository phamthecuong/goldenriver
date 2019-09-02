<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function resize(Request $request)
    {
        $w = $request->get('w');
        $h = $request->get('h');
        $src = $request->get('src');
        
        if (!Storage::disk('public')->exists($src)) {
            return null;
        }

        $image = ImageHelpers::crop($src, $w, $h);

        return $image;
    }
}
