<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CServicio;

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
}
