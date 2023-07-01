<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\TipoDenuncia;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::get();
        return view('areas.main-areas',compact('areas'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.create-areas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // $tipos_denuncias = $request('tipos_denuncia');
            $area = Area::create([
                'nombre'=>$request['nombre'],
                'descripcion'=>$request['descripcion'],
            ]);

            // foreach($i=0;i<count($tipos_denuncias);$i++){
            // }
        return view('areas.main-areas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        return view('areas.show-areas',$area);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        return view('areas.edit-areas',compact('area'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $area = Area::find($request['id_area'])->first();
        $area->update($request->all());
        return view('areas.main-areas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $area->update([
            'estado'=>0,
        ]);
        return view('areas.main-areas');
    }
}
