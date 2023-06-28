@extends('layouts.layouts-dash.master-layout')

@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-2">
                <div class="card-body text-center p-0 pt-1">
                    <h2>{{ $totalSolicitudes }}</h2>
                    <span>Total de solicitudes</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-2">
                <div class="card-body text-center p-0 pt-1">
                    <h2>{{ $totalSolPendientes }}</h2>
                    <span>Solicitudes no resueltas</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-2">
                <div class="card-body text-center p-0 pt-1">
                    <h2>${{ number_format($pagosRecolectados, 2) }}</h2>
                    <span>Pagos recolectados</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-2">
                <div class="card-body text-center p-0 pt-1">
                    <h2>${{ number_format($pagosPendientes, 2) }}</h2>
                    <span>Pagos pendientes</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header primary-color text-white">
                    <h5 class="card-title">Tipos de solicitudes</h5>
                </div>
                <div class="card-body">
                    <div id="barrasTipoSolicitud" class="grafico"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header primary-color text-white">
                    <h5 class="card-title">Detalle de solicitudes</h5>
                </div>
                <div class="card-body">
                    <div id="pastel" class="grafico"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="{{ asset('js/dashboard/graficos/solicitudes.js') }}"></script>
@endsection
