<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;
use Illuminate\Support\Facades\View;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Carrera::all();
        
        return view('apps.carrera.index')->with(compact('data'));
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
        $carrera = new Carrera;
        $carrera->nombre = $request->nombre;
        $carrera->created_at = date("Y-m-d h:m:s");
        $carrera->save();
        return redirect()->route('apps.carrera.index');
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
        $carrera = Carrera::find($id);
        $carrera->nombre = $request->nombre;
        $carrera->save();
        return redirect()->route('apps.carrera.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Carrera::find($id)->delete();
        return redirect()->route('apps.carrera.index');
    }
}
