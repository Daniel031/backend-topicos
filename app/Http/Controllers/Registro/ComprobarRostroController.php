<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Segip;
class ComprobarRostroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }


    public function comparar(Request $request){

        $fotoSegip = Segip::where('ci','=',$request['ci'])->get()->first();
        

        if ($request->hasFile('imagen') &&  $fotoSegip) {
                $imagen = $request->file('imagen');
                $ci = $request['ci'];

                $urlSegip=$fotoSegip->foto;
                    // DESCOMENTAR ESTA LINEA 
                // $fotoCloud =Cloudinary::upload($imagen,['folders'=>'fotografos']);

                $cliente = new RekognitionClient([
                    'region' => env('AWS_DEFAULT_REGION'),
                    'version' =>'latest'
                ]);

                // $rutaimagen1 = public_path("img1.jpg");
                // $rutaimagen2=public_path("img2.jpg");

              
                // $rutaimagen1 = public_path("img1.jpg");
                // $rutaimagen2=public_path("img2.jpg");


                // $imagen1 = file_get_contents($rutaimagen1);
                // $imagen2 = file_get_contents($rutaimagen2);
        

                     // DESCOMENTAR ESTAS 2 LINEA DE ABAJO
                // $public_id=$fotoCloud->getPublicId();
                //$url =$fotoCloud->getSecurePath();

                        // COMENTAR ESTA LINEA DE ABAJO
                $url = 'https://res.cloudinary.com/dirau81x6/image/upload/v1685390870/R_oucxhh.jpg';
                
                $result = $cliente->compareFaces([
                    'SimilarityThreshold' => 70, // Umbral de similitud (ajusta según tus necesidades)
                    'SourceImage' => [
                        'Bytes' => file_get_contents($urlSegip),
                    ],
                    'TargetImage' => [
                        'Bytes' => file_get_contents($url),
                    ],
                ]);


                $faceMatches = $result['FaceMatches'];
                
                $cantidad= count($faceMatches);
            
                 if($cantidad>=1){
                    return response()->json([
                        'res' => true,
                         'mensaje' => 'Usuario correcto',
                         'datos' => $fotoSegip,
                    ]);
                }
                return response()->json([
                    'res' => false,
                    'mensaje' => 'La Foto No coincide',
                ]);
                


            }
            if($fotoSegip){
            return response()->json([
                'res' => false,
                'mensaje' => "No tiene archivo Imagen",
                   
            ]);
            }else{
                return response()->json([
                    'res' => false,
                    'mensaje' => 'Ci erroneo',

                ]);
            }

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
