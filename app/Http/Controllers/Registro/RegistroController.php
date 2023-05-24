<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrarRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class RegistroController extends Controller
{
    

    public function registrar(RegistrarRequest $request){
        $email = $request['email'];
        $codigo=  rand(100000,999999);


        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' =>bcrypt($request['password']),
            'ultimo_cambio_password' => Carbon::now(),
            'codigo_verificacion' =>$codigo,
        ]);

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
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

        } catch (Exception $e) {

            return response()->json([
                'res' => false,
                'mensaje' => 'Ocurrio Un Problemas con los datos',
                'status' => 500,   
            ],500);
    
        }

        return response()->json([
            'res' => true,
            'mensaje' => 'Usuario Creado con Exito',
            'status' => 200,
             
        ],200);


}

       


    public function login(LoginRequest $request){
        
        $user = User::where('email',$request['email'])->first();
        
        if($user){
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



    public function cambiarContraseña(UpdatePasswordRequest $request){

        

    }


    public function logout(LoginRequest $request){

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'res' => true,
            'token' => 'Token eliminado Con Exito'
        ]);
    }
}
