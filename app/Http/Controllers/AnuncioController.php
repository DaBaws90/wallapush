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

    public function listAnuncios() {
        $anuncios = anuncio::orderBy('id', 'desc')->paginate(6);
        return view('anuncios.listAnuncios', compact('anuncios'));
    }

    public function detailsAnuncio($id) {
        $anuncio = anuncio::find($id);
        return view('anuncios.details', compact('anuncio'));
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

    public function remove($id) {
        $anuncio = anuncio::find($id);
        if($anuncio->isOwner()) {
            $anuncio->delete();
        }
        return redirect(route('listAnuncios'));
        // return back()->with('message', ['success', __('Anuncio eliminado correctamente')]);
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
