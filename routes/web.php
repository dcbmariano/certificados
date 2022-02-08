<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestritoController;
use App\Http\Controllers\ValidarController;
use App\Http\Controllers\GerarController;
use App\Http\Controllers\BuscarController;

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

Route::get('/', [HomeController::class, 'index']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// apenas usuários logados acessam
Route::get('/restrito', [RestritoController::class, 'index'])->middleware('auth');

// validação
Route::post('/validar', [ValidarController::class, 'index']);

// bloqueia a área restrita padrão e redireciona para a minha
Route::get('/dashboard', function () {
    return redirect('/restrito');
});

// impede que novos usuários se cadastrem
Route::get('/register', function () {
    return redirect('/restrito');
});

// emitir certificados
Route::get('/gerar', [GerarController::class, 'index']);


Route::post('/gerar/pdf', [GerarController::class, 'pdf']); 

Route::post('/gerar/segunda_via', [GerarController::class, 'segunda_via']); 

# consulta ajax
Route::get('restrito/estudantesAjax', [RestritoController::class, 'estudantesAjax'])->name('restrito/estudantesAjax')->middleware('auth'); 

Route::get('/buscar', [BuscarController::class, 'index']); 

Route::post('/buscar/meus_certificados', [BuscarController::class, 'listar_certificados']); 

Route::get('restrito/listarCertificadosAjax/{id}', [RestritoController::class, 'listarCertificadosAjax'])->name('restrito/listarCertificadosAjax')->middleware('auth'); 

// EVENTO

// gravar evento
Route::post('/restrito/gravar_evento', [RestritoController::class, 'gravar_evento'])->middleware('auth'); 

// deletar evento
Route::delete('/restrito/deletar/{id}', [RestritoController::class, 'deletar_evento'])->middleware('auth'); 

// atualizar evento
Route::put('/restrito/atualizar_evento/{id}', [RestritoController::class, 'atualizar_evento'])->middleware('auth'); 

// recupera dados do evento usando ajax
Route::get('/restrito/editar_eventoAjax/{id}', [RestritoController::class, 'editar_eventoAjax'])->middleware('auth'); 


// ESTUDANTE
// gravar estudante
Route::post('/restrito/gravar_estudante', [RestritoController::class, 'gravar_estudante'])->middleware('auth'); 

// deletar evento
Route::delete('/restrito/deletar_estudante/{id}', [RestritoController::class, 'deletar_estudante'])->middleware('auth'); 

// atualizar evento
Route::put('/restrito/atualizar_estudante/{id}', [RestritoController::class, 'atualizar_estudante'])->middleware('auth'); 

// recupera dados do evento usando ajax
Route::get('/restrito/editar_estudanteAjax/{id}', [RestritoController::class, 'editar_estudanteAjax'])->middleware('auth'); 