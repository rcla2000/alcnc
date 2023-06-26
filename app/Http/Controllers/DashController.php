<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VwDetaSolicitude;
use App\Models\VwCargo;
use App\Models\CArancele;
use App\Models\TSolicitude;
use App\Models\TSolicitudesFuneraria;
use App\Models\TSolicitudesMobiliario;

class DashController extends Controller
{
    function dashboard(){
        if(auth()->user()->rol > 1)
        {
            $solicitudes = TSolicitude::all()->count();
            $solFuneraria = TSolicitudesFuneraria::all()->count();
            $solMobililiario = TSolicitudesMobiliario::all()->count();

            $solPendientes = TSolicitude::where('estado_solicitud', '!=', 4)->get()->count();
            $solFunPendientes = TSolicitudesFuneraria::where('estado', '!=', 4)->get()->count();
            $solMobPendientes = TSolicitudesMobiliario::where('estado', '!=', 4)->get()->count();

            $totalSolicitudes = $solicitudes + $solFuneraria + $solMobililiario;
            $totalSolPendientes = $solPendientes + $solFunPendientes + $solMobPendientes;

            return view(
                'administracion.dashboard',
                compact(
                    'totalSolicitudes',
                    'totalSolPendientes'
                )
            );
        }
        return redirect('/');
    }

    function gestiones()
    {
        if (auth()->user()->rol > 1) {
            $rol = auth()->user()->rol;
            $area = auth()->user()->area;
            $direccion = auth()->user()->direccion;
            $lista = DB::select('CALL pa_list_solicitudes(?,?,?)', [$rol, $area, $direccion]);
            return view('administracion.gestiones', compact('lista'));
        }

        return redirect('/');
    }

    function detaGestion(Request $request)
    {
        $solicitud  = VwDetaSolicitude::where('id', $request->id)->first();
        return view('administracion.partials.deta-gestion', compact('solicitud'));
    }
    
    function mandamiento($id)
    {
        $solicitud  = VwDetaSolicitude::where('id', $id)->first();
        $cargos = VwCargo::where('id', $id)->get();
        $aranceles = CArancele::where('id_arancel', '<>', 3)->get();
        return view('administracion.mandamiento-pago', compact('solicitud', 'cargos', 'aranceles'));
    }
}
