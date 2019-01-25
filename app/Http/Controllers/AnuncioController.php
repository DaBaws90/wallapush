<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categoria;
use App\anuncio;

class AnuncioController extends Controller
{
    public function addAnuncio() {
        $categorias = categoria::all();
        return view('anuncios.addAnuncio', compact('categorias'));
    }

    public function storeAnuncio(Request $request) {
        $request->validate([
            'id_categoria' => 'required',
            'producto' => 'required',
            'precio' => 'required',
            'nuevo' => 'required',
            'descripcion' => 'required',
        ]);
        $request->merge(['id_vendedor' => auth()->id()]);
        anuncio::create($request->all());
        return back()->with('message', ['success', __("Anuncio creado correctamente")]);
    }

    public function categorias() {
        return view('anuncios.addCategoria');
    }

    public function storeCategoria() {
        request()->validate([
            'nombre' => 'required',
        ]);
        categoria::create(request()->all());
        return back()->with('message', ['success', __("Categoría añadida con éxito")]);
    }
}