<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Rol;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Servicio;
use App\Models\Estudiante;
use App\Models\Administrador;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $rol = Rol::where('_id',$user->id_rol)->first();

        if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2) {

            $adminLoguedo = Auth::user();
            $admin = Administrador::where('id_user', $adminLoguedo->_id)->first();
            return view('apps.users.index')->with(compact('admin','user','rol'));
            
        } elseif(Auth::user()->id_rol == 3) {

            $estudianteLoguedo = Auth::user();
            $estudiante = Estudiante::where('id_user', $estudianteLoguedo->_id)->first();
            return view('apps.users.index')->with(compact('estudiante','user','rol'));

        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        $user = Auth::user();

        $perfil = User::where('_id', $user->_id)->first();

        $imagen = $request->file('imagen');
        if ($imagen) {
            $nombreImagen = uniqid() . '_' . time() . '_' . $imagen->getClientOriginalName();
            
            $imagen->move(public_path('assets/images'), $nombreImagen);
            $rutaImagen = '/assets/images/' . $nombreImagen;
            $perfil->imagen = $rutaImagen;

            $perfil->save();
        }

        return redirect()->route('apps.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
