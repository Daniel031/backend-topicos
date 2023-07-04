<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\TipoDenunciaController;
use App\Http\Controllers\BuzonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('administrativo')->name('administrativos.')->middleware(['auth'])->group(function(){

    
    Route::get('/indexAdmin',[UserController::class,'index'])->name('index');
    Route::get('/showAdmin/{admin}',[UserController::class,'show'])->name('show');
    Route::get('createAdmin',[UserController::class,'create'])->name('create');
    Route::post('storeAdmin',[UserController::class,'store'])->name('store');
    Route::get('editAdmin/{admin}',[UserController::class,'edit'])->name('edit');
    Route::post('updateAdmin/{admin}',[UserController::class,'update'])->name('update');
    Route::delete('deleteAdmin/{admin}',[UserController::class,'destroy'])->name('destroy');
    Route::get('/denunciasAdmin',[UserController::class,'misDenuncias'])->name('misDenuncias');


});


Route::prefix('area')->name('areas.')->middleware(['auth'])->group(function(){

    Route::get('/indexArea',[AreasController::class,'index'])->name('index');
    Route::get('/showArea/{area}',[AreasController::class,'show'])->name('show');
    Route::get('/createArea',[AreasController::class,'create'])->name('create');
    Route::post('/storeArea',[AreasController::class,'store'])->name('store');
    Route::get('/editArea/{area}',[AreasController::class,'edit'])->name('edit');
    Route::post('/updateArea/{area}',[AreasController::class,'update'])->name('update');
    Route::delete('/deleteArea/{area}',[AreasController::class,'destroy'])->name('destroy');


});



Route::prefix('tipo_denuncia')->name('tipos_denuncias.')->middleware(['auth'])->group(function(){

    Route::get('/indexTipoDenuncia',[TipoDenunciaController::class,'index'])->name('index');
    Route::get('/showTipoDenuncia/{tipoDenuncia}',[TipoDenunciaController::class,'show'])->name('show');
    Route::get('/createTipoDenuncia',[TipoDenunciaController::class,'create'])->name('create');
    Route::post('/storeTipoDenuncia',[TipoDenunciaController::class,'store'])->name('store');
    Route::get('/editTipoDenuncia/{tipoDenuncia}',[TipoDenunciaController::class,'edit'])->name('edit');
    Route::post('/updateTipoDenuncia/{tipoDenuncia}',[TipoDenunciaController::class,'update'])->name('update');
    Route::delete('/deleteTipoDenuncia/{tipoDenuncia}',[TipoDenunciaController::class,'destroy'])->name('destroy');


});

Route::prefix('buzon')->name('buzon.')->middleware(['auth'])->group(function(){

    Route::get('/indexBuzonDenuncias',[BuzonController::class,'index'])->name('index');
    Route::get('/showDenuncia/{denuncia}',[BuzonController::class,'show'])->name('show');
    // Route::get('/createTipoDenuncia',[TipoDenunciaController::class,'create'])->name('create');
    // Route::post('/storeTipoDenuncia',[TipoDenunciaController::class,'store'])->name('store');
    // Route::get('/editTipoDenuncia/{tipoDenuncia}',[TipoDenunciaController::class,'edit'])->name('edit');
    Route::post('/updateDenuncia/{denuncia}',[BuzonController::class,'update'])->name('update');
    // Route::delete('/deleteTipoDenuncia/{tipoDenuncia}',[TipoDenunciaController::class,'destroy'])->name('destroy');


    Route::get('/mapaDenuncias',[BuzonController::class,'mapas'])->name('mapa');


});
