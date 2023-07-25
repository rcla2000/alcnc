<?php

namespace App\Http\Controllers;

use App\Models\PagoSolicitud;
use App\Models\TSolicitude;
use App\Models\TSolicitudesFuneraria;
use App\Models\TSolicitudesMobiliario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContribuyenteController extends Controller
{
    public function solicitudes() {
        return view('contribuyente.tipos-solicitudes');
    }

    public function solicitudesEstadoFamiliar() {
        $solicitudes = TSolicitude::where('dui_solicitante', Auth::user()->dui)
            ->orderby('fecha_actualizacion', 'desc')
            ->get();
        return view('contribuyente.sol-estado-familiar', compact('solicitudes'));
    }

    public function solicitudesFunerarias() {
        $solicitudes = TSolicitudesFuneraria::where('usuario', Auth::user()->dui)
            ->orderby('fecha_actualizacion', 'desc')
            ->get();
        return view('contribuyente.sol-funeraria', compact('solicitudes'));
    }

    public function solicitudMobiliario() {
        $solicitudes = TSolicitudesMobiliario::where('usuario', Auth::user()->dui)
            ->orderby('fecha_actualizacion', 'desc')
            ->get();
        return view('contribuyente.sol-mobiliario', compact('solicitudes'));
    }

    public function detalleSolicitudEstadoFamiliar($id) {
        $solicitud = TSolicitude::findOrFail($id);
        $pago = PagoSolicitud::where('id_area', 1)
            ->where('id_direccion', 2)
            ->where('id_solicitud', $id)
            ->first();
        return view('contribuyente.detalle-sol-familiar', compact('solicitud', 'pago'));
    }

    public function detalleSolicitudFuneraria($id) {
        $solicitud = TSolicitudesFuneraria::findOrFail($id);
        return view('contribuyente.detalle-sol-funeraria', compact('solicitud'));
    }

    public function detalleSolicitudMobiliario($id) {
        $solicitud = TSolicitudesMobiliario::findOrFail($id);
        return view('contribuyente.detalle-sol-mobiliario', compact('solicitud'));
    }
}
