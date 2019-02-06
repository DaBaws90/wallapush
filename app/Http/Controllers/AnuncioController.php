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
        $images = $anuncio->images();
        return view('anuncios.details', compact('anuncio', 'images'));
    }

    public function storeAnuncio(Request $request) {
        $request->validate([
            'id_categoria' => 'required',
            'producto' => 'required',
            'precio' => 'required',
            'nuevo' => 'required',
            'descripcion' => 'required',
            // 'images' => 'required',
        ]);
        // dd($request->images[0]->get);
        
        $request->merge(['id_vendedor' => auth()->id()]);
        $anuncio = anuncio::create($request->all());
        if ($request->images) {
            foreach ($request->images as $image) {
                $image->store('public/anuncios');
                image::create([
                    'id_anuncio' => $anuncio->id,
                    'img' => $image->hashName(),
                ]);
           }
        }
       
        return back()->with('message', ['success', __("Anuncio creado correctamente")]);
    }

    public function edit($id) {
        $anuncio = anuncio::find($id);
        if($anuncio->isOwner()) {
            $categorias = categoria::all();
            return view('anuncios.editAnuncio', compact('anuncio', 'categorias'));
        }
        return back()->with('message', ['success', __("No tienes acceso a este anuncio")]);   
    }

    public function editAnuncio(Request $request) {
        anuncio::where('id', $request->id)->update([
            'producto' => $request['producto'],
            'id_categoria' => $request['id_categoria'],
            'descripcion' => $request['descripcion'],
            'precio' => $request['precio'],
        ]);
        if ($request->images) {
            foreach ($request->images as $image) {
                $image->store('public/anuncios');
                image::create([
                    'id_anuncio' => $request->id,
                    'img' => $image->hashName(),
                ]);
           }
        }
        return back()->with('message', ['success', __("Anuncio editado con éxito")]);   
    }

    public function remove($id) {
        $anuncio = anuncio::find($id);
        if($anuncio->isOwner()) {
            if($anuncio->images) {
                $prueba = "";
                foreach ($anuncio->images as $image) {
                    Storage::disk('anuncios')->delete($image->img);
                }   
                $anuncio->images()->delete();
            }
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

    public function buscador(Request $req){
        $req->validate([
            'buscador' => 'required',
        ]);
        $nombre = $req->buscador;
        $anuncios = anuncio::where('producto', 'LIKE', "%$nombre%")->orWhere('descripcion', 'LIKE', "%$nombre%")->paginate(6);
        return view('anuncios.listAnuncios', compact('anuncios'));
    }
}