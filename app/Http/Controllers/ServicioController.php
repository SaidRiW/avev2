<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Servicio::all();
        return view('apps.servicio.index')->with(compact('data'));
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
        $servicio = new Servicio;
        $servicio->nombre = $request->nombre;
        $servicio->created_at = date("Y-m-d h:m:s");
        $servicio->save();
        // Mensaje de sesión
        session()->flash('success', '¡Creación exitosa!');     
        return redirect()->route('apps.servicio.index');
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
    public function update(Request $request, string $id)
    {
        $servicio = Servicio::find($id);
        $servicio->nombre = $request->nombre;
        $servicio->save();
        session()->flash('success', '¡Modificación exitosa!');  
        return redirect()->route('apps.servicio.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Servicio::find($id)->delete();
        // Mensaje de sesión
        session()->flash('success', '¡Eliminación exitosa!');
        return redirect()->route('apps.servicio.index');
    }
}