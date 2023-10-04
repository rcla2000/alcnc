<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class UsuariosController extends Controller
{
    function listar(Request $request) {
        if ($request->ajax()) {
            $data = User::orderby('name')->get();
            return Datatables::of($data)
                ->make(true);
        }
    }
}
