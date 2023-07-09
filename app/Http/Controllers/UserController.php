<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
// use App\Models\Administrativo;
use App\Models\Denuncia;
use App\Models\TipoDenuncia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
       return view('users.main-users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::get();       // el usuario puede pertenecer solamente a una area
         return view('users.create-users',compact('areas'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        $newUser = User::create([
            'name'=>$datos['name'],
            'email'=>$datos['email'],
            'password'=>bcrypt($request['password']),
            'administrativo' => 1,
            'area_id'=>$request['area_id'],
            'estado' =>1,
        ]);

        return redirect()->route('administrativos.index');


        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        return view('users.show-users',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        $areas = Area::get();
        return view('users.edit-users',compact('admin','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,User $admin)
    {
        $admin->password=$request['password'];
        $admin->name=$request['name'];
        $admin->email=$request['email'];
        $admin->area_id=$request['area_id'];
        $admin->save();
        return redirect()->route('administrativos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin->estado=$admin->estado?0:1;
        $admin->save();
        return redirec()->route('administrativos.index');
    }



    // public function misDenuncias(){

    //     $miArea = auth()->user()->area_id;
    //     // dd($miArea);
    //     $areas=TipoDenuncia::where('area_id','=',$miArea)->get();   // tipos de areas del usuario
    //     $datos=[];
    //     $i=0;
    //     $pedidos = new Collection([]);

    //     foreach($areas as $area){
    //         $pedidos = DB::table('denuncias')
    //             ->join('tipos_denuncia','tipos_denuncia.id' , '=', 'denuncias.tipo_denuncia')
    //             ->where('denuncias.tipo_denuncia', $area->id)
    //             ->select('denuncias.*')->get();
    //             if($pedidos){
    //                 $datos[$i]=$pedidos;
    //                 $i=$i+1;
    //             }

    //     }
    //     return view('users.buzon-users',compact('datos'));
    // }
}
