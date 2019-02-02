<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('users.index',compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.addView');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'localidad' => 'string|max:191'
        ]);
        $user = User::create($request->all());

        if($user){
            return redirect()->route('users.index')->with('message', ['success', 'Usuario creado correctamente']);
        }
        else{
            return redirect()->route('users.index')->with('message', ['danger', 'No se pudo crar el usuario']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.details', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.edit', compact('user', ['user' => User::find($id)]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $destroy = User::destroy($id);
        if ($destroy){
            return redirect()->route('users.index')->with('message', ['success' , 'Usuario '.$user->name.' eliminado correctamente']);
        }
        else{
            return redirect()->route('users.index')->with('message', ['danger' , 'No se pudo eliminar el usuario']);
        }
    }

    /**
     * Disables the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        $user = User::find($id);
        if($user->actived){
            $user->actived = false;
        }
        else{
            $user->actived = true;
        }
        $user->save();
        if($user){
            return redirect()->route('users.index')->with(
                'message', ['success' , 'Usuario deshabilitado/habilitados correctamente']
            );
        }
        else{
            return redirect()->route('users.index')->with('message', ['danger' , 'No se pudo deshabilitar/habilitar el usuario']);
        }
    }

    /**
     * Show the form to set saldo.
     *
     * @return \Illuminate\Http\Response
     */
    public function disableUsers()
    {
        $users = User::latest()->paginate(5);
        return view('users.disable', compact('users'));
    }

    /**
     * Disables the specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disableUsersPost(Request $request)
    {
        $this->validate($request, [
            'id_list' => 'required',
        ]);
        $users = User::whereIn('id', $request->id_list)->get();
        foreach($users as $user){
            if($user->actived){
                $user->actived = false;
            }
            else{
                $user->actived = true;
            }
            $user->save();
        }
        if($users){
            return redirect()->route('users.index')->with(
                'message', ['success' , 'Usuarios deshabilitado/habilitados correctamente']
            );
        }
        else{
            return redirect()->route('users.index')->with('message', ['danger' , 'No se pudieron deshabilitar/habilitar los usuarios']);
        }
    }

    /**
     * Show the form to set saldo.
     *
     * @return \Illuminate\Http\Response
     */
    public function saldo(Request $request)
    {
        $this->validate($request, [
            'id_list' => 'required',
        ]);
        $users = User::whereIn('id', $request->id_list)->get();
        // $users = array();
        // foreach($request->id_list as $id){
        //     array_push($users, User::find($id));
        // }
        return view('users.saldo', compact('users'));
    }

    /**
     * Set saldo for the specified resources from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setSaldo(Request $request)
    {
        // $this->validate($request, [
        //     'saldo' => 'required|min:1|numeric',
        // ]);
        // dd($request);
        $users = array();
        foreach ($request->users as $user) {
            $usuario=User::find($user);
            // $user = User::find($id);
            $usuario->saldo = $request->saldo;
            $usuario->save();
        }
        
        // if($users.count() == $id_list.count()){
        if($request->users){
            return redirect()->route('users.index')->with('message', ['success' , 'Saldos correctamente establecidos']
            );
        }
        else{
            return redirect()->route('users.index')->with('message', ['danger' , 'No se pudo establecer el saldo']);
        }
    }

    public function userSortBySales(){
        $users = User::all();
        $sortUsers = array();
        $sortBySales = array();
        
        foreach ($users as $user) {
            $sales = Anuncio::where('id_vendedor', $user->id)->where('vendido', true)->get();
            foreach ($sales as $sale) {
                $total += $sale->precio;
            }
            array_push($sortUsers, ['user', ['userName' => $user->name, 'sales' => $total]]);
            $total = 0;
        }
        $sortBySales = collect($sortUsers)->sortBy('sales')->reverse()->toArray();
        return view('users.sortBySales', compact('sortBySales'));
    }
}
