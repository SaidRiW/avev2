<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->apellido_pat =  $request->apellido_pat;
        $user->apellido_mat =  $request->apellido_mat;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_rol = $request->id_rol;
        $user->imagen = $request->imagen;
        if ($user->save()) {
            return response()->json([
                "message" => "El usuario se ha creado correctamente",  
                "user" => $user]);
        } else {
            return response()->json([
                "message"=> "Error al guardar el usuario"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string  $id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string  $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->apellido_pat =  $request->apellido_pat;
        $user->apellido_mat =  $request->apellido_mat;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_rol = $request->id_rol;
        $user->imagen = $request->imagen;
        if ($user->save()) {
            return response()->json([
                "message" => "El usuario se ha actualizado correctamente",  
                "user" => $user]);
        } else {
            return response()->json([
                "message"=> "Error al actualizar el usuario"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string  $id)
    {
        $user = User::find($id)->delete();
        $data = [
            'message' => 'Usuario eliminado exitosamente',
            'user' => $user
        ];
        return response()->json($data);
    }
}
