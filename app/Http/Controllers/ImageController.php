<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function remove($img) {
        image::where('img', $img)->delete();
        Storage::disk('anuncios')->delete($img);
        return back()->with('deleteimg', ['success', __("Imagen eliminada con éxito")]);
    }
}
