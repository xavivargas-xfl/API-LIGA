<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\JugadorController;
use App\Http\Controllers\API\RegistroController;
use App\Http\Controllers\API\JuezController;
use App\Http\Controllers\API\DelegadoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('/pre-registro', [RegistroController::class,'store']);
Route::group(['Middleware'=>'api'],function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    //---------rutas jugador
    Route::get('/index/{id}', [JugadorController::class,'index']);
    Route::post('/add-jugador', [JugadorController::class,'store']);
    Route::get('/listar-jugador',[JugadorController::class,'show']);
    Route::put('/editar-jugador/{id}', [JugadorController::class,'update']);
    Route::delete('/eliminar-jugador/{id}', [JugadorController::class,'destroy']);
    //---------rutas juez
    Route::get('/index', [JuezController::class,'index']);
    Route::post('/add-juez', [JuezController::class,'store']);
    Route::get('/listar-juez/{id}', [JuezController::class,'show']);
    Route::put('/editar-juez/{id}', [JuezController::class,'update']);
    Route::delete('/eliminar-juez/{id}', [JuezController::class,'destroy']);
    //---------rutas delegado
    Route::get('/index/{id}', [DelegadoController::class,'index']);
    Route::post('/add-delegado', [DelegadoController::class,'store']);
    Route::get('/listar-delegado',[DelegadoController::class,'show']);
    Route::put('/editar-delegado/{id}', [DelegadoController::class,'update']);
    Route::delete('/eliminar-delegado/{id}', [DelegadoController::class,'destroy']);
});
