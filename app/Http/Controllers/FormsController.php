<?php

namespace App\Http\Controllers;

use App\Models\CArancele;
use App\Models\CatTipoSolicitude;
use Illuminate\Http\Request;
use App\Models\TDenuncia;
use App\Models\TSolicitude;
use App\Models\TSolicitudesMobiliario;
use App\Models\TSolicitudesFuneraria;
use App\Models\VwSolicitude;
use App\Models\CServicio;
use App\Models\CEspecialidadesClinica;
use App\Models\LugarMobiliario;
use App\Models\PagoSolicitud;
use App\Models\TCitasClinica;
use App\Models\VwClinicaCita;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class FormsController extends Controller
{
    function denuncia()
    {   
        $servicio = CServicio::where('id_servicio', 4)->first();
        return view('formularios.denuncias.denuncia', compact('servicio'));
    }

    function regDenuncia(Request $request)
    {
        $registro = new TDenuncia();
        $registro->nombre = $request->name;
        $registro->telefono = $request->phone;
        $registro->id_asunto = $request->tipoAsunto;
        $registro->mensaje = $request->mensaje;
        $registro->fecha_solicitar = $request->fecha;
        $registro->save();
        Alert::success('Información', 'Su denuncia ha sido registrada de forma exitosa.');
        return view('formularios.denuncias.denuncia-completa');
    }

    function tramites(Request $req, $idarea = null)
    {
        if (isset($req->idarea) && isset($req->idsol)) {
            $idServicio = $req->idsol;
            $idArea = $req->idarea;
            $tiposoli = VwSolicitude::where('id_area', $idArea)->get();
            $servicio = CServicio::where('id_servicio', $idServicio)->where('id_area', $idArea)->first();
            $lugares = LugarMobiliario::all();
            $vista = $servicio->vista;

            if ($idServicio == 5) {
                $especialidades = CEspecialidadesClinica::where('estado', 'A')->get();
                return view('formularios.' . $vista, compact('tiposoli', 'idarea', 'especialidades', 'servicio'));
            } else {
                return view('formularios.' . $vista, compact('tiposoli', 'idarea', 'servicio', 'lugares'));
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

    function convertirFormatoFecha($fecha) {
        $partesFecha = explode('/', $fecha);
        $dia = $partesFecha[0];
        $mes = $partesFecha[1];
        $anio = $partesFecha[2];

        return "$anio-$mes-$dia";
    }

    function regTramite(Request $req)
    {
        $title = $req->title;

        try {
            DB::beginTransaction();
           
            $aut = $req->autentica;
            $solicitud = new TSolicitude();
            $solicitud->dui_solicitante = $req->dui;
            $solicitud->tipo_solicitud = $req->tipoTramite;
            $solicitud->cantidad = $req->cantidad;
            $solicitud->autentica = $req->autentica;
            $solicitud->nombre_documento = $req->nombreDocumento;
            $solicitud->fecha_documento =  $fechaDoc = $this->convertirFormatoFecha($req->fechaDoc);

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
            return view('formularios.registro-completo', compact('title'));
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Ocurrió un error al registrar su solicitud de documento: ' . $e->getMessage());
            return back();
        } 
    }

    function precioDocumento($idSolicitud) {
        $documento = CatTipoSolicitude::find($idSolicitud);
        if ($documento !== null) {
            $precio = $documento->arancel->precio;
            return response()->json(['precio' => $precio]);
        }
        return response()->json(['message' => 'Tipo de solicitud no encontrada'], 404);
    }

    private function solicitarTokenWompi() {
        $curl = curl_init();
        $grant_type = 'client_credentials';
        $client_id = 'a5539427-bf5e-45f9-960b-52458351ae4a';
        $client_secret = 'f10c2964-543a-473e-8e9f-11f18864c393';
        $audience = 'wompi_api';

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://id.wompi.sv/connect/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=$grant_type&client_id=$client_id&client_secret=$client_secret&audience=$audience",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            // Se obtiene el token de Wompi
            Session::put('wompi_token', 'Bearer '. json_decode($response)->access_token);
            Session::put('token_valido', now()->addHours(1));
            return true;
        }
    }

    private function devolverTokenWompi() {
        if (Session::has('wompi_token') && Session::get('token_valido') > now()) {
            return Session::get('wompi_token');
        } else {
            if ($this->solicitarTokenWompi()) {
                return Session::get('wompi_token');
            }
            return null;
        }
    }

    function obtenerRegionesWompi() {
        $token = $this->devolverTokenWompi();

        if ($token !== null) {
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.wompi.sv/api/Regiones",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "accept: */*",
                    "authorization: $token"
                ),
            ));
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
    
            curl_close($curl);
    
            if ($err) {
                return json_decode($err);
            } else {
               return json_decode($response);
            }
        }
        return response()->json(['message' => 'Ha ocurrido un error'], 500);
    }

    function realizarPagoWompi(Request $request) {
        $token = $this->devolverTokenWompi();

        if ($token !== null) {
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.wompi.sv/TransaccionCompra/3DS",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "grant_type=$grant_type&client_id=$client_id&client_secret=$client_secret&audience=$audience",
                CURLOPT_HTTPHEADER => array(
                    "accept: */*",
                    "authorization: $token"
                ),
            ));
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
    
            curl_close($curl);
    
            if ($err) {
                return json_decode($err);
            } else {
               return json_decode($response);
            }
        }
        return response()->json(['message' => 'Ha ocurrido un error'], 500);
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
