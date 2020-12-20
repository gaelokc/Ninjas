<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NinjaController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\MissionController;

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
Route::middleware('auth:api')->prefix('ninjas')->group(function () {
	Route::post('/crear',[NinjaController::class,"crearNinja"]);
	Route::post('/modificar/{id}',[NinjaController::class,"modificarNinja"]);
	Route::post('/borrar/{id}',[NinjaController::class,"bajaNinja"]);
	Route::get('/consultar/{id}',[NinjaController::class,"verNinja"]);
	Route::get('/',[NinjaController::class,"listarNinjas"]);
	Route::get('/filtrar',[NinjaController::class,"listarNinjasFiltro"]);
});

Route::middleware('auth:api')->prefix('employers')->group(function () {
	Route::post('/crear',[EmployerController::class,"crearCliente"]);
	Route::post('/modificar/{id}',[EmployerController::class,"modificarCliente"]);
	Route::get('/consultar/{id}',[EmployerController::class,"verCliente"]);
});

Route::middleware('auth:api')->prefix('missions')->group(function () {
	Route::post('/crear',[MissionController::class,"crearMision"]);
	Route::get('/consultar/{id}',[MissionController::class,"verMision"]);
	Route::post('/modificar/{id}',[MissionController::class,"modificarMision"]);
});
