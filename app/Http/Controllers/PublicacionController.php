<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\Grupo;
use App\Models\Servicio;
use App\Models\Prioridad;
use App\Models\Estudiante;
use App\Models\Administrador;
use App\Events\PostEvent;
use MongoDB\BSON\UTCDateTime;
use Carbon\Carbon;
use Auth;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2) {

            $dataGrupo = Grupo::all();
            $dataPrioridad = Prioridad::all();

            $adminLoguedo = Auth::user();
            $idAdmin = $adminLoguedo->_id;

            $data = Publicacion::where('administrador.id_admin', $idAdmin)->get();
            
            foreach ($data as $publicacion) {
                $publicacion->fechaInicio = Carbon::createFromTimestampMs($publicacion->fechaInicio)->format('Y-m-d H:i:s A');
                $publicacion->fechaFin = Carbon::createFromTimestampMs($publicacion->fechaFin)->format('Y-m-d H:i:s A');
            }
            
            return view('apps.comunidad.index')->with(compact('data', 'dataGrupo', 'dataPrioridad'));

        } elseif(Auth::user()->id_rol == 3) {

            $estudianteLoguedo = Auth::user();
            $estudiante = Estudiante::where('id_user', $estudianteLoguedo->_id)->first();
            $grupoEstudiante = $estudiante->grupo['grupo'];

            $data = Publicacion::where('grupo.grupo', $grupoEstudiante)
                    ->orderBy('created_at', 'desc') // Ordena de manera descendente
                    ->get();

            return view('apps.comunidad_estudiante.index')->with(compact('data'));
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
        // Verificar si los campos 'titulo' y 'prioridad' están presentes y no son nulos
        if (!$request->filled('titulo') || !$request->filled('prioridad')) {
            // Si los campos 'titulo' o 'prioridad' no están presentes o son nulos, muestra una alerta y redirige
            return redirect()->back()->with('error', 'Los campos título y prioridad son obligatorios.');
        }
        $grupo = Grupo::find($request->grupo);

        $prioridadId = intval($request->input('prioridad'));
        $prioridad = Prioridad::where('_id', $prioridadId)->first();

        $adminLoguedo = Auth::user();
        $admin = Administrador::where('id_user', $adminLoguedo->_id)->first();

        $publicacion = new Publicacion;
        $publicacion->administrador = [
            'id_admin' => Auth::user()->_id,
            'name' => Auth::user()->name,
            'apellido_pat' => Auth::user()->apellido_pat,
            'apellido_mat' => Auth::user()->apellido_mat,
            'imagen' => Auth::user()->imagen,

        ];
        $publicacion->servicio = [
            'id_servicio' => $admin->servicio['id_servicio'],
            'servicio' => $admin->servicio['servicio'],
        ];
        $publicacion->titulo = $request->titulo;

        $publicacion->fechaInicio = new UTCDateTime(strtotime($request->fechaInicio) * 1000);
        $publicacion->fechaFin = new UTCDateTime(strtotime($request->fechaFin) * 1000);

        $publicacion->descripcion = $request->descripcion;
        $publicacion->grupo = [
            'id_grupo' => $grupo->_id,
            'grupo' => $grupo->nombre,
        ];

        $imagen = $request->file('imagen');
        if ($imagen) {
            $nombreImagen = uniqid() . '_' . time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('assets/images'), $nombreImagen);
            $rutaImagen = '/assets/images/' . $nombreImagen;
            $publicacion->imagen = $rutaImagen;
        } else {
            $publicacion->imagen = 'sin_imagen';
        }

        $publicacion->prioridad = [
            'id_prioridad' => $prioridad->_id,
            'tipo' => $prioridad->tipo,
            'color' => $prioridad->color,
        ];
        $publicacion->save();

        // Mensaje de sesión
        session()->flash('success', '¡Creación exitosa!');

        event(new PostEvent($publicacion));

        return redirect()->route('apps.comunidad.index');
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
    public function update(Request $request, $id)
    {
        // Verificar si los campos 'titulo' y 'prioridad' están presentes y no son nulos
        if (!$request->filled('titulo') || !$request->filled('prioridad')) {
            // Si los campos 'titulo' o 'prioridad' no están presentes o son nulos, muestra una alerta y redirige
            return redirect()->back()->with('error', 'Los campos título y prioridad son obligatorios.');
        }
        $grupo = Grupo::find($request->grupo);
    
        $prioridadId = intval($request->input('prioridad'));
        $prioridad = Prioridad::where('_id', $prioridadId)->first();

        $publicacion = Publicacion::find($id);
    
        $publicacion->titulo = $request->titulo;
        $publicacion->fechaInicio = new UTCDateTime(strtotime($request->fechaInicio) * 1000);
        $publicacion->fechaFin = new UTCDateTime(strtotime($request->fechaFin) * 1000);
        $publicacion->descripcion = $request->descripcion;
        $publicacion->grupo = [
            'id_grupo' => $grupo->_id,
            'grupo' => $grupo->nombre,
        ];
    
        $imagen = $request->file('imagen');
        if ($imagen) {
            $nombreImagen = uniqid() . '_' . time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('assets/images'), $nombreImagen);
            $rutaImagen = '/assets/images/' . $nombreImagen;
            $publicacion->imagen = $rutaImagen;
        }
        if($prioridad == null || is_null($prioridad->_id)){
            // Mensaje de sesión
            session()->flash('success', 'El campo prioridad es obligatorio.');
            return redirect()->route('apps.comunidad.index');  
        }
        $publicacion->prioridad = [
            'id_prioridad' => $prioridad->_id,
            'tipo' => $prioridad->tipo,
            'color' => $prioridad->color,
        ];
    
        $publicacion->save();
        // Mensaje de sesión
        session()->flash('success', '¡Modificación exitosa!');
        return redirect()->route('apps.comunidad.index');
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Publicacion::find($id)->delete();
        // Mensaje de sesión
        session()->flash('success', '¡Eliminación exitosa!');
        return redirect()->route('apps.comunidad.index');
    }
}
