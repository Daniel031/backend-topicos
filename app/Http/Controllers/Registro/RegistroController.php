<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrarRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    

    public function registrar(RegistrarRequest $request){

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' =>bcrypt($request['password']),
            'ultimo_cambio_password' => Carbon::now(),
        ]);

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
