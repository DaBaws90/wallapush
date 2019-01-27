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
        $user->actived = false;
        $user->update();
        if($user){
            return redirect()->route('users.index')->with(
                'message', ['success' , 'Usuario ' .$user->name.' deshabilitado correctamente']
            );
        }
        else{
            return redirect()->route('users.index')->with('message', ['danger' , 'No se pudo deshabilitar el usuario']);
        }
    }

    /**
     * Set saldo for the specified resources from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setSaldo($id_list)
    {
        foreach ($id_list as $id) {
            
        }
        $user = User::find($id);
        $user->actived = false;
        $user->update();
        if($user){
            return redirect()->route('users.index')->with(
                'message', ['success' , 'Usuario ' .$user->name.' deshabilitado correctamente']
            );
        }
        else{
            return redirect()->route('users.index')->with('message', ['danger' , 'No se pudo deshabilitar el usuario']);
        }
    }
}
