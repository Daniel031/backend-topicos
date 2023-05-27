<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;

class ComprobarRostroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }


    public function comparar(Request $request){

        $cliente = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' =>'latest'
        ]);

        $rutaimagen1 = public_path("img1.jpg");
        $rutaimagen2=public_path("img2.jpg");


        $imagen1 = file_get_contents($rutaimagen1);
        $imagen2 = file_get_contents($rutaimagen2);

        $result = $cliente->compareFaces([
            'SimilarityThreshold' => 70, // Umbral de similitud (ajusta según tus necesidades)
            'SourceImage' => [
                'Bytes' => $imagen1,
            ],
            'TargetImage' => [
                'Bytes' => $imagen2,
            ],
        ]);


        $faceMatches = $result['FaceMatches'];




        return response()->json([
            'res' => true,
            'mensaje' => "El usuario esta registrado en el segip",
            'resultado-aws'=> $faceMatches,
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
