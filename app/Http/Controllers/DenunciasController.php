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
use Illuminate\Support\Facades\Http;


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

        $hashPrueba = hash('sha1',$request['descripcion'].''.$request['tipo_denuncia']);
        $denunciasPruebas = Denuncia::where('user_id',$user_id)->where('estado','=','1')->get();

            foreach($denunciasPruebas as $den){
                    if($den->hash == $hasPrueba){
                        return response()->json([
                            'res' => False,
                            'mensaje' => 'Denuncia Ingresada Anteriormente',
                        ]);
                    }
            }

        
            

        $cliente = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' =>'latest'
        ]);

            if($request->hasFile('imagen1')){

                 $imagen1 = $request->file('imagen1');
                 $fotoCloud1 =Cloudinary::upload($imagen1->getRealPath(),['folders'=>'fotografos']);
                 $public_id_imagen1=$fotoCloud1->getPublicId();
                 $url1 =$fotoCloud1->getSecurePath();

                    if($request->hasFile('imagen2')){           // SI ENTRA AQUI TIEN2 2 IMAGENES

                        $imagen2 = $request->file('imagen2');
                        $fotoCloud2 =Cloudinary::upload($imagen2->getRealPath(),['folders'=>'fotografos']);
                        $public_id_imagen2=$fotoCloud2->getPublicId();
                        $url2 =$fotoCloud2->getSecurePath();

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

                        if($contiene){  // si contiene hay que analizar la imagen 2 y subir el contien es de la imagen1

                            $result = $cliente->detectLabels([  // aqui se analiza la imagen2
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

                            if($contiene){      // SI LA IMAGEN 2 ES CORRECTA SE ANALIZA LA DESCRIPCION
                                if($this->analizarDescripcion($request['descripcion'])=="F"){
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

                                return response()->json([
                                    'res' => False,
                                    'labels' => 'Descripcion es ofensiva',
                                
                                ]);

                            
                            }


                        }

                        // si llega aqui la imagen 1 no tiene relacion es error
                        return response()->json([
                            'res'=> False,
                            'mensaje' => 'Las Fotos son acorde a la denuncia',
                        ]);


                    }

                // AQUI SOLO HAY IMAGEN1 NO TIENE IMAGEN2
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
                        if($this->analizarDescripcion($request['descripcion'])=='F'){
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
                                'res' => True,
                                'mensaje' => 'Denuncia Creada Con exito',
                            ]);

                        }
                        
                        return response()->json([
                            'res' => False,
                            'mensaje'=>'La Descripcion es Ofensiva'
                        ]);

                    }
                    
                    return response()->json([
                        'res' => False,
                        'mensaje' => 'Imagen no acorde a la denuncia',
                    ]);
                
            }
            // aqui la imagen no tiene ninguna foto     ABAJO DE ESTE CODIGO ES EL FINAL DEL METODO

        return response()->json([
            'res' => False,
            'mensaje' => 'Denuncia sin imagenes',
        ]);


    }
    /*public function denunciar(Request $request){
      
        
        $titulo =$request['titulo'];
        $descripcion = $request['descripcion'];
        $fecha = date("m.d.y"); 
        $hora = date("H:i:s");
        $latitud = $request['latitud'];
        $longitud = $request['longitud'];
        $tipo_denuncia = $request['tipo_denuncia'];


        $email = $request['email'];
        $user_id = User::where('email',$email)->first();

        // return response()->json([
        //     'DA ERROR' => $request['imagen1']
        // ]);

        // $datoChat = $this->analizarDescripcion('Dilker Cartagena Pedraza');
        // return response()->json([
        //     'Datos Den' => $datoChat,
        //     'imagenes' =>$request['imagen1']
        // ]);
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
                                    if($this->analizarDescripcion($request['descripcion'])=="F"){
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
                                                'mensaje' => 'Descripcion Ofensiva',
                                            ]);

                                        }

                                    return response()->json([
                                        'res' => False,
                                        'mensaje' => 'Datos Imagen no coincide',
                                    ]);

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
                        if($this->analizarDescripcion($request['descripcion'])=="F"){
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
                        'mensaje' => 'Foto no coincide con la denuncia',
                    ]);
                }
            }
        

        }

                return response()->json([
                    'res' => False,
                    'mensaje' =>'Inserte imagenes para la denuncia',
                ]);

    }*/


    public function analizarDescripcion($descripcion)
    {
        $mensaje = 'Responde solamente True si el texto despues de los 2 puntos tiene lenguaje ofensivo y responde con False si no tiene lenguaje ofensivo:'.$descripcion;

        $datos = Http::withHeaders([
            'Content-type' =>'application/json',
            'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions',[
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    'role' => 'user',
                    'content' => $mensaje
                ]
                ],
            'temperature' => 0.5,
            'max_tokens' => 200,
            'top_p' => 1.0,
            'frequency_penalty' => 0.52,
            'presence_penalty' => 0.5,
            'stop' => ["11."],
            ])->json();

            return substr($datos['choices'][0]['message']['content'],0,1);
    }




    public function sendMessage(Request $request){
        $mensaje = 'Responde solamente True si el texto despues de los 2 puntos tiene lenguaje ofensivo y responde con False si no tiene lenguaje ofensivo :'.$request['descripcion'];

        $datos = Http::withHeaders([
            'Content-type' =>'application/json',
            'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions',[
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    'role' => 'user',
                    'content' => $mensaje
                ]
                ],
            'temperature' => 0.5,
            'max_tokens' => 200,
            'top_p' => 1.0,
            'frequency_penalty' => 0.52,
            'presence_penalty' => 0.5,
            'stop' => ["11."],
            ])->json();
            $dat = substr($datos['choices'][0]['message']['content'],0,1)==="F";
            // $t ='F';
            // $re = $dat ==$t,

            return response()->json(['res'=>substr($datos['choices'][0]['message']['content'],0,1),'datos' => $dat]);

    }



    // public function analizarDescripcion($descripcion){

    //     return True;
    // }


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

    public function mostrarDenunciasUsuario(Request $request){
        
        $user = User::where('email', $request['email'])->first();

        $listaDenuncias = Denuncia::where('user_id',$user->id)->where('estado','=','1')->get();
        
            foreach($listaDenuncias as $denuncia){

                    $fotos = FotoDenuncia::where('denuncia_id',$denuncia->id)->get();
                    $nombre="imagen1";
                        foreach($fotos as $actual){
                            $denuncia[$nombre]=$actual->url;
                            $nombre="imagen2";

                        }

            }
        
        return response()->json([
            'res' => true,
            'mensaje' => "lista de denuncias hechas por un usuario",
            'data' => $listaDenuncias,
        ]);


    }



    public function index()
    {
        $denuncias = Denuncia::where('user_id',"=","3")->get();
        return response()->json([
            'datos'=> $denuncias,
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



    public function update(Request $request){

        $titulo = $request['titulo'];
        $descripcion =$request['descripcion'];
        $tipo_denuncia =$request['tipo_denuncia'];
        $fecha = Carbon::now();
        $denuncia_id =$request['denuncia_id'];
        $fecha = date("m.d.y"); 
        $hora = date("H:i:s");
        $latitud = $request['latitud'];
        $longitud = $request['longitud'];
        $email =$request['email'];
        $user =User::where('email',$email)->first();
        $denuncia = Denuncia::where('id',$denuncia_id)->where('user_id',$user->id)->first();


        $fotosDenuncia =FotoDenuncia::where('denuncia_id',$denuncia_id)->get();

        $cliente = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' =>'latest'
        ]);


            if($request->hasFile('imagen1')){

                 $imagen1 = $request->file('imagen1');
                 $fotoCloud1 =Cloudinary::upload($imagen1->getRealPath(),['folders'=>'fotografos']);
                 $public_id_imagen1=$fotoCloud1->getPublicId();
                 $url1 =$fotoCloud1->getSecurePath();

                 if($request->hasFile('imagen2')){

                    
                        $imagen2 = $request->file('imagen2');
                        $fotoCloud2 =Cloudinary::upload($imagen2->getRealPath(),['folders'=>'fotografos']);
                        $public_id_imagen2=$fotoCloud2->getPublicId();
                        $url2 =$fotoCloud2->getSecurePath();

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

                            $result = $cliente->detectLabels([  // aqui se analiza la imagen2
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
                                    if($this->analizarDescripcion($request['descripcion'])=="F"){
                                        $datosHash = hash('sha1',$request['descripcion'].''.$request['tipo_denuncia']);
                                                $denuncia->update([
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
    
                                       
                                        foreach($fotosDenuncia as $fotoActual){
                                            $fotoActual->url=$url1;
                                            $fotoActual->id_url=5641;
                                            $fotoActual->save();
                                            $url1=$url2;
                                            
                                        }
    
                                        return response()->json([
                                            'res' => True,
                                            'labels' => 'Denuncia Actualizada Con Exito',
                                        
                                        ]);
                                    } 
    
                                    return response()->json([
                                        'res' => False,
                                        'labels' => 'Descripcion es ofensiva',
                                    
                                    ]);
                                }
                        }

                        return response()->json([
                            'res'=> False,
                            'mensaje' => 'Las Fotos son acorde a la denuncia',
                        ]);



                 }

                 // AQUI SOLO HAY IMAGEN1 NO TIENE IMAGEN 2 

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
                        if($this->analizarDescripcion($request['descripcion'])=='F'){
                            $datosHash = hash('sha1',$request['descripcion'].''.$request['tipo_denuncia']);
                                $denuncia->update([
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

                            $fotosDenuncia->update([
                                'url'=> $url1,
                                'id_url' =>5312,
                            ]);

                            return response()->json([
                                'res' => True,
                                'mensaje' => 'Denuncia Actualizada Con exito',
                            ]);

                        }
                    
                        return response()->json([
                            'res' => False,
                            'mensaje'=>'La Descripcion es Ofensiva'
                        ]);

                    }

                        return response()->json([
                            'res' => False,
                            'mensaje'=>'Imagen No corresponde al Denuncia',
                        ]);
            }
        
        
            return response()->json([
                    'res' => False,
                    'mensaje' => 'Denuncia sin imagenes',
            ]);
    

    }


    /*public function update(Request $request)
    {
        $titulo = $request['titulo'];
        $descripcion =$request['descripcion'];
        $tipo_denuncia =$request['tipo_denuncia'];
        $fecha = Carbon::now();
        $denuncia_id =$request['denuncia_id'];
        $fecha = date("m.d.y"); 
        $hora = date("H:i:s");
        $latitud = $request['latitud'];
        $longitud = $request['longitud'];
        $email =$request['email'];
        $user =User::where('email',$email)->first();
        $denuncia = Denuncia::where('id',$denuncia_id)->where('user_id',$user->id)->first();
        $fotosDenuncia =FotoDenuncia::where('denuncia_id',$denuncia_id)->get();

        $cliente = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' =>'latest'
        ]);
        
            if($request->hasFile('imagen1')){

                $imagen1 = $request->file('imagen1');
                
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

                            if($this->analizarDescripcion($request['descripcion'])=="F"){
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
    
                                       $denuncia_foto = FotoDenuncia::where('denuncia_id',$denuncia_id)->get();
                                       foreach($denuncia_foto as $de){
                                           $de->update([
                                               'denuncia_id' => $denuncia->id,
                                               'url' => $url1,
                                               'id_url' =>2234,
                                               'estado' => 1,
                                           ]);
                                           $url1=$url2;
           
           
                                       }
    
                                return response()->json([
                                    'res' => True,
                                    'labels' => 'Denuncia Creada Con Exito',
                                
                                ]);
                            }
                        }else{
                            return response()->json([
                                'res' => False,
                                'mensaje' => 'Fotos Erroneas',
                            ]);
                        }



                    }
                }else{

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
                        if($this->analizarDescripcion($request['descripcion'])=="F"){
                            $datosHash = hash('sha1',$request['descripcion'].''.$request['tipo_denuncia']);
                                    $denuncia = Denuncia::where('denuncia_id',$denuncia_id)->first();
                                    $denuncia->update([
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
                             
                            $denuncia_foto = FotoDenuncia::where('denuncia_id',$denuncia_id)->get();
                            foreach($denuncia_foto as $de){
                                $de->update([
                                    'denuncia_id' => $denuncia->id,
                                    'url' => $url1,
                                    'id_url' =>234234,
                                    'estado' => 1,
                                ]);
                                $url1=$url2;


                            }
                            

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

            return response()->json([
                'res' => False,
                'mensaje' =>'Inserte imagenes de la denuncia',
            ]);
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = auth()->user()->id;
        $denuncia_id =$request['denuncia_id'];
        $denuncia =Denuncia::find($denuncia_id);
        if($denuncia){
            $denuncia->estado=0;
            $denuncia->save();

            $fotoDenuncia = FotoDenuncia::where('denuncia_id',$denuncia_id)->get();
            
            foreach($fotoDenuncia as $foto){
                $foto->estado =0;
                $foto->save();
            }
            
            return response()->json([
                'res' =>True,
                'mensaje' =>'Denuncia Borrada',
                'denuncia'=> $denuncia,
            ]);

        }
    
        return response()->json([
            'res' => False,
            'mensaje' => 'La Denuncia No Existe'
        ]);
        
       
    }

}
