<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\DashController;
use App\Models\PagoSolicitud;
use App\Models\TSolicitude;

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
Route::post('/tramites/envio-solicitud',[FormsController::class,'regTramite'])->name('regSolicitud');
Route::get('/tramites/{idarea?}/{idsol?}',[FormsController::class,'tramites'])->middleware(['auth'])->name('tramites');
Route::post('/registro-cita',[FormsController::class,'regCita'])->middleware(['auth'])->name('regCita');
Route::post('/filtrarCitas',[FormsController::class,'filtrarCitas'])->name('filtrarCitas');
Route::post('/registro-mobiliario',[FormsController::class,'regMobiliario'])->middleware(['auth'])->name('regMobiliario');
Route::post('/registro-funerario',[FormsController::class,'regFuneraria'])->middleware(['auth'])->name('regFuneraria');


Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/documentos', [HomeController::class, 'documentos'])->name('documentos');
Route::post('/enviar-mensaje', [HomeController::class, 'guardarMensaje'])->name('mensaje.guardar');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard/{area?}', [DashController::class,'dashboard'])->name('dashboard');
    Route::get('/gestiones', [DashController::class,'gestiones'])->name('gestiones');
    Route::post('/detalle-gestion', [DashController::class,'detaGestion'])->name('detaGestion');
    Route::get('/mandamiento-pago/{id}', [DashController::class,'mandamiento'])->name('mandamiento');
});

require __DIR__.'/auth.php';



