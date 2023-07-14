<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoDenuncia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Denuncia;
use App\Models\FotoDenuncia;
use App\Models\User;
use App\Models\Area;
use App\Models\Comentario;
use ExpoSDK\Expo;
use ExpoSDK\ExpoMessage;

class BuzonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $miArea = auth()->user()->area_id;
            $areas=TipoDenuncia::where('area_id','=',$miArea)->get();   // tipos de denuncias del usuario
            $datos=[];
            $i=0;
            $pedidos = new Collection([]);
    
            foreach($areas as $area){
                $pedidos = DB::table('denuncias')
                    ->join('tipos_denuncia','tipos_denuncia.id' , '=', 'denuncias.tipo_denuncia')
                    ->where('denuncias.tipo_denuncia', $area->id)
                    ->select('denuncias.*')->get();
                    if(count($pedidos) > 0){
                        $datos[$i]=$pedidos;
                        $i=$i+1;
                    }
    
            }
            return view('buzon.buzon-main',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
    public function show(Denuncia $denuncia)
    {
        $areas = Area::get();
        $fotos = FotoDenuncia::where('denuncia_id','=',$denuncia->id)->get(); // fotos de la denuncia
        $tiposDenuncias = TipoDenuncia::get();
        $users = User::get();
        return view('buzon.buzon-show',compact('denuncia','fotos','tiposDenuncias','users','areas'));  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Denuncia $denuncia)
    {
         $denuncia->estado=$request['estado'];
         $denuncia->save();

         // AQUI TIENE QUE VENIR LA NOTIFICACION PUSH PARA EL USER(APP) -- PROXIMO SPRINT// Y ACTUALIZAR EL COMENTARIO DE LA DENUNCIA
         $enviar="";
         if($denuncia->estado == 1){
            $enviar ="Su denuncia esta pendiente";
        }
         else
         if($denuncia->estado ==2){
            $enviar ="Su denuncia esta Aceptada";
         }else{
            $enviar ="Su denuncia esta Rechazada";
         
         }
         $messages = [
            new ExpoMessage([
                'title' => $enviar,
                'body' =>$request['comentario'],
            ]),
        ];
        
        /**
         * These recipients are used when ExpoMessage does not have "to" set
         */
        $defaultRecipients = [
            'ExponentPushToken[mL9yxeBSP8mXwJyskWuGqq]'
        ];
        
        (new Expo)->send($messages)->to($defaultRecipients)->push();

        $comentario = Comentario::create([
            'mensaje' => $request['comentario'],
            'denuncia_id'=>$denuncia->id,
            'user_id'=> $denuncia->user_id,
            'datos' => $denuncia->descripcion,
        ]);
         
        return redirect()->route('buzon.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        return redirect()->route('buzon-main');
    }

    public function mapas(){
        $miArea = auth()->user()->area_id;
            $tipos=TipoDenuncia::where('area_id','=',$miArea)->get();   // tipos de areas del usuario
            $datos=[];
            $i=0;
            $pedidos = new Collection([]);
    
            foreach($tipos as $tipo){
                $pedidos = DB::table('denuncias')
                    ->join('tipos_denuncia','tipos_denuncia.id' , '=', 'denuncias.tipo_denuncia')
                    ->where('denuncias.tipo_denuncia', $tipo->id)
                    ->select('denuncias.*')->get();
                    if(!count($pedidos)){
                        $datos[$i]=$pedidos;
                        $i=$i+1;
                    }
    
            }

            // dd($datos);
            
            return view('buzon.buzon-mapa',compact('datos'));
    }

    public function mapaPublico(){
        return view('map');

    }
}
