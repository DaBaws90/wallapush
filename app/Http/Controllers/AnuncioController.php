<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categoria;
use App\anuncio;
use App\image;
use Illuminate\Support\Facades\Storage;

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
            'images' => 'required',
        ]);
        // dd($request->images[0]->get);
        
        $request->merge(['id_vendedor' => auth()->id()]);
        $anuncio = anuncio::create($request->all());
        foreach ($request->images as $image) {
            $image->store('public/anuncios');
            image::create([
                'id_anuncio' => $anuncio->id,
                'img' => $image->hashName(),
            ]);
            
            
       }
        return back()->with('message', ['success', __("Anuncio creado correctamente")]);
    }

    public function edit($id) {
        $anuncio = anuncio::find($id);
        if($anuncio->isOwner()) {
            return view('anuncios.editAnuncio', compact('anuncio'));
        }
        return back()->with('message', ['success', __("No tienes acceso a este anuncio")]);
        
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
