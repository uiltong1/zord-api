<?php

use App\Http\Controllers\DesenvolvedoresController;
use App\Http\Controllers\NiveisController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', function () {
    return response()->json([
        'message' => 'Api online'
    ]);
});


Route::resource('niveis', NiveisController::class)->except('update');
Route::put('/niveis/{nivel}', [NiveisController::class, 'update']);

Route::resource('desenvolvedores', DesenvolvedoresController::class)->except('update');
Route::put('/desenvolvedores/{desenvolvedor}', [DesenvolvedoresController::class, 'update']);
