<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TDenuncia;
use App\Models\CatTipoSolicitude;
use App\Models\TSolicitude;
use App\Models\VwSolicitude;
use App\Models\CServicio;
use App\Models\CEspecialidadesClinica;
use App\Models\TCitasClinica;
use App\Models\VwClinicaCita;
use JavaScript;

use DateTime;
class FormsController extends Controller
{
    function denuncia(){
        return view('formularios.denuncias.denuncia');
    }

    function regDenuncia(Request $request){
        $registro = new TDenuncia();
        $registro->nombre = $request->name;
        $registro->telefono = $request->phone;
        $registro->id_asunto = $request->tipoAsunto;
        $registro->mensaje = $request->mensaje;
        $registro->fecha_solicitar = $request->fecha;
        $registro->save();

        



        return view('formularios.denuncias.denuncia-completa');
    }

    function tramites(Request $req,$idarea = null){
        
        if(isset($req->idarea) && isset($req->idsol) ){
            $idServicio = $req->idsol;
            $idArea =$req->idarea;
            $tiposoli = VwSolicitude::where('id_area',$idArea)->get();
            $servicio = CServicio::where('id_servicio',$idServicio)->where('id_area',$idArea)->first();

            

            if($idServicio == 5){
                $especialidades = CEspecialidadesClinica::where('estado', 'A')->get();
               
                return view('formularios.'.$servicio->vista,compact('tiposoli','idarea','especialidades'));
            }
            else{
                return view('formularios.'.$servicio->vista,compact('tiposoli','idarea'));
            }
        }
        ///lleva a la vista para mostrar los servicios por area
        elseif(isset($req->idarea) && !isset($req->sol)){
            return view('servicios');
        }
        else{
        ///muestra todos lo servicios en linea de la alcaldía
            return view('servicios');
        }
        

        
       
    }

    function regTramite(Request $req){

        $fechaDoc = date('d-m-Y', strtotime( $req->fechaDoc));
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
            $solicitud->autentica = $aut ;
        }
        $solicitud->desc_solicitud = $req->comentario;
        $solicitud->estado_solicitud = 1;
        $solicitud->usuario_actualizacion = auth()->user()->name;
        $solicitud->save();
        $title = $req->title;


        
        return view('formularios.registro-completo', compact('title'));
    }

    function regCita(Request $req){
        $fecha = date("Y/m/d", strtotime($req->fecha_submit));
        $citas = new TCitasClinica();

        $citas->fecha_cita = $fecha; 
        $citas->especialidad = $req->espe;
        $citas->id_usuario = auth()->user()->id;
        $citas->estado_cita= 'Abierta';
        $citas->save();
    
        $mensaje = 'Estimado usuario su cita para el próximo '.date('d/m/Y' ,strtotime($fecha)).' ha sido agendada éxitosamente'; 

      return  back()->with('message',$mensaje);
    }

    ////funcion para filtrar citas por especialidad lado controlador recibe como parametro la especialidad
    function filtrarCitas(Request $req){
        $especialidad= $req->espec;
        $disFechas = VwClinicaCita::where('citas',15)->where('especialidad', $req->espec)->get();
        
        return  response()->json($disFechas);
    }
}
