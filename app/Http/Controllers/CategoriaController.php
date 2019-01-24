<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function addCategoria() {
        return view('anuncios.addCategoria');
    }
}
