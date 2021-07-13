<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MarkFasecController;
use App\Http\Controllers\source\EquidadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get("sync-database-tables", [EquidadController::class, "get_syncDatabaseTables"]);
Route::get("show-soap-data", [EquidadController::class, "get_showImportantDetails"]);

Route::post('post-todo-riesgo', [MarkFasecController::class, 'post_showVehicleDataHTML']);
Route::get('post-todo-riesgo', [MarkFasecController::class, 'post_showVehicleDataHTML']);
Route::get('/mark-fasecolda/get-by-name/{refName}', [MarkFasecController::class, 'get_getMarkByName']);

Route::view("/", "home")->name('home');
Route::view('/todo-riesgo', 'todo-riesgo');
//Route::view('/todo-riesgo-list', 'todo-riesgo-list');

Route::get('todo-riesgo-list/{id}', [FormController::class, 'post_showRegistroHTML']);
//Route::post('todo-riesgo-list', [FormController::class, 'post_showRegistroHTML']);

Route::post('error-cotizacion/{id}', [FormController::class, 'error_cotizaHTML']);
Route::view('error-cotizacion', 'error-cotizacion');

Route::get('/todo-riesgo-list/{id}/{segu}', [FormController::class, 'get_detalle']);

//Route::post('/excel', [FormController::class, 'exportpdf'])->name('excel');
Route::get('/excel/{seguro}/{id}/{num}', [FormController::class, 'exportpdf']);
Route::get('/excel/{seguro}/{id}', [FormController::class, 'generarpdf']);
//Route::post('/vehicle/register-vehicle', [FormController::class, 'post_createNewForm']);
Route::get('/city/get-by-name/{cityName}', [CityController::class, 'get_getCityByName']);

//Route::view('mail', 'mail.usuario_error');
