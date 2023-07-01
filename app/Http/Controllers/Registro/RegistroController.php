<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrarRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Contraseña;
use App\Models\User;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Hash;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PhpParser\Node\Stmt\Foreach_;

class RegistroController extends Controller
{
    

    public function registrar(RegistrarRequest $request){
        $email = $request['email'];
        $email = $request['email'];
        $user = User::where('email', $request['email'])->first();
        if ($user) {
                return response()->json([
                    'res' => false,
                    'mensaje' => 'El usuario ya se encuentra registrado'
                ],200);
        }


        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' =>bcrypt($request['password']),
            'ultimo_cambio_password' => Carbon::now()
        ]);

        $contraseña = Contraseña::create([
            'password'=>bcrypt($request['password']),
            'activo'=>1,
            'user_id'=>$user->id,
        ]);

        return response()->json([
            'res' => true,
            'mensaje' => 'Usuario Creado con Exito',
            'status' => 200,
             
        ],200);


}
    public function sendEmailConfirmation(Request $request) {
        $email = $request['email'];
        $codigo=  rand(100000,999999);
        $user = User::where('email',$request['email'])->first();
        if (!$user) {            
            return response()->json([
                'res' => false,
                'mensaje' => 'El usuario no se encuentra registrado'
            ],400);
        }else{
            if ($user->email_verified_at) {
                return response()->json([
                    'res' => false,
                    'mensaje' => 'El usuario ya se encuentra registrado'
                ],400);   
            }
        }
        $user->codigo_verificacion = $codigo;
        $user->save();
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'dilker72@gmail.com';                     //SMTP username
            $mail->Password   = 'opfexbzzwbbagutj';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you 
            $mail->setFrom('dilker72@gmail.com', 'Denuncias Santa Cruz');
            $mail->addAddress($email);     //Add a recipient
          
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verificacion de Email';
            $mail->Body    = "Su codigo de verificacion es para el sistema de Denuncias es :  ". $codigo;
            $mail->send();

            return response()->json([
                'res' => true,
                'mensaje' => 'Se envio el codigo correctamente'
            ],200);

        } catch (Exception $e) {

            return response()->json([
                'res' => false,
                'mensaje' => 'Ocurrio Un Problemas con los datos',
                'status' => 500,   
            ],500);
    
        }
    }

    public function login(LoginRequest $request){
        
        $user = User::where('email',$request['email'])->first();
        
        if($user){
            if (!$user->email_verified_at) {
                return response()->json([
                    'res' => false,
                    'mensaje' => 'El usuario necesita verificar su correo'
                ],400);
            }
            if($user->fecha_desbloqueo){
                $fechaActual = Carbon::now();
                $minutos = $fechaActual->diffInMinutes($user->fecha_desbloqueo);
                    if($minutos>2){
                        $user->estado=1;
                        $user->intentos=0;
                        $user->fecha_desbloqueo=null;

                        // $user->save();

                        if($user && Hash::check($request['password'],$user->password)){
                            $token = $user->createToken($user->email)->plainTextToken;
                            $user->creacion_token=Carbon::now();
                            $user->save();

                            return response()->json([
                                'res' => true,
                                'token' => $token,
                            ]);

                            
                        }
                        $user->save();
                        return response()->json([
                            'res' => false,
                            'mensaje' => 'Usuario Desbloqueado Inicie con Datos correctos',
                        ]);
                    }
            }

        }
        
        
            if(! $user || !Hash::check($request['password'],$user->password)){
                
                 if($user){
                    $intentos = $user->intentos;
                    $user->intentos=$intentos+1;
                   
                    if($user->intentos === 3){
                        $user->estado=0;
                        $user->fecha_desbloqueo=Carbon::now();
                    }
                     $user->save();
                 }
                return response()->json([
                    'res' => False,
                    'mensaje' => "Datos Incorrectos",
                ]);
            }

            if($user->estado == 1){

                $user->estado=1;
                $user->intentos=0;
                $user->fecha_desbloqueo=null;
    
                $token =$user->createToken($request['email'])->plainTextToken;
                $user->fecha_desbloqueo=Carbon::now();
                $user->save();
    
                return response()->json([
                    'res' => true,
                    'token' => $token,
                    'mensaje' => 'Login Exitoso',
                   
                ]);
            }

            return response()->json([
                'res' => False,
                'mensaje' => "Usuario Bloqueado",
            ]);
            
           
    }



    public function actualizarContraseña(Request $request){

        $email = $request['email'];
        $passwordActual = $request['password_actual'];
        $passwordNuevo = $request['password_nuevo'];

        $user = User::where('email', $request['email'])->first();

        if($user){

           if(Hash::check($passwordActual, $user->password)){

            $listaPasswordUsuario = $user->contraseñas;
            $yaExistePassword = false;
 
            foreach ($listaPasswordUsuario as $passwordModelo) {
 
              if(Hash::check($passwordNuevo, $passwordModelo->password)){
                 $yaExistePassword = true;
                 break;
              } 
              
            }
 
            
            if(!$yaExistePassword){
 
            /*  Contraseña::where('activo', 1)
                         ->where('user_id',$user->id)
                         ->update(['activo'=> 0]); */
            $contraseña = Contraseña::where('user_id','=',$user->id)->where('activo', 1)->first();
            $contraseña->update([
                "activo"=>0,
            ]);
            /* $contraseña->save(); */
             Contraseña::create([ 
                 'password'=>bcrypt($passwordNuevo),
                 'activo'=>1,
                 'user_id'=> $user->id,
             ]);
 
             $user->password = bcrypt($passwordNuevo);
             $user->save();
             return response()->json([
                 'res' => true,
                 'mensaje' => "la contrseña ha sido actualizada",
             ]);
 
            }
 
                return response()->json([
                'res' => false,
                'mensaje' => "la contraseña no ha sido actualizada porque es repetida",
                ]);
           }

           return response()->json([
            'res' => false,
            'mensaje' => "la contraseña no ha sido actualizada porque la contraseña actual no corresponde a la contraseña que el usuario tiene asociada",
            ]);
           
        }

        return response()->json([
            'res' => false,
            'mensaje' => "el correo introducido no esta asociado a ningun usuario",
            ]);
        
    }


    public function logout(LoginRequest $request){

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'res' => true,
            'token' => 'Token eliminado Con Exito'
        ]);
    }
}
