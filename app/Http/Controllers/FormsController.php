<?php

namespace App\Http\Controllers;

use App\Models\CArancele;
use Illuminate\Http\Request;
use App\Models\TDenuncia;
use App\Models\TSolicitude;
use App\Models\TSolicitudesMobiliario;
use App\Models\TSolicitudesFuneraria;
use App\Models\VwSolicitude;
use App\Models\CServicio;
use App\Models\CEspecialidadesClinica;
use App\Models\PagoSolicitud;
use App\Models\TCitasClinica;
use App\Models\VwClinicaCita;
use RealRashid\SweetAlert\Facades\Alert;
use DateTime;
use DB;
use Exception;

class FormsController extends Controller
{
    function denuncia()
    {   
        $servicio = CServicio::where('id_servicio', 4)->first();
        $servicios = CServicio::all();
        return view('formularios.denuncias.denuncia', compact('servicio', 'servicios'));
    }

    function regDenuncia(Request $request)
    {
        $servicios = CServicio::all();
        $registro = new TDenuncia();
        $registro->nombre = $request->name;
        $registro->telefono = $request->phone;
        $registro->id_asunto = $request->tipoAsunto;
        $registro->mensaje = $request->mensaje;
        $registro->fecha_solicitar = $request->fecha;
        $registro->save();
        Alert::success('Información', 'Su denuncia ha sido registrada de forma exitosa.');
        return view('formularios.denuncias.denuncia-completa', compact('servicios'));
    }

    function tramites(Request $req, $idarea = null)
    {
        $servicios = CServicio::all();
        if (isset($req->idarea) && isset($req->idsol)) {
            $idServicio = $req->idsol;
            $idArea = $req->idarea;
            $tiposoli = VwSolicitude::where('id_area', $idArea)->get();
            $servicio = CServicio::where('id_servicio', $idServicio)->where('id_area', $idArea)->first();
            $vista = $servicio->vista;

            if ($idServicio == 5) {
                $especialidades = CEspecialidadesClinica::where('estado', 'A')->get();
                return view('formularios.' . $vista, compact('tiposoli', 'idarea', 'especialidades', 'servicio', 'servicios'));
            } else {
                return view('formularios.' . $vista, compact('tiposoli', 'idarea', 'servicio', 'servicios'));
            }
        }
        ///lleva a la vista para mostrar los servicios por area
        else if (isset($req->idarea) && !isset($req->sol)) {
            return view('servicios');
        } else {
            ///muestra todos lo servicios en linea de la alcaldía
            return view('servicios');
        }
    }
    /////////////////////////REGISTRO FAMILIAR//////////////////
    function regTramite(Request $req)
    {
        $servicios = CServicio::all();
        $title = $req->title;

        try {
            DB::beginTransaction();
            $fechaDoc = date('d-m-Y', strtotime($req->fechaDoc));
            $dt = new DateTime($fechaDoc);
            $aut = $req->autentica;
    
            $solicitud = new TSolicitude();
            $solicitud->dui_solicitante = $req->dui;
            $solicitud->tipo_solicitud = $req->tipoTramite;
            $solicitud->cantidad = $req->cantidad;
            $solicitud->autentica = $req->autentica;
            $solicitud->nombre_documento = $req->nombreDocumento;
            $solicitud->fecha_documento = $dt->format('Y-d-m');
            if ($aut == null) {
                $solicitud->autentica = 0;
            } else {
                $solicitud->autentica = 1;
            }
            $solicitud->desc_solicitud = $req->comentario;
            $solicitud->estado_solicitud = 1;
            $solicitud->usuario_actualizacion = auth()->user()->name;
            $solicitud->save();
    
            // Se almacena el pago de la solicitud
            $pago = new PagoSolicitud();
            $pago->id_solicitud = $solicitud->id_solicitud;
            $pago->id_area = 1;
            $pago->id_direccion = 2;
            $pago->cantidad = $solicitud->cantidad;

            // Se verifica si se agrega el costo extra de (auténtica)
            if ($solicitud->autentica == 1) {
                $arancel = CArancele::where('id_arancel', 4)->first()->precio;
                $pago->precio = $solicitud->cat_tipo_solicitud->arancel->precio + $arancel;
            } else {
                $pago->precio = $solicitud->cat_tipo_solicitud->arancel->precio;
            }
            
            $pago->save();

            DB::commit();
            Alert::success('Información', 'Su solicitud de documentos ha sido enviada de forma exitosa.');
            return view('formularios.registro-completo', compact('title', 'servicios'));
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Ocurrió un error al registrar su solicitud de documento: ' . $e->getMessage());
            return back();
        } 
    }
    ////////////////////////////////CLINICA//////////////////////////////
    ////registro citas de clinica
    function regCita(Request $req)
    {
        $fecha = date("Y/m/d", strtotime($req->fecha_submit));
        $citas = new TCitasClinica();

        $citas->fecha_cita = $fecha;
        $citas->especialidad = $req->espe;
        $citas->id_usuario = auth()->user()->id;
        $citas->estado_cita = 'Abierta';
        $citas->save();

        $mensaje = 'Estimado usuario su cita para el próximo ' . date('d/m/Y', strtotime($fecha)) . ' ha sido agendada éxitosamente';
        Alert::success('Información', $mensaje);
        return back();
    }

    ////funcion para filtrar citas por especialidad lado controlador recibe como parametro la especialidad
    function filtrarCitas(Request $req)
    {
        $especialidad = $req->espec;
        $disFechas = VwClinicaCita::where('citas', 15)->where('especialidad', $req->espec)->get();
        return  response()->json($disFechas);
    }


    ///////////////////////////////MOBILIARIO////////////////////////////////////
    function regMobiliario(Request $req)
    {
        $fecha = date('y-m-d', strtotime($req->fecha_submit));
        $solicitud = new TSolicitudesMobiliario();
        $solicitud->usuario = auth()->user()->dui;
        $solicitud->lugar_solicitado =  $req->lugar;
        $solicitud->fecha_evento = $fecha;
        $solicitud->sillas = $req->cantSillas;
        $solicitud->mesas = $req->cantMesas;
        $solicitud->canopis = $req->cantCanopis;
        $solicitud->estado = 1;
        $solicitud->save();
        Alert::success('Información', 'Su solicitud de inmobiliario ha sido enviada de forma exitosa.');
        return back();
    }

    function regFuneraria(Request $req)
    {
        $solicitud = new TSolicitudesFuneraria();
        $solicitud->usuario = auth()->user()->dui;
        $solicitud->solicitud = $req->solicitud;
        $solicitud->estado =  1;
        $solicitud->save();
        Alert::success('Información', 'Su solicitud ha sido enviada de forma exitosa.');
        return back();
    }
}
