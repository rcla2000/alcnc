<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CServicio;
use App\Models\Mensaje;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    function home(){
        $servicios = CServicio::all();
        return view('welcome', compact('servicios'));
    }

    function documentos(){
        $servicios = CServicio::all();
        return view('descargables', compact('servicios'));
    }

    function guardarMensaje(Request $request) {
        $request->validate([
            'nombre' => 'required|string|min:3',
            'telefono' => 'required|string',
            'mensaje' => 'required|string'
        ]);

        $mensaje = new Mensaje();
        $mensaje->nombre = $request->nombre;
        $mensaje->telefono = $request->telefono;
        $mensaje->mensaje = $request->mensaje;
        $mensaje->save();

        Alert::success('Información', 'Su mensaje ha sido enviado');
        return back();
    }
}
