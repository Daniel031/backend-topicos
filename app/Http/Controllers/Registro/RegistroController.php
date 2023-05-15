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
        
            if(! $user || !Hash::check($request['password'],$user->password)){
                return response()->json([
                    'res' => False,
                    'mensaje' => "Datos Incorrectos",
                ]);
            }

            $token =$user->createToken($request['email'])->plainTextToken;
            $user->update([
                'creacion_token' => Carbon::now()
            ]);

            return response()->json([
                'res' => true,
                'token' => $token,
                'mensaje' => 'Login Exitoso',
            ]);
    }


    public function logout(LoginRequest $request){

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'res' => true
        ]);
    }
}
