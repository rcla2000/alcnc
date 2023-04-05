<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormsController;

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

//RUTAS PARA EL FORMCONTROLLER SERAN PARA TODO EVENTO QUE SE NECESITE FORMULARIO
Route::get('/contacto', [FormsController::class,'denuncia'])->name('denuncia');
Route::post('/denuncia',[FormsController::class,'regDenuncia'])->name('regDenuncia');
Route::get('/tramites/{idarea?}/{idsol?}',[FormsController::class,'tramites'])->middleware(['auth'])->name('tramites');


Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



