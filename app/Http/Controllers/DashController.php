<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VwDetaSolicitude;
use App\Models\VwCargo;
use App\Models\CArancele;
use App\Models\PagoSolicitud;
use App\Models\SolicitudesCatastro;
use App\Models\TSolicitude;
use App\Models\TSolicitudesFuneraria;
use App\Models\TSolicitudesMobiliario;
use App\Models\Area;
use App\Models\TEstadosSolicitude;
use JavaScript;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class DashController extends Controller
{
    function dashboard($area = 0) {
        // Arreglo que contiene los datos de las consultas de las solicitudes
        $datos = [];
        $filtros = Area::whereIn(
            'descripcion', 
            [
                'Catastro', 
                'Registro del Estado Familiar', 
                'Mobiliario', 
                'Servicios Funerarios'
            ]
        )->get();

        switch (auth()->user()->area) {
            case 0:
                if(auth()->user()->rol == 5) {
                    $datos = $this->solicitudesTotales();
                    // Si el usuario administrador ha seleccionado filtrar por un tipo de solicitud
                    if ($area > 0) {
                        switch($area) {
                            case 1:
                                $datos = $this->solicitudesEstadoFamiliar();
                            break;
                            case 13:
                                $datos = $this->solicitudesCatastro();
                            break;
                            case 28:
                                $datos = $this->solicitudesFuneraria();
                            break;
                            case 29:
                                $datos = $this->solicitudesMobiliario();
                            break;
                        }
                    }
                } else {
                    return redirect()->route('home');
                }
            break;
            case 1:
                $datos = $this->solicitudesEstadoFamiliar();
            break;
            case 13:
                $datos = $this->solicitudesCatastro();
            break;
            case 28:
                $datos = $this->solicitudesFuneraria();
            break;
            case 29:
                $datos = $this->solicitudesMobiliario();
            break;
            default:
                return redirect()->route('home');
        }

        $totalSolicitudes = $datos['totalSolicitudes'];
        $totalSolPendientes = $datos['totalSolPendientes'];
        $pagosRecolectados = $datos['pagosRecolectados'];
        $pagosPendientes = $datos['pagosPendientes'];
        $datosGraficoBarra = $datos['datosGraficoBarra'];

        JavaScript::put([
            'barrasSolicitudes' => $datosGraficoBarra,
            'solicitudes' => [
                [
                    'tipo' => 'Completadas',
                    'valor' =>  $totalSolicitudes - $totalSolPendientes
                ],
                [
                    'tipo' => 'No resueltas',
                    'valor' => $totalSolPendientes
                ]
            ]
        ]);

        return view(
            'administracion.dashboard',
            compact(
                'totalSolicitudes',
                'totalSolPendientes',
                'pagosRecolectados',
                'pagosPendientes',
                'area',
                'filtros'
            )
        );
    }

    function solicitudesTotales() {
        $solicitudes = TSolicitude::all()->count();
        $solFuneraria = TSolicitudesFuneraria::all()->count();
        $solMobililiario = TSolicitudesMobiliario::all()->count();
        $solCatastro = SolicitudesCatastro::all()->count();

        $solPendientes = TSolicitude::where('estado_solicitud', '!=', 4)->get()->count();
        $solFunPendientes = TSolicitudesFuneraria::where('estado', '!=', 4)->get()->count();
        $solMobPendientes = TSolicitudesMobiliario::where('estado', '!=', 4)->get()->count();
        $solCatPendientes = SolicitudesCatastro::where('estado', '!=', 4)->get()->count();

        $totalSolicitudes = $solicitudes + $solFuneraria + $solMobililiario + $solCatastro;
        $totalSolPendientes = $solPendientes + $solFunPendientes + $solMobPendientes + $solCatPendientes;

        $pagosRecolectados = PagoSolicitud::select(DB::raw('sum(cantidad * precio) as total'))->first()->total ?? 0;
        $pagosPendientes = TSolicitude::select(DB::raw('SUM(t_solicitudes.cantidad*c_aranceles.precio) as total'))
            ->join(
                'cat_tipo_solicitudes', 
                't_solicitudes.tipo_solicitud',
                '=',
                'cat_tipo_solicitudes.id_t_solicitud'
            )
            ->join(
                'c_aranceles',
                'cat_tipo_solicitudes.id_arancel',
                '=',
                'c_aranceles.id_arancel'
            )
            ->where('t_solicitudes.estado_solicitud', '!=', 4)
            ->first()
            ->total ?? 0;

        $datosBarras = [
            [
                'tipo' => 'Registro de estado familiar',
                'valor' => $solicitudes
            ],
            [
                'tipo' => 'Servicios funerarios',
                'valor' => $solFuneraria
            ],
            [
                'tipo' => 'Mobiliario',
                'valor' => $solMobililiario
            ],
            [
                'tipo' => 'Catastro',
                'valor' => $solCatastro
            ],
        ];

        return [
            'totalSolicitudes' => $totalSolicitudes,
            'totalSolPendientes' => $totalSolPendientes,
            'pagosRecolectados' => $pagosRecolectados,
            'pagosPendientes' => $pagosPendientes,
            'datosGraficoBarra' => $datosBarras
        ];
    }

    function solicitudesMobiliario() {
        $totalSolicitudes = TSolicitudesMobiliario::all()->count();
        $totalSolPendientes = TSolicitudesMobiliario::where('estado', '!=', 4)->get()->count();
        $pagosRecolectados = 0;
        $pagosPendientes = 0;
        $datosBarras = [
            [
                'tipo' => 'Solicitudes de mobiliario',
                'valor' => $totalSolicitudes
            ]
        ];

        return [
            'totalSolicitudes' => $totalSolicitudes,
            'totalSolPendientes' => $totalSolPendientes,
            'pagosRecolectados' => $pagosRecolectados,
            'pagosPendientes' => $pagosPendientes,
            'datosGraficoBarra' => $datosBarras
        ];
    }

    function solicitudesFuneraria() {
        $totalSolicitudes = TSolicitudesFuneraria::all()->count();
        $totalSolPendientes = TSolicitudesFuneraria::where('estado', '!=', 4)->get()->count();
        $pagosRecolectados = 0;
        $pagosPendientes = 0;
        $datosBarras = [
            [
                'tipo' => 'Servicios funerarios',
                'valor' => $totalSolicitudes
            ]
        ];

        return [
            'totalSolicitudes' => $totalSolicitudes,
            'totalSolPendientes' => $totalSolPendientes,
            'pagosRecolectados' => $pagosRecolectados,
            'pagosPendientes' => $pagosPendientes,
            'datosGraficoBarra' => $datosBarras
        ];
    }

    function solicitudesCatastro() {
        $totalSolicitudes = SolicitudesCatastro::all()->count();
        $totalSolPendientes = SolicitudesCatastro::where('estado', '!=', 4)->get()->count();
        $pagosRecolectados = PagoSolicitud::select(DB::raw('sum(cantidad * precio) as total'))
            ->where('id_area', 13)
            ->first()
            ->total ?? 0;
        $pagosPendientes = 0;
        $datosBarras =  [
            [
                'tipo' => 'Catastro',
                'valor' => $totalSolicitudes
            ]
        ];

        return [
            'totalSolicitudes' => $totalSolicitudes,
            'totalSolPendientes' => $totalSolPendientes,
            'pagosRecolectados' => $pagosRecolectados,
            'pagosPendientes' => $pagosPendientes,
            'datosGraficoBarra' => $datosBarras
        ];
    }

    function solicitudesEstadoFamiliar() {
        $totalSolicitudes = TSolicitude::all()->count();
        $totalSolPendientes = TSolicitude::where('estado_solicitud', '!=', 4)->get()->count();
        $pagosRecolectados = PagoSolicitud::select(DB::raw('sum(cantidad * precio) as total'))
            ->where('id_area', 1)
            ->first()
            ->total ?? 0;
        $pagosPendientes = TSolicitude::select(DB::raw('SUM(t_solicitudes.cantidad*c_aranceles.precio) as total'))
            ->join(
                'cat_tipo_solicitudes', 
                't_solicitudes.tipo_solicitud',
                '=',
                'cat_tipo_solicitudes.id_t_solicitud'
            )
            ->join(
                'c_aranceles',
                'cat_tipo_solicitudes.id_arancel',
                '=',
                'c_aranceles.id_arancel'
            )
            ->where('t_solicitudes.estado_solicitud', '!=', 4)
            ->first()
            ->total ?? 0;

        $datosBarras = [
            [
                'tipo' => 'Registro estado familiar',
                'valor' => $totalSolicitudes
            ]
        ];

        return [
            'totalSolicitudes' => $totalSolicitudes,
            'totalSolPendientes' => $totalSolPendientes,
            'pagosRecolectados' => $pagosRecolectados,
            'pagosPendientes' => $pagosPendientes,
            'datosGraficoBarra' => $datosBarras
        ];
    }

    function gestiones()
    {
        if (auth()->user()->rol > 1) {
            $rol = auth()->user()->rol;
            $area = auth()->user()->area;
            $direccion = auth()->user()->direccion;
            $lista = DB::select('CALL pa_list_solicitudes(?,?,?)', [$rol, $area, $direccion]);
            return view('administracion.gestiones.estado-familiar.solicitudes', compact('lista'));
        }

        return redirect('/');
    }

    function gestionMobiliario() {
        return view('administracion.gestiones.mobiliario.solicitudes');
    }

    function gestionDetalleSolicitud($id) {
        $solicitud = TSolicitudesMobiliario::findOrFail($id);
        $estados = TEstadosSolicitude::all();
        return view(
            'administracion.gestiones.mobiliario.detalle-solicitud', 
            compact('solicitud', 'estados')
        );
    }

    function actualizarEstadoSolicitud($id, Request $request) {
        $request->validate([
            'comentarios' => 'required|string|min:3'
        ]);

        $solicitud = TSolicitudesMobiliario::findOrFail($id);
        $solicitud->estado = $request->estado;
        $solicitud->comentarios = $request->comentarios;
        $solicitud->save();
        Alert::success('Información', 'Información de solicitud actualizada exitosamente');
        return back();
    }

    function listaServiciosFunerarios(Request $request) {
        if ($request->ajax()) {
            $data = TSolicitudesFuneraria::orderby('fecha_solicitud', 'desc')->get();
            return Datatables::of($data)
                ->editColumn('fecha_solicitud', function(TSolicitudesFuneraria $solicitud) {
                    return date_format(date_create($solicitud->fecha_solicitud), 'd-m-Y');
                })
                ->editColumn('estado', function(TSolicitudesFuneraria $solicitud) {
                    $span = '';
                    switch ($solicitud->estado) {
                        case 1:
                            $span = '<span class="badge badge-warning black-text">';
                        break;
                        case 2:
                            $span = '<span class="badge badge-info">';
                        break;
                        case 4:
                            $span = '<span class="badge badge-success">';
                        break;
                        default:
                            $span = '<span class="badge badge-danger ">';
                    }
                    $span .= $solicitud->estado_solicitud->desc_estado . '</span>';
                    return $span;
                })
                ->addColumn(
                    'acciones', function (TSolicitudesFuneraria $solicitud) {
                        return '<a class="btn-floating btn-sm btn-default" data-toggle="tooltip"
                                data-placement="top"
                                title="Ver detalles de solicitud"
                                href="' . route('gestiones.funeraria.solicitud', $solicitud->id_solicitud) . '">
                                <i class="fas fa-eye"></i>
                            </a>';
                    }
                )
                ->rawColumns(['estado','acciones'])   
                ->make(true);
        }
    }

    function gestionDetalleSolicitudFuneraria($id) {
        $solicitud = TSolicitudesFuneraria::findOrFail($id);
        $estados = TEstadosSolicitude::all();
        return view(
            'administracion.gestiones.funeraria.detalle-solicitud', 
            compact('solicitud', 'estados')
        );
    }

    function actualizarEstadoSolicitudFuneraria($id, Request $request) {
        $request->validate([
            'comentarios' => 'required|string|min:3'
        ]);

        $solicitud = TSolicitudesFuneraria::findOrFail($id);
        $solicitud->estado = $request->estado;
        $solicitud->comentarios = $request->comentarios;
        $solicitud->save();
        Alert::success('Información', 'Información de solicitud actualizada exitosamente');
        return back();
    }

    function listaSolicitudesMobiliario(Request $request) {
        if ($request->ajax()) {
            $data = TSolicitudesMobiliario::orderby('fecha_solicitud')->get();
            return Datatables::of($data)
                ->editColumn('lugar_solicitado', function(TSolicitudesMobiliario $solicitud) {
                    return $solicitud->lugar->nombre ?? 'No indicado';
                })
                ->editColumn('fecha_solicitud', function(TSolicitudesMobiliario $solicitud) {
                    return date_format(date_create($solicitud->fecha_solicitud), 'd-m-Y');
                })
                ->editColumn('fecha_evento', function(TSolicitudesMobiliario $solicitud) {
                    return date_format(date_create($solicitud->fecha_evento), 'd-m-Y');
                })
                ->editColumn('estado', function(TSolicitudesMobiliario $solicitud) {
                    $span = '';
                    switch ($solicitud->estado) {
                        case 1:
                            $span = '<span class="badge badge-warning black-text">';
                        break;
                        case 2:
                            $span = '<span class="badge badge-info">';
                        break;
                        case 4:
                            $span = '<span class="badge badge-success">';
                        break;
                        default:
                            $span = '<span class="badge badge-danger ">';
                    }
                    $span .= $solicitud->estado_solicitud->desc_estado . '</span>';
                    return $span;
                })
                ->addColumn(
                    'acciones', function (TSolicitudesMobiliario $solicitud) {
                        return '<a class="btn-floating btn-sm btn-default" data-toggle="tooltip"
                                data-placement="top"
                                title="Ver detalles de solicitud"
                                href="' . route('gestiones.mobiliario.solicitud', $solicitud->id_solicitud) . '">
                                <i class="fas fa-eye"></i>
                            </a>';
                    }
                )
                ->rawColumns(['estado','acciones'])   
                ->make(true);
        }
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
