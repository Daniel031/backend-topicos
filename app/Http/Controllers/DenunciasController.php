<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuardarDenunciaRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Aws\Rekognition\RekognitionClient;
use App\Models\Denuncia;
use App\Models\FotoDenuncia;
use App\Models\Label;
use App\Models\User;
use Carbon\Carbon;


use App\Helpers\OpenAIChat;


class DenunciasController extends Controller
{
     // GuardarDenunciaRequest
    public function denunciar(Request $request){
      
       
        $titulo =$request['titulo'];
        $descripcion = $request['descripcion'];
        $fecha = date("m.d.y"); 
        $hora = date("H:i:s");
        $latitud = $request['latitud'];
        $longitud = $request['longitud'];
        $tipo_denuncia = $request['tipo_denuncia'];


        $email = $request['email'];
        $user_id = User::where('email',$email)->first();


        $cliente = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' =>'latest'
        ]);
        if($request->hasFile('imagen1')){
                // $imagen2 = $request->file('imagen2');
                $imagen1 = $request->file('imagen1');
               // $imagen1 = public_path('aaaaa.jpg');
                $fotoCloud1 =Cloudinary::upload($imagen1->getRealPath(),['folders'=>'fotografos']);
                $public_id_imagen1=$fotoCloud1->getPublicId();
                $url1 =$fotoCloud1->getSecurePath();

                if($request->hasFile('imagen2')){
                    $imagen2 = $request->file('imagen2');
                    $fotoCloud2 =Cloudinary::upload($imagen2->getRealPath(),['folders'=>'fotografos']);
                    $public_id_imagen2=$fotoCloud2->getPublicId();
                    $url2 =$fotoCloud2->getSecurePath();

                    // SI LLEGAMOS AQUI, TENEMOS LAS 2 IMAGENES IMAGEN1,IMAGEN2
                    $result = $cliente->detectLabels([
                        'Image' => [
                            'Bytes' => file_get_contents($url1),
                        ],
                        'MaxLabels' => 15,
                        'MinConfidence' => 80,
                    ]);

                    $result = $result['Labels'];
                    $datos =[];
                    $i=0;
                    foreach($result as $res){
                        $datos[$i] =$res['Name']; /// AQUI ESTAN LAS ETIQUETAS DE LA IA EN FOTOS
                        $i++;
                    }

                    $descripciones = Label::where('tipo_denuncia',$tipo_denuncia)->get(); //DATOS PARA COMPARAR CON LA IA
                    $contiene = False;
                    foreach($descripciones as $descrip){
                                if(in_array($descrip->label,$datos)){
                                    $contiene = True;
                                    break;
                                }
                    }

                    if($contiene){
                        $result = $cliente->detectLabels([
                            'Image' => [
                                'Bytes' => file_get_contents($url2),
                            ],
                            'MaxLabels' => 15,
                            'MinConfidence' => 80,
                        ]);

                        $result = $result['Labels'];
                        $datos =[];
                        $i=0;
                        foreach($result as $res){
                            $datos[$i] =$res['Name']; /// AQUI ESTAN LAS ETIQUETAS DE LA IA EN FOTOS
                            $i++;
                        }

                        $descripciones = Label::where('tipo_denuncia',$tipo_denuncia)->get(); //DATOS PARA COMPARAR CON LA IA
                        $contiene = False;
                        foreach($descripciones as $descrip){
                                    if(in_array($descrip->label,$datos)){
                                        $contiene = True;
                                        break;
                                    }
                        }
                  

                    if($contiene){
                        if($this->analizarDescripcion($request['descripcion'])===True){
                            $datosHash = hash('sha1',$request['descripcion'].''.$request['tipo_denuncia']);
                                    $denuncia = Denuncia::create([
                                    'titulo' =>$titulo,
                                    'descripcion' => $descripcion,
                                    'latitud' => $latitud,
                                    'longitud' =>$longitud,
                                    'tipo_denuncia' =>$tipo_denuncia,
                                    'fecha' => $fecha,
                                    'hora' => $hora,
                                    'user_id' => $user_id->id,
                                    'hash' => $datosHash,
                                   ]);

                        $denuncia_foto  = FotoDenuncia::create([
                                'denuncia_id' => $denuncia->id,
                                'url' => $url1,
                                'id_url' =>234234,
                                'estado' => 1,
                        ]);
                        $denuncia_foto  = FotoDenuncia::create([
                            'denuncia_id' => $denuncia->id,
                            'url' => $url2,
                            'id_url' =>234234,
                            'estado' => 1,
                        ]);

                        return response()->json([
                            'res' => True,
                            'labels' => 'Denuncia Creada Con Exito',
                           
                        ]);
                    }
                    }else{
                        return response()->json([
                            'res' => False,
                            'mensaje' => 'Datos erroneos',
                        ]);

                    }
                    
                    
                   

                }else{
                    // SI LLEGAMOS AQUI, SOLAMENTE TENEMOS UNA IMAGEN,LA IMAGEN1

                    $result = $cliente->detectLabels([
                        'Image' => [
                            'Bytes' => file_get_contents($url1),
                        ],
                        'MaxLabels' => 15,
                        'MinConfidence' => 80,
                    ]);

                    $result = $result['Labels'];
                    $datos =[];
                    $i=0;
                    foreach($result as $res){
                        $datos[$i] =$res['Name']; /// AQUI ESTAN LAS ETIQUETAS DE LA IA EN FOTOS
                        $i++;
                    }

                    $descripciones = Label::where('tipo_denuncia',$tipo_denuncia)->get(); //DATOS PARA COMPARAR CON LA IA
                    $contiene = False;
                    foreach($descripciones as $descrip){
                                if(in_array($descrip->label,$datos)){
                                    $contiene = True;
                                    break;
                                }
                    }

                    if($contiene){
                        if($this->analizarDescripcion($request['descripcion'])){
                            $datosHash = hash('sha1',$request['descripcion'].''.$request['tipo_denuncia']);
                                    $denuncia = Denuncia::create([
                                    'titulo' =>$titulo,
                                    'descripcion' => $descripcion,
                                    'latitud' => $latitud,
                                    'longitud' =>$longitud,
                                    'tipo_denuncia' =>$tipo_denuncia,
                                    'fecha' => $fecha,
                                    'hora' => $hora,
                                    'user_id' => $user_id->id,
                                    'hash' => $datosHash,
                                   ]);

                        $denuncia_foto  = FotoDenuncia::create([
                                'denuncia_id' => $denuncia->id,
                                'url' => $url1,
                                'id_url' =>234234,
                                'estado' => 1,
                        ]);

                        return response()->json([
                            'res' => true,
                            'mensaje' => 'Denuncia Creada Con exito',
                        ]);

                        }

                    }



                    return response()->json([
                        'res' => False,
                        'mensaje' => 'Datos erroneos',
                    ]);
                    
                }
            }
        }


                return response()->json([
                    'res' => False,
                    'mensaje' =>'Inserte imagenes de la denuncia',
                ]);

    }


    // public function sendMessage(Request $request)
    // {
    //     return response()->json([
    //         'res' => True,
    //     ]);
    // }



    public function analizarDescripcion($descripcion){

        return True;
    }


    // public function analizarDescripcion(Request $request){

    //     $apiKey = config('services.openai.api_key');

    //     OpenAI::setApiKey($apiKey);

    //     $response = OpenAI\Completion::create([
    //         'model' => 'text-davinci-003',
    //         'prompt' => 'Devuelveme solo verdadero o falso si el texto despues de los 2 puntos tiene lenguaje ofensivo'.':'.$request['descripcion'],
    //         'max_tokens' => 50,
    //         'temperature' => 0.7,
    //         'n' => 1,
    //         'stop' => null,
    //     ]);

    //     $answer = $response['choices'][0]['text'];

    //     return response()->json([
    //         'Respuesta'=> $answer
    //     ]);

    // }



    public function index()
    {
        //
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
