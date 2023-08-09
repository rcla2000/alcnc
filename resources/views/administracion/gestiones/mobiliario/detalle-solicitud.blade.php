@extends('layouts.layouts-dash.master-layout')
@section('title', 'Solicitudes mobiliario')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información de solicitud</h5>
                    <hr>
                    @include('partials.info-sol-mobiliario', ['solicitud' => $solicitud])
                </div>
            </div>
        </div>
    </div>
    @include('partials.estado-solicitud', ['solicitud' => $solicitud, 'ruta' => 'gestiones.mobiliario.solicitud.estado'])
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard/gestiones/actualizar-estado.js') }}"></script>
@endsection
