<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Doacao\{
    CategoriaDoacaoController,
    DoacaoController,
    DoacaoOferecidaController,
    DoacaoSolicitadaController,
};
use App\Http\Controllers\Api\ModuloController;
use App\Http\Controllers\Api\PoliticaPrivacidadeController;
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

        Route::get('/todos', [UsuarioController::class, 'index'])->name('user.index');
        Route::get('/info-usuario', [UsuarioController::class, 'info'])->name('user.info');
        Route::post('/update', [UsuarioController::class, 'update'])->name('user.update');
        Route::delete('/excluir-conta', [UsuarioController::class, 'excluirConta'])->name('user.excluir-conta');
    });

    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

    Route::get('/modulos', [ModuloController::class, 'index'])->name('modulos.index');

    Route::group(['prefix' => 'doacoes'], function(){
        Route::group(['prefix' => 'categorias'], function(){
            Route::get('/', [CategoriaDoacaoController::class, 'index'])->name('doacoes.categorias.index');
        });

        Route::post('/mudar-status', [DoacaoController::class, 'mudarStatus'])->name('doacoes.mudarStatus');
        Route::delete('/delete/{id}', [DoacaoController::class, 'delete'])->name('doacoes.delete');
        Route::get('/buscar-doacao/{id}', [DoacaoController::class, 'edit'])->name('doacoes.edit');

        // Todos os perfis de doações
        Route::get('/', [DoacaoController::class, 'index'])->name('doacoes.index');
        Route::post('/store', [DoacaoController::class, 'store'])->name('doacoes.store');
        Route::post('/update/{id}', [DoacaoController::class, 'update'])->name('doacoes.update');
        Route::get('/perfis-doacao', [DoacaoController::class, 'perfisDoacao'])->name('doacoes.perfisDoacao');

        // solicitadas
        Route::group(['prefix' => 'solicitadas'], function(){
            Route::get('/', [DoacaoSolicitadaController::class, 'index'])->name('doacoes.solicitadas.index');
            Route::post('/store', [DoacaoSolicitadaController::class, 'store'])->name('doacoes.solicitadas.store');
            Route::post('/update/{id}', [DoacaoSolicitadaController::class, 'update'])->name('doacoes.solicitadas.update');
        });
        
        // oferecidas
        Route::group(['prefix' => 'oferecidas'], function(){
            Route::get('/', [DoacaoOferecidaController::class, 'index'])->name('doacoes.oferecidas.index');
            Route::post('/store', [DoacaoOferecidaController::class, 'store'])->name('doacoes.oferecidas.store');
            Route::post('/update/{id}', [DoacaoOferecidaController::class, 'update'])->name('doacoes.oferecidas.update');
        });
    });
});

Route::group(['prefix' => 'politica-privacidade'], function(){
    Route::get('/atual', [PoliticaPrivacidadeController::class, 'atual'])->name('politica-privacidade.atual');
});