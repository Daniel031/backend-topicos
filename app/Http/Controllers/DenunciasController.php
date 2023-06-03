<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\User;
use Illuminate\Http\Request;

class DenunciasController extends Controller
{
    
    public function denunciar(Request $request){
      
        

    }

    public function mostrarDenunciasUsuario(Request $request){
        
        $user = User::where('email', $request['email'])->first();

        $listaDenuncias = Denuncia::where('user_id',$user->id)->get();
        
        return response()->json([
            'res' => true,
            'mensaje' => "lista de denuncias hechas por un usuario",
            'data' => $listaDenuncias,
        ]);
    }


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
    public function show()
    {
        
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
