<?php

use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\SimulacaoCreditoController;
use Illuminate\Support\Facades\Route;

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

// API v1
Route::prefix('v1')->group(function () {
    // Rotas públicas
    Route::group(['middleware' => ['throttle:api']], function () {
        // Rotas para convênios
        Route::apiResource('convenios', ConvenioController::class)->only(['index', 'show']);
        
        // Rotas para instituições
        Route::apiResource('instituicoes', InstituicaoController::class)->only(['index', 'show']);
        
        // Rota para simulação de crédito
        Route::post('/simulacao-credito', [SimulacaoCreditoController::class, 'simular']);
    });
    
  
});