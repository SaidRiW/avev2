<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Carrera;
use Illuminate\Support\Facades\View;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Grupo::all();
        $dataCarrera = Carrera::all();
        
        return view('apps.grupo.index')->with(compact('data','dataCarrera'));
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
        $carrera = Carrera::find($request->carrera);

        $grupo = new Grupo;
        $grupo->nombre = $request->nombre;
        $grupo->carrera = [
            'id_carrera' => $carrera->_id,
            'carrera' => $carrera->nombre,
        ];
        $grupo->created_at = date("Y-m-d h:m:s");
        $grupo->save();
        return redirect()->route('apps.grupo.index');
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
        $carrera = Carrera::find($request->carrera);

        $grupo = Grupo::find($id);
        $grupo->nombre = $request->nombre;
        $grupo->carrera = [
            'id_carrera' => $carrera->_id,
            'carrera' => $carrera->nombre,
        ];
        $grupo->save();
        return redirect()->route('apps.grupo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Grupo::find($id)->delete();
        return redirect()->route('apps.grupo.index');
    }
}
