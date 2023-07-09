<?php

namespace App\Http\Controllers;

use App\Models\TSolicitude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContribuyenteController extends Controller
{
    public function solicitudes() {
        $solicitudes = TSolicitude::where('dui_solicitante', Auth::user()->dui)
            ->orderby('fecha_actualizacion', 'desc')
            ->get();

        return view('contribuyente.solicitudes', compact('solicitudes'));
    }

    public function detalleSolicitud($id) {
        $solicitud = TSolicitude::findOrFail($id);
        return view('contribuyente.detalle-solicitud', compact('solicitud'));
    }
}
