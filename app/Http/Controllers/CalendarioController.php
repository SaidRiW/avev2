<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\EventoPersonal;
use App\Models\Publicacion;
use App\Models\Prioridad;
use App\Models\Cita;
use Auth;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::user()->id_rol == 1){

            $adminLoguedo = Auth::user();
            $idAdmin = $adminLoguedo->_id;

            $publicaciones = Publicacion::where('administrador.id_admin', $idAdmin)->get();
            $citas = Cita::where('administrador.id_admin', $idAdmin)->get();

            // Combinar eventos en una sola colección
            $eventos = [];

            foreach ($publicaciones as $publicacion) {
                $eventos[] = [
                    'id' => $publicacion->id,
                    'title' => $publicacion->titulo,
                    'start' => $this->formatDate($publicacion->fechaInicio),
                    'end' => $this->formatDate($publicacion->fechaFin),
                    'className' => $publicacion->prioridad['color'],
                    'description' => $publicacion->descripcion,
                    'url' => '/apps/comunidad',
                ];
            }

            foreach ($citas as $cita) {
                $eventos[] = [
                    'id' => $cita->id,
                    'title' => "Cita con {$cita->estudiante['name']} {$cita->estudiante['apellido_pat']}",
                    'start' => $this->formatDate($cita->fecha_hora),
                    'className' => 'primary',
                    'url' => '/apps/cita',
                ];
            }

            return view('index')->with('eventos', $eventos);

        }elseif(Auth::user()->id_rol == 2){

            $adminLoguedo = Auth::user();
            $idAdmin = $adminLoguedo->_id;

            $publicaciones = Publicacion::where('administrador.id_admin', $idAdmin)->get();

            // Combinar eventos en una sola colección
            $eventos = [];

            foreach ($publicaciones as $publicacion) {
                $eventos[] = [
                    'id' => $publicacion->id,
                    'title' => $publicacion->titulo,
                    'start' => $this->formatDate($publicacion->fechaInicio),
                    'end' => $this->formatDate($publicacion->fechaFin),
                    'className' => $publicacion->prioridad['color'],
                    'description' => $publicacion->descripcion,
                    'url' => '/apps/comunidad',
                ];
            }

            return view('index')->with('eventos', $eventos);

        }elseif(Auth::user()->id_rol == 3){

            $dataPrioridad = Prioridad::all();

            $estudianteLoguedo = Auth::user();
            $estudiante = Estudiante::where('id_user', $estudianteLoguedo->_id)->first();
            $grupoEstudiante = $estudiante->grupo['grupo'];
            $matriculaEstudiante = $estudiante->matricula;

            $citas = Cita::where('estudiante.matricula', $matriculaEstudiante)->get();
            $publicaciones = Publicacion::where('grupo.grupo', $grupoEstudiante)->get();
            $eventosPersonales = EventoPersonal::where('matricula', $matriculaEstudiante)->get();

            // Combinar eventos en una sola colección
            $eventos = [];

            foreach ($citas as $cita) {
                $eventos[] = [
                    'id' => $cita->id,
                    'title' => "Cita con {$cita->administrador['name']} {$cita->administrador['apellido_pat']}",
                    'start' => $this->formatDate($cita->fecha_hora),
                    'className' => 'primary',
                    'url' => '/apps/cita_estudiante',
                ];
            }

            foreach ($publicaciones as $publicacion) {
                $eventos[] = [
                    'id' => $publicacion->id,
                    'title' => $publicacion->titulo,
                    'start' => $this->formatDate($publicacion->fechaInicio),
                    'end' => $this->formatDate($publicacion->fechaFin),
                    'className' => $publicacion->prioridad['color'],
                    'description' => $publicacion->descripcion,
                    'url' => '/apps/evento',
                ];
            }

            foreach ($eventosPersonales as $evento) {
                $eventos[] = [
                    'id' => $evento->id,
                    'title' => $evento->titulo,
                    'start' => $this->formatDate($evento->fecha_hora),
                    'className' => $evento->prioridad['color'],
                    'description' => $evento->descripcion,
                    'url' => '/apps/evento',
                ];
            }

            return view('index')->with(compact('eventos', 'dataPrioridad'));

        }elseif(Auth::user()->id_rol == 4){
            $eventos = [];
            return view('index')->with(compact('eventos'));
        }

    }

    /**
     * Formatea la fecha en formato ISO 8601.
     */
    private function formatDate($date)
    {
        return $date->toDateTime()->format(\DateTime::ISO8601);
    }
}
