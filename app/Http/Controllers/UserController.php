<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Administrativo;

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
            'password'=>bcrypt('123456789'),
            'administrativo' => 1,
            'area_id'=>$request['area_id'],
            'estado' =>1,
        ]);

        return back();


        
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrativo $admin)
    {
        return view('users.show-users',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrativo $admin)
    {
        $areas = Area::get();
        return view('users.edit-users',compact('admin','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrativo $admin)
    {
        $admin->update($request->all);      //
        return view('users.main-users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrativo $admin)
    {
        $admin->update([
            'estado'=>0,
        ]);
        return view('users.main-users');
    }
}
