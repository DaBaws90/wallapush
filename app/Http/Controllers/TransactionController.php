<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\anuncio;
use Illuminate\Support\Facades\Auth;
use App\User;

class TransactionController extends Controller
{

    public function addVenta($id){
        $anuncio = anuncio::find($id);
        $error = "";
        return view('transaction.venta', compact('anuncio', 'error'));
    }

    public function storeVenta(Request $request) {
        $request->validate([
            'id' => 'required'
        ]);

        $comprador = Auth::user();
        $anuncio = anuncio::where("id", $request->input('id'))->first();

        $saldo = $comprador->saldo;
        $precio = $anuncio->precio;

        if ($saldo>=$precio) {
            $anuncio->vendido = '1';
            $anuncio->save();

            $transaction = new Transaction([
                'id_anuncio' => $request->get('id'),
                'id_comprador'=> auth()->id()
            ]);
            $transaction->save();

            $comprador->saldo = $saldo-$precio;
            $comprador->save();

            $vendedor = User::where('id', $anuncio->id_vendedor)->first();
            $vendedor->saldo += $precio;
            $vendedor->save();

            return redirect()->route('listAnuncios')->with('success', 'Se ha realizado la compra con exsito.');
        } elseif ($comprador->id == $anuncio->id_vendedor) {
            $error = "Este producto es suyo, no lo puede comprar.";
            return view('transaction.venta', compact('anuncio', 'error'));
        } elseif ($saldo<$precio) {
            $error = "El saldo de su cuenta es inferior al precio del producto que desea comprar.";
            return view('transaction.venta', compact('anuncio', 'error'));
        }
    }

    public function valorarCompra(){
        $ventas = Transaction::where('id_comprador', '=',auth()->id())->where('valoracion', '=',null)->get();
        return view('transaction.valoracion', compact('ventas'));
    }

    public function valoracion(Request $request) {
        $request->validate([
            'valoracion' => 'required|min:1|max:5|integer'
        ]);

        $transaction = Transaction::where('id', $request->input('id'))->first();
        $transaction->valoracion = $request->valoracion;
        $transaction->save();

        return redirect()->route('listAnuncios')->with('success', 'Se ha realizado la valoracion con exsito.');
    }

    public function compras(){
        $user = Auth::user();
        $transacciones = Transaction::where('id_comprador', $user->id)->with('anuncio')->get();
        return view('transaction.compras', compact('transacciones'));
    }

    public function ventas(){
        $user = Auth::user();
        $anuncios = anuncio::where('id_vendedor', $user->id)->where('vendido', 1)->get();
        return view('transaction.ventas', compact('anuncios'));
    }
}
