<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TDenuncia;
use App\Models\TSolicitude;
use App\Models\TSolicitudesMobiliario;
use App\Models\TSolicitudesFuneraria;
use App\Models\VwSolicitude;
use App\Models\CServicio;
use App\Models\CEspecialidadesClinica;
use App\Models\TCitasClinica;
use App\Models\VwClinicaCita;

use JavaScript;

use DateTime;

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
        $fechaDoc = date('d-m-Y', strtotime($req->fechaDoc));
        $dt = new DateTime($fechaDoc);
        $aut = $req->autentica;

        $solicitud = new TSolicitude();

        $solicitud->area_alcaldia = $req->area;
        $solicitud->dui_solicitante = $req->dui;
        $solicitud->tipo_solicitud = $req->tipoTramite;
        $solicitud->cantidad = $req->cantidad;
        $solicitud->autentica = $req->autentica;
        $solicitud->nombre_documento = $req->nombreDocumento;
        $solicitud->fecha_documento = $dt->format('Y-d-m');
        if ($aut == null) {
            $solicitud->autentica = 0;
        } else {
            $solicitud->autentica = $aut;
        }
        $solicitud->desc_solicitud = $req->comentario;
        $solicitud->estado_solicitud = 1;
        $solicitud->usuario_actualizacion = auth()->user()->name;
        $solicitud->save();
        $title = $req->title;
        $servicios = CServicio::all();

        return view('formularios.registro-completo', compact('title', 'servicios'));
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

        return  back()->with('message', $mensaje);
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

        return back();
    }

    function regFuneraria(Request $req)
    {
        $solicitud = new TSolicitudesFuneraria();
        $solicitud->usuario = auth()->user()->dui;
        $solicitud->solicitud = $req->solicitud;
        $solicitud->estado =  1;
        $solicitud->save();
        return back();
    }
}
