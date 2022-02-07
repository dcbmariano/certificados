<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestritoController;
use App\Http\Controllers\ValidarController;
use App\Http\Controllers\GerarController;

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


// Route::get('/gerar/pdf', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) { // https://github.com/codedge/laravel-fpdf

//     $fpdf->AddPage();
//     $fpdf->SetFont('Courier', 'B', 18);
//     $fpdf->Cell(50, 25, 'Hello World!'.Codedge\Fpdf\Fpdf\Fpdf);
//     $fpdf->Output();
//     exit;

// });

Route::post('/gerar/pdf', [GerarController::class, 'pdf']); 

Route::post('/gerar/segunda_via', [GerarController::class, 'segunda_via']); 

# consulta ajax
Route::get('restrito/estudantesAjax', [RestritoController::class, 'estudantesAjax'])->name('restrito/estudantesAjax')->middleware('auth'); 


