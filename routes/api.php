<?php

use App\Http\Controllers\DenunciasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registro\RegistroController;
use App\Http\Controllers\Registro\VerificarEmailController;
use App\Http\Controllers\Registro\ComprobarRostroController;

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

Route::post('/users',[RegistroController::class,'registrar']); // se crean sus datos en la base de datos
Route::post('/users-emailVerify',[RegistroController::class,'sendEmailConfirmation']); // envia un correo de confirmacion a un usuario
Route::post('/users-login',[RegistroController::class,'login']); // se loguea el user

Route::post('/users-comprobacion',[ComprobarRostroController::class,'comparar']); // se envia la foto para aws

Route::post('/users-saveAppToken',[RegistroController::class,'saveToken']);

Route::post('/users-actualizarContraseña',[RegistroController::class,'actualizarContraseña']); // se envia la foto para aws
// Route::get('/users-send',[VerificarEmailController::class,'formularioDatos']);
// Route::post('/users-verificar',[VerificarEmailController::class,'enviar'])->name('users.formulario');


//ruta post que escribio jose luis padilla
Route::post('/users-codigoVerificacionEmail',[VerificarEmailController::class,'VerificarCodigoEmail']);
Route::post('/users-emailNoRegistrado',[VerificarEmailController::class,'EmailNoRegistrado']);
//ruta post que escribio jose luis padilla para recibir las denuncias y analizar su data
Route::post('/users-denunciar',[DenunciasController::class,'denunciar']);



Route::get('/users-analizar',[DenunciasController::class,'sendMessage']);


Route::get('/users-denuncias',[DenunciasController::class,'mostrarDenunciasUsuario']);


Route::post('/index',[DenunciasController::class,'index']);
// Route::middleware(['auth', 'sanctum'])->group(function () {

//     Route::post('/user-logout',[RegistroContoller::class,'logout']);

// });


Route::group(['middleware'=>['auth:sanctum']],function(){

    Route::post('/user-logout',[RegistroController::class,'logout']);
    // Route::get('/usuarios',[RegistroController::class,'usuarios']);
});


Route::get('/users-filtros',[DenunciasController::class,'filtrar']);


Route::post('/users-actualizar',[DenunciasController::class,'update']);

Route::post('/users-eliminar',[DenunciasController::class,'destroy']);





Route::get('/denuncias-filtradas',[DenunciasController::Class,'filtrarUser']);


// ESTA ES RUTA DE ABAJO ES PARA LOS FILTROS POR USER
Route::post('/filtrar-denuncias',[DenunciasController::Class,'filtrarDenuncia']);      // para los users en uso

// TIPOS DE DENUNCIAS PARA MOSTRAR EN LA APP MOVIL
Route::get('/tipos-denuncias',[DenunciasController::class,'tiposDenuncias']);



