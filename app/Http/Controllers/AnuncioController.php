<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\categoria;
use App\anuncio;
use App\image;
use Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    public function addAnuncio() {
        $categorias = categoria::orderBy('nombre')->get();
        return view('anuncios.addAnuncio', compact('categorias'));
    }

    public function listAnuncios() {
        $anuncios = anuncio::where('vendido', False)->orderBy('id', 'desc')->paginate(6);
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
        if($anuncio->isOwner() || auth()->user()->role == 'admin') {
            $categorias = categoria::orderBy('nombre')->get();
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
        if($anuncio->isOwner() || Auth::user()->role == 'admin') {
            if($anuncio->images) {
                $prueba = "";
                foreach ($anuncio->images as $image) {
                    Storage::disk('anuncios')->delete($image->img);
                }   
                $anuncio->images()->delete();
            }
            $anuncio->delete();
            return redirect(route('listAnuncios'))->with('message', ['success', __('Anuncio eliminado correctamente')]);
        }
        return redirect(route('listAnuncios'))->with('message', ['danger', __('No puedes eliminar este anuncio')]);
        // return redirect(route('listAnuncios'));
        
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

    public function vendidos() {
        $anuncios = anuncio::where('vendido', True)->orderBy('id', 'desc')->paginate(6);
        $categorias = categoria::orderBy('nombre')->get();
        return view('anuncios.vendidos', compact('anuncios','categorias'));
    }

    public function filtroFechas(Request $request) {
        $anuncios = anuncio::where('vendido', 1)->where('id_categoria', $request->categoria)->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin . ' 23:59:59'])->paginate(6);
        $categorias = categoria::orderBy('nombre')->get();
        return view('anuncios.vendidos', compact('anuncios', 'categorias'));
    }
}
