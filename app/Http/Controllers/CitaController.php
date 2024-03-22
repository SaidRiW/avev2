<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;
use App\Models\Estudiante;
use App\Models\Servicio;
use App\Models\Cita;
use App\Models\User;
use MongoDB\BSON\UTCDateTime;
use Carbon\Carbon;
use Auth;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Cita::all();
        
        foreach ($data as $cita) {
            $cita->fecha_hora = Carbon::createFromTimestampMs($cita->fecha_hora)->format('Y-m-d H:i:s A');
        }

        if(Auth::user()->id_rol == 1) {
            
            return view('apps.cita.index')->with(compact('data'));

        } elseif(Auth::user()->id_rol == 3) {

            $dataServicio = Servicio::all();

            return view('apps.cita_estudiante.index')->with(compact('data', 'dataServicio'));

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
        if(Auth::user()->id_rol == 1) {

            $adminLoguedo = Auth::user();
            $admin = Administrador::where('id_user', $adminLoguedo->_id)->first();

            $matriculaEstudiante = $request->matricula;

            $estudiante = Estudiante::where('matricula', $matriculaEstudiante)->first();

            $perfilEstudiante = User::where('_id', $estudiante->id_user)->first();

            $cita = new Cita;
            $cita->administrador = [
                'id_admin' => Auth::user()->_id,
                'name' => Auth::user()->name,
                'apellido_pat' => Auth::user()->apellido_pat,
                'apellido_mat' => Auth::user()->apellido_mat,
            ];

            $cita->estudiante = [
                'matricula' => $estudiante->matricula,
                'name' => $perfilEstudiante->name,
                'apellido_pat' => $perfilEstudiante->apellido_pat,
                'apellido_mat' => $perfilEstudiante->apellido_mat,
            ];
            
            $cita->servicio = [
                'id_servicio' => $admin->servicio['id_servicio'],
                'servicio' => $admin->servicio['servicio'],
            ];

            $cita->grupo = [
                'id_grupo' => $estudiante->grupo['id_grupo'],
                'grupo' => $estudiante->grupo['grupo'],
            ];

            $cita->fecha_hora = new UTCDateTime(strtotime($request->fecha_hora) * 1000);

            $cita->motivo = $request->motivo;

            $cita->save();
            return redirect()->route('apps.cita.index');

        }elseif(Auth::user()->id_rol == 3) {

            $estudianteLoguedo = Auth::user();
            $estudiante = Estudiante::where('id_user', $estudianteLoguedo->_id)->first();

            $servicioAdmin = $request->servicio;

            $admin = Administrador::where('servicio.id_servicio', $servicioAdmin)->first();

            $perfilAdmin = User::where('_id', $admin->id_user)->first();

            $cita = new Cita;
            $cita->administrador = [
                'id_admin' => $perfilAdmin->_id,
                'name' => $perfilAdmin->name,
                'apellido_pat' => $perfilAdmin->apellido_pat,
                'apellido_mat' => $perfilAdmin->apellido_mat,
            ];

            $cita->estudiante = [
                'matricula' => $estudiante->matricula,
                'name' => Auth::user()->name,
                'apellido_pat' => Auth::user()->apellido_pat,
                'apellido_mat' => Auth::user()->apellido_mat,
            ];
            
            $cita->servicio = [
                'id_servicio' => $admin->servicio['id_servicio'],
                'servicio' => $admin->servicio['servicio'],
            ];

            $cita->grupo = [
                'id_grupo' => $estudiante->grupo['id_grupo'],
                'grupo' => $estudiante->grupo['grupo'],
            ];

            $cita->fecha_hora = new UTCDateTime(strtotime($request->fecha_hora) * 1000);

            $cita->motivo = $request->motivo;

            $cita->save();

            return redirect()->route('apps.cita_estudiante.index');

        }
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
        $cita = Cita::find($id);

        $cita->fecha_hora = new UTCDateTime(strtotime($request->fecha_hora) * 1000);

        $cita->motivo = $request->motivo;

        $cita->save();
        return redirect()->route('apps.cita.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Cita::find($id)->delete();
        return redirect()->route('apps.cita.index');
    }
}
