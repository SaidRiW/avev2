<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class ApiCitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas =  Cita::all();
        return response()->json($citas);
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
        $cita = new Cita;
        $cita->id_admin = $request->id_admin;
        $cita->matricula = $request->matricula;
        $cita->id_servicio = $request->id_servicio;
        $cita->id_grupo = $request->id_grupo;
        $cita->fecha_hora = $request->fecha_hora;
        $cita->motivo = $request->motivo;

        if ($cita->save()) {
            return response()->json([
                "message" => "La cita se ha creado correctamente",  
                "cita" => $cita]);
        } else {
            return response()->json([
                "message"=> "Error al guardar la cita"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cita = Cita::find($id);
        return response()->json($cita);
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
        $cita = Cita::find($id);
        $cita->id_admin = $request->id_admin;
        $cita->matricula = $request->matricula;
        $cita->id_servicio = $request->id_servicio;
        $cita->id_grupo = $request->id_grupo;
        $cita->fecha_hora = $request->fecha_hora;
        $cita->motivo = $request->motivo;

        if ($cita->save()) {
            return response()->json([
                "message" => "La cita se ha actualizado correctamente",  
                "cita" => $cita]);
        } else {
            return response()->json([
                "message"=> "Error al actualizar la cita"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cita = Cita::find($id)->delete();
        $data = [
            'message' => 'Cita eliminada exitosamente',
            'cita' => $cita
        ];
        return response()->json($data);
    }
}
