<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ConsentimentoDocumentoController;
use App\Http\Controllers\Api\ContatoUsuarioController;
use App\Http\Controllers\Api\Doacao\{
    CategoriaDoacaoController,
    DoacaoController,
};
use App\Http\Controllers\Api\LocalizacaoController;
use App\Http\Controllers\Api\ModuloController;
use App\Http\Controllers\Api\PoliticaPrivacidadeController;
use App\Http\Controllers\Api\TermoUsoController;
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
Route::middleware(['auth:sanctum', 'documentos'])->group(function(){
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'user'], function(){
        Route::get('/', function (Request $request) {
            return $request->user();
        });        

        Route::get('/todos', [UsuarioController::class, 'index'])->name('user.index');
        Route::get('/listarPaginados', [UsuarioController::class, 'listarPaginados'])->name('user.listarPaginados');
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
        Route::get('/lista', [DoacaoController::class, 'lista'])->name('doacoes.lista');
        Route::get('/mapa', [DoacaoController::class, 'mapa'])->name('doacoes.mapa');
        Route::post('/store', [DoacaoController::class, 'store'])->name('doacoes.store');
        Route::post('/update/{id}', [DoacaoController::class, 'update'])->name('doacoes.update');
        Route::get('/perfis-doacao', [DoacaoController::class, 'perfisDoacao'])->name('doacoes.perfisDoacao');
    });

    // Quando o usuário entra em contato com a equipe
    Route::group(['prefix' => 'contato-usuario'], function(){
        Route::post('/email', [ContatoUsuarioController::class, 'email'])->name('contato-usuario.email');
    });

    Route::post('/consentimento/aceitar', [ConsentimentoDocumentoController::class, 'aceitar'])->name('consentimento.aceitar');

    Route::get('/buscar-regiao-pelo-cep/{cep}', [LocalizacaoController::class, 'buscarRegiaoPeloCep'])->name('buscarRegiaoPeloCep');
});

Route::group(['prefix' => 'politica-privacidade'], function(){
    Route::get('/atual', [PoliticaPrivacidadeController::class, 'atual'])->name('politica-privacidade.atual');
});

Route::group(['prefix' => 'termo-uso'], function(){
    Route::get('/atual', [TermoUsoController::class, 'atual'])->name('termo-uso.atual');
});