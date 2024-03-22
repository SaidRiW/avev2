<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipo;
use RealRashid\SweetAlert\Facades\Alert;



class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();

        //$vehiculos = Vehiculo::all();
        // dd($vehiculos);

        $marcas = Marca::all();
        $modelos = Modelo::all();
        $tipos = Tipo::all();

        $title = '¡Eliminar vehículo!';
        $text = "¿Estas seguro de eliminar?";
        confirmDelete($title, $text);

        return view('vehiculos.vehiculos_index', compact('vehiculos', 'marcas', 'modelos', 'tipos'));

    }
    public function store(Request $request)
    {
        $vehiculo = new Vehiculo;
    // Verificar si se encontró la marca

    $modelo_id = $request->modelo;
    $marca_id = $request->marca;

    $marcas = Marca::all();
    $modelos = Modelo::all();

    // Obtener el nombre de la marca a partir del ID
    $nombre_marca = null;
    foreach ($marcas as $marca) {
        if ($marca->_id == $marca_id) {
            $nombre_marca = $marca->Marca;
            break;
        }
    }
    
    $nombre_modelo = null;
    foreach( $modelos as $modelo) {
        if($modelo->_id == $modelo_id) {
            $nombre_modelo = $modelo->Modelo;
            break;
        } 
        }

        // Asignar valores desde el formulario
        $vehiculo->Marca = [
            'id_marca' => $request->marca,
            'Nombre' =>$nombre_marca,
        ];
        $vehiculo->Modelo = [
            'id_modelo' => $request->modelo,
            'Modelo'=>$nombre_modelo,
        ];
        $vehiculo->Tipo = [
            'id_tipo' => $request->tipo_v,
            'Tipo' => $request->tipo_vehiculo,
        ];
        $vehiculo->Año = $request->anio;
        $vehiculo->Kilometraje = $request->km;
        $vehiculo->Placas = $request->placas;
        $vehiculo->Numero_serie = $request->serie;
        $vehiculo->estatus_vehiculo = $request->estado;
    
        $vehiculo->created_at = now(); // No es necesario asignar manualmente la fecha de creación
        $vehiculo->updated_at = now(); // No es necesario asignar manualmente la fecha de creación


        // Guardar el nuevo registro en la base de datos
        $vehiculo->save();
        Alert::success('Éxito', '!Vehículo Registrado!');
        return redirect('/ver-vehiculos');

    }
    public function show(String $id)
    {
        $vehiculo = Vehiculo::find($id);
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $tipos = Tipo::all();
        return view('vehiculos.viewVehicle')->with(compact('vehiculo','marcas','modelos','tipos'));
    }
    public function edit(String $id)
{
    $vehiculo = Vehiculo::find($id);
    $marcas = Marca::all();
    $modelos = Modelo::all();
    $tipos = Tipo::all();
    return view('vehiculos.editVehicle')->with(compact('vehiculo','marcas','modelos','tipos'));
}
    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::find($id);
        $modelo_id = $request->modelo_edit;
        $marca_id = $request->marca_edit;

        $marcas = Marca::all();
        $modelos = Modelo::all();

        // Obtener el nombre de la marca a partir del ID
        $nombre_marca = null;
        foreach ($marcas as $marca) {
            if ($marca->_id == $marca_id) {
                $nombre_marca = $marca->Marca;
                break;
            }
        }
        
        $nombre_modelo = null;
        foreach( $modelos as $modelo) {
            if($modelo->_id == $modelo_id) {
                $nombre_modelo = $modelo->Modelo;
                break;
            } 
            }


        /* Verificar si se encontró el nombre de la marca
        if ($nombre_marca) {
            // El nombre de la marca se encontró
            dd($nombre_marca);
        } else {
            // No se encontró el nombre de la marca
            dd('Nombre de la marca no encontrado');
        } */

        $vehiculo->Marca = [
            'id_marca' => $request->marca_edit,
            'Nombre' =>$nombre_marca,
        ];
        $vehiculo->Modelo = [
            'id_modelo' => $request->modelo_edit,
            'Modelo'=>$nombre_modelo,
        ];
        $vehiculo->Tipo = [
            'id_tipo' => $request->tipo_v_edit,
            'Tipo' => $request->tipo_vehiculo_edit,
        ];
        $vehiculo->Año = $request->anio_edit;
        $vehiculo->Kilometraje = $request->km_edit;
        $vehiculo->Placas = $request->placas_edit;
        $vehiculo->Numero_serie = $request->serie_edit;
        $vehiculo->estatus_vehiculo = $request->estado_edit;
    
        $vehiculo->updated_at = now(); // No es necesario asignar manualmente la fecha de creación

        Alert::success('Éxito', '!Vehículo Actualizado!');

        // Guardar el nuevo registro en la base de datos
        $vehiculo->save();

        return redirect('/ver-vehiculos');

    }

    public function destroy($id)
    {
        // Busca el vehículo por su ID
        $vehiculo = Vehiculo::findOrFail($id);
    

        // Elimina el vehículo
        $vehiculo->delete();

        // Muestra una alerta de éxito
        Alert::success('Éxito', 'Vehículo eliminado exitosamente.');

        // Redirige al usuario a la página de vehículos
        return redirect('/ver-vehiculos');
    }
}
