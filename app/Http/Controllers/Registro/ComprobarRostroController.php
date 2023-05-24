<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComprobarRostroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }


    public function comparar(Request $request){
        return response()->json([
            'res' => true,
            'mensaje' => "El usuario esta registrado en el segip"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
