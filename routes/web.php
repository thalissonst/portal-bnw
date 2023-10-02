<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'login'])->name('login'); // Página de Login
Route::post('login', [AuthController::class, 'loginAuth'])->name('login.auth'); // Realiza o login do usuário

Route::middleware('auth')->group(function () {

    Route::get('dashboard', function () { return view('dashboard'); })->name('dashboard'); // View da dashboard do sistema
    Route::get('notifications', [AuthController::class, 'notifications'])->name('notifications'); // View de notificações do usuário

    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout')->middleware('auth')->name('logout'); //Realiza o logout do usuário
        Route::get('profile', 'profile')->name('profile'); // Exibe o perfil do usuário
        Route::post('profile', 'updateProfile')->name('update.profile'); // Atualiza o perfil do usuário
        Route::post('password', 'changePassword')->name('change.password'); // Atualiza a senha do usuário
    });
 
    Route::middleware('verification')->group(function () {

        Route::controller(UserController::class)->prefix('users')->group(function () {
            Route::get('', 'index')->name('users'); // Gerenciamento de Usuários
            Route::post('', 'create')->name('users.create'); // Cadastra um novo usuário
            Route::get('{id}', 'show')->name('users.show'); // Detalhes de um usuário
            Route::put('{id}', 'update')->name('users.update'); // Atualiza dados de um usuário
            Route::delete('{id}', 'destroy')->name('users.destroy'); // Exclui um usuário
        });
        
    });

});

