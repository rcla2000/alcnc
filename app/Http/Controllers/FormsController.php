<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TDenuncia;
use App\Models\CatTipoSolicitude;
use App\Models\TSolicitude;
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
            $tiposoli = CatTipoSolicitude::where('id_area',$idArea)->get();
            return view('formularios.registro-familiar',compact('tiposoli','idarea'));
        }
        elseif(isset($req->idarea) && !isset($req->idarea)){
            return view('servicios');
        }
        else{
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
        $solicitud->fecha_documento = $dt->format('Y-m-d');
        if ($aut == null) {
            $solicitud->autentica = 0;
        } else {
            $solicitud->autentica = $aut ;
        }
        $solicitud->desc_solicitud = $req->comentario;
        $solicitud->estado_solicitud = 1;
        $solicitud->save();

        $title = $req->title;
        return view('formularios.registro-completo', compact('title'));
    }
}
