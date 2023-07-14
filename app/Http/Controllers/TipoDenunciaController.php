<?php

namespace App\Http\Controllers;

use App\Models\TipoDenuncia;
use Illuminate\Http\Request;
use App\Models\Area;


class TipoDenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos =TipoDenuncia::paginate(20);
        return view('tipos_denuncias.main-tipo_denuncia',compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::get();   // La denuncia tiene que pertenecer a una area
        return view('tipos_denuncias.create-tipo_denuncia',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $tipo = TipoDenuncia::create([
                'nombre' => $request['nombre'],
                'descripcion'=>$request['descripcion'],
                'area_id' => $request['area_id'],
            ]);

            return redirect()->route('tipos_denuncias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoDenuncia $tipoDenuncia)
    {
        $areas = Area::get();
        return view('tipos_denuncias.show-tipo_denuncia',compact('tipoDenuncia','areas'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoDenuncia $tipoDenuncia)
    {
            $areas = Area::get();  //cuando se edite tambien tiene que haber la posibilidad de editar el area
            return view('tipos_denuncias.edit-tipo_denuncia',compact('areas','tipoDenuncia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoDenuncia $tipoDenuncia)
    {
            $tipoDenuncia->nombre=$request['nombre'];
            $tipoDenuncia->descripcion=$request['descripcion'];
            $tipoDenuncia->area_id=$request['area_id'];
            $tipoDenuncia->save();
            return redirect()->route('tipos_denuncias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoDenuncia $tipoDenuncia)
    {
        $tipoDenuncia->estado=!$tipoDenuncia->estado;
        $tipoDenuncia->save();

        return redirect()->route('tipos_denuncias.index');
    }
}
