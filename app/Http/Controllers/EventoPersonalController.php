<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prioridad;
use App\Models\Estudiante;
use App\Models\EventoPersonal;
use App\Models\Publicacion;
use MongoDB\BSON\UTCDateTime;
use Carbon\Carbon;
use Auth;

class EventoPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPrioridad = Prioridad::all();

        $estudianteLoguedo = Auth::user();
        $estudiante = Estudiante::where('id_user', $estudianteLoguedo->_id)->first();
        $matriculaEstudiante = $estudiante->matricula;
        $grupoEstudiante = $estudiante->grupo['grupo'];

        $data = EventoPersonal::where('matricula', $matriculaEstudiante)->get();
        $dataPublicacion = Publicacion::where('grupo.grupo', $grupoEstudiante)->get();
        
        foreach ($data as $evento) {
            $evento->fecha_hora = Carbon::createFromTimestampMs($evento->fecha_hora)->format('Y-m-d H:i:s A');
        }

        foreach ($dataPublicacion as $publicacion) {
            $publicacion->fechaInicio = Carbon::createFromTimestampMs($publicacion->fechaInicio)->format('Y-m-d H:i:s A');
            $publicacion->fechaFin = Carbon::createFromTimestampMs($publicacion->fechaFin)->format('Y-m-d H:i:s A');
        }
        
        return view('apps.evento.index')->with(compact('data', 'dataPrioridad', 'dataPublicacion'));
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
        $prioridadId = intval($request->input('prioridad'));
        $prioridad = Prioridad::where('_id', $prioridadId)->first();

        $estudianteLoguedo = Auth::user();
        $estudiante = Estudiante::where('id_user', $estudianteLoguedo->_id)->first();

        $evento = new EventoPersonal();

        $evento->matricula = $estudiante->matricula;
        $evento->titulo = $request->titulo;
        $evento->descripcion = $request->descripcion;
        $evento->fecha_hora = new UTCDateTime(strtotime($request->fecha_hora) * 1000);
        $evento->prioridad = [
            'id_prioridad' => $prioridad->_id,
            'tipo' => $prioridad->tipo,
            'color' => $prioridad->color,
        ];
        $evento->save();
        // Mensaje de sesión
        session()->flash('success', '¡Evento agendado exitosamente!');
        session()->flash('success_icon', 'success');
        return redirect()->route('apps.evento.index');    
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
        $prioridadId = intval($request->input('prioridad'));
        $prioridad = Prioridad::where('_id', $prioridadId)->first();

        $evento = EventoPersonal::find($id);

        $evento->titulo = $request->titulo;
        $evento->descripcion = $request->descripcion;
        $evento->fecha_hora = new UTCDateTime(strtotime($request->fecha_hora) * 1000);
        if($prioridad == null || is_null($prioridad->_id)){
            // Mensaje de sesión
            session()->flash('success', 'Favor de llenar todos los campos.');
            return redirect()->route('apps.evento.index');  
        }
        $evento->prioridad = [
            'id_prioridad' => $prioridad->_id,
            'tipo' => $prioridad->tipo,
            'color' => $prioridad->color,
        ];
        $evento->save();
        // Mensaje de sesión
        session()->flash('success', '¡Modificación exitosa!'); 
        session()->flash('success_icon', 'success');
        return redirect()->route('apps.evento.index');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EventoPersonal::find($id)->delete();
        // Mensaje de sesión
        session()->flash('success', '¡Eliminación exitosa!');
        session()->flash('success_icon', 'success');
        return redirect()->route('apps.evento.index');
    }
}
