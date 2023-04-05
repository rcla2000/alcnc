<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TDenuncia;
use App\Models\CatTipoSolicitude;
use App\Models\TSolicitude;

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

    function tramites(Request $req){
        
        if(isset($req->idarea) && isset($req->idsol) ){
            $idServicio = $req->idsol;
            $idArea =$req->idarea;
            $tiposoli = CatTipoSolicitude::where('id_area',$idArea)->get();
            return view('formularios.registro-familiar',compact('tiposoli'));
        }
        elseif(isset($req->idarea) && !isset($req->idarea)){
            return view('servicios');
        }
        else{
            return view('servicios');
        }
        

        
       
    }

    function regTramite(Request $req){
        $solicitud = new TSolicitude();
    }
}
