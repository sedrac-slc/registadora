<?php

use App\Http\Controllers\{
    HomeController,
    ClienteController,
    ServicoController,
    RealizacaoController,
    FuncionarioController,
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(["auth"])->group(function(){
    Route::resource('funcionarios',FuncionarioController::class);
    Route::resource('realizacoes',RealizacaoController::class);
    Route::resource('clientes',ClienteController::class);
    Route::resource('servicos',ServicoController::class);

    Route::post('/account', [HomeController::class, 'update'])->name('account.update');
    Route::post('/password', [HomeController::class, 'password'])->name('account.pass');
    Route::put('/account/photo/{id}', [HomeController::class, 'photo'])->name('account.photo');

    Route::post('cliente/servico/{id}',[ClienteController::class,'service'])->name('cliente.servico');
    Route::post('servico/cliente',[ServicoController::class,'cliente'])->name('servico.cliente');
    Route::get('servico/json',[ServicoController::class,'json_search'])->name('servico.json');

});
