<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Doacao\{
    CategoriaDoacaoController,
    DoacaoSolicitadaController,
};
use App\Http\Controllers\Api\ModuloController;
use App\Http\Controllers\Api\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('login-google', [AuthController::class, 'loginGoogle']);
    Route::post('cadastrar', [AuthController::class, 'cadastrar']);
    Route::post('recuperar-senha', [AuthController::class, 'recuperarSenha']);
    Route::post('redefinir-senha', [AuthController::class, 'redefinirSenha']);
});


// Rotas autenticadas
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'user'], function(){
        Route::get('/', function (Request $request) {
            return $request->user();
        });        

        Route::get('/info-usuario', [UsuarioController::class, 'info'])->name('user.info');
        Route::post('/update', [UsuarioController::class, 'update'])->name('user.update');
    });

    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

    Route::get('/modulos', [ModuloController::class, 'index'])->name('modulos.index');

    Route::group(['prefix' => 'doacoes'], function(){
        Route::group(['prefix' => 'categorias'], function(){
            Route::get('/', [CategoriaDoacaoController::class, 'index'])->name('doacoes.categorias.index');
        });

        Route::group(['prefix' => 'solicitadas'], function(){
            Route::get('/', [DoacaoSolicitadaController::class, 'index'])->name('doacoes.solicitadas.index');
            Route::post('/store', [DoacaoSolicitadaController::class, 'store'])->name('doacoes.solicitadas.store');
            Route::post('/mudar-status', [DoacaoSolicitadaController::class, 'mudarStatus'])->name('doacoes.solicitadas.mudarStatus');
            Route::get('/edit/{id}', [DoacaoSolicitadaController::class, 'edit'])->name('doacoes.solicitadas.edit');
            Route::post('/update/{id}', [DoacaoSolicitadaController::class, 'update'])->name('doacoes.solicitadas.update');
            Route::delete('/delete/{id}', [DoacaoSolicitadaController::class, 'delete'])->name('doacoes.solicitadas.delete');
        });
    });
});