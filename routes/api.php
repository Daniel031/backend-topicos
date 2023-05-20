<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registro\RegistroController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/** RUTAS DE REGISTROS "LOGIN" PARA LOS USUARIOS  */

Route::post('/users',[RegistroController::class,'registrar']);
Route::post('/users-login',[RegistroController::class,'login']);


// Route::middleware(['auth', 'sanctum'])->group(function () {

//     Route::post('/user-logout',[RegistroContoller::class,'logout']);

// });


Route::group(['middleware'=>['auth:sanctum']],function(){

    Route::post('/user-logout',[RegistroController::class,'logout']);
    // Route::get('/usuarios',[RegistroController::class,'usuarios']);
});




