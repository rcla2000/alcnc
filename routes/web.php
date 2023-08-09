<?php

use App\Http\Controllers\ContribuyenteController;
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

Route::middleware(['auth'])->group(function() {
    Route::get('/', [HomeController::class,'home'])->name('home');
    Route::get('/documentos', [HomeController::class, 'documentos'])->name('documentos');
    Route::post('/enviar-mensaje', [HomeController::class, 'guardarMensaje'])->name('mensaje.guardar');

    //RUTAS PARA EL FORMCONTROLLER SERAN PARA TODO EVENTO QUE SE NECESITE FORMULARIO
    Route::get('/contacto', [FormsController::class,'denuncia'])->name('denuncia');
    Route::post('/denuncia',[FormsController::class,'regDenuncia'])->name('regDenuncia');
    Route::post('/tramites/envio-solicitud',[FormsController::class,'regTramite'])->name('regSolicitud');
    Route::get('/tramites/{idarea?}/{idsol?}',[FormsController::class,'tramites'])->middleware(['auth'])->name('tramites');
    Route::post('/registro-cita',[FormsController::class,'regCita'])->middleware(['auth'])->name('regCita');
    Route::post('/filtrarCitas',[FormsController::class,'filtrarCitas'])->name('filtrarCitas');
    Route::post('/registro-mobiliario',[FormsController::class,'regMobiliario'])->middleware(['auth'])->name('regMobiliario');
    Route::post('/registro-funerario',[FormsController::class,'regFuneraria'])->middleware(['auth'])->name('regFuneraria');

    // Rutas para área de administración
    Route::get('/dashboard/{area?}', [DashController::class,'dashboard'])->name('dashboard');
    Route::get('/gestiones/estado-familiar', [DashController::class, 'gestiones'])->name('gestiones.estadoFamiliar');
    Route::get('/gestiones/mobiliario', [DashController::class, 'gestionMobiliario'])->name('gestiones.mobiliario');
    Route::get('/gestiones/mobiliario/lista-solicitudes', [DashController::class, 'listaSolicitudesMobiliario'])->name('gestiones.mobiliario.solicitudes');
    Route::get('/gestiones/mobiliario/solicitud/{id}', [DashController::class, 'gestionDetalleSolicitud'])->name('gestiones.mobiliario.solicitud');
    Route::post('/gestiones/mobiliario/solicitud/estado/{id}', [DashController::class, 'actualizarEstadoSolicitud'])->name('gestiones.mobiliario.solicitud.estado');
    Route::view('/gestiones/servicios-funerarios', 'administracion.gestiones.funeraria.solicitudes')->name('gestiones.funerario');
    Route::get('/gestiones/servicios-funerarios/lista-solicitudes', [DashController::class, 'listaServiciosFunerarios'])->name('gestiones.funeraria.solicitudes');
    //Route::get('/gestiones/estado-familiar', [DashController::class, 'gestiones'])->name('gestiones');
    Route::post('/detalle-gestion', [DashController::class,'detaGestion'])->name('detaGestion');
    Route::get('/mandamiento-pago/{id}', [DashController::class,'mandamiento'])->name('mandamiento');
    Route::get('/gestiones/servicios-funerarios/solicitud/{id}', [DashController::class, 'gestionDetalleSolicitudFuneraria'])->name('gestiones.funeraria.solicitud');
    Route::post('/gestiones/servicios-funerarios/solicitud/estado/{id}', [DashController::class, 'actualizarEstadoSolicitudFuneraria'])->name('gestiones.funeraria.solicitud.estado');
    // Rutas para contribuyentes
    Route::get(
        '/contribuyente/solicitudes', 
        [ContribuyenteController::class, 'solicitudes']
    )->name('contribuyente.solicitudes');
    Route::get(
        '/contribuyentes/solicitudes/estado-familiar', 
        [ContribuyenteController::class, 'solicitudesEstadoFamiliar']
    )->name('contribuyente.solEstadoFamiliar');
    Route::get(
        '/contribuyentes/solicitudes/servicios-funerarios', 
        [ContribuyenteController::class, 'solicitudesFunerarias']
    )->name('contribuyente.solFuneraria');
    Route::get(
        '/contribuyentes/solicitudes/mobiliario', 
        [ContribuyenteController::class, 'solicitudMobiliario']
    )->name('contribuyente.solMobiliario');
    Route::get(
        '/contribuyente/solicitudes/estado-familiar/{id}', 
        [ContribuyenteController::class, 'detalleSolicitudEstadoFamiliar']
    )->name('contribuyente.detalleSolFamiliar');
    Route::get(
        '/contribuyente/solicitudes/servicios-funerarios/{id}', 
        [ContribuyenteController::class, 'detalleSolicitudFuneraria']
    )->name('contribuyente.detalleSolFuneraria');
    Route::get(
        '/contribuyente/solicitudes/mobiliario/{id}', 
        [ContribuyenteController::class, 'detalleSolicitudMobiliario']
    )->name('contribuyente.detalleSolMobiliario');
});

require __DIR__.'/auth.php';



