<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventoPersonal;

class ApiEventoPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos =  EventoPersonal::all();
        return response()->json($eventos);
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
        $evento = new EventoPersonal;
        $evento->matricula = $request->matricula;
        $evento->titulo = $request->titulo;
        $evento->fecha_hora = $request->fecha_hora;
        $evento->descripcion = $request->descripcion;
        $evento->id_prioridad = $request->id_prioridad;

        if ($evento->save()) {
            return response()->json([
                "message" => "El evento se ha creado correctamente",  
                "evento" => $evento]);
        } else {
            return response()->json([
                "message"=> "Error al guardar el evento"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string  $id)
    {
        $evento = EventoPersonal::find($id);
        return response()->json($evento);
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
        $evento = EventoPersonal::find($id);
        $evento->matricula = $request->matricula;
        $evento->titulo = $request->titulo;
        $evento->fecha_hora = $request->fecha_hora;
        $evento->descripcion = $request->descripcion;
        $evento->id_prioridad = $request->id_prioridad;
        if ($evento->save()) {
            return response()->json([
                "message" => "El evento se ha actualizado correctamente",  
                "evento" => $evento]);
        } else {
            return response()->json([
                "message"=> "Error al actualizar el evento"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string  $id)
    {
        $evento = EventoPersonal::find($id)->delete();
        $data = [
            'message' => 'Evento eliminado exitosamente',
            'evento' => $evento
        ];
        return response()->json($data);
    }
}
