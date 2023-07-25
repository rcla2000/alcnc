@extends('layouts.layouts-forms.master-layout')
@section('title', 'Solicitud Servicios funerarios')

@section('content')
    <section class="container mt-menu">
        <br>
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-baseline">
                    <i class="fa-solid fa-file-invoice icono-solicitud mr-3"></i>
                    <h3>Información de la solicitud</h3>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="info-solicitud">
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>DUI solicitante:</b> {{ $solicitud->usuario }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Detalle:</b> {{ $solicitud->solicitud }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Fecha en que se realizó la solicitud:</b>
                        {{ date_format(date_create($solicitud->fecha_solicitud), 'd-m-Y') }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Estado:</b> 
                        <span class="estado-solicitud estado-solicitud-{{ $solicitud->estado_solicitud->id_estado }}">
                            {{ $solicitud->estado_solicitud->desc_estado }}
                        </span>
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Fecha de actualización:</b>
                        {{ date_format(date_create($solicitud->fecha_actualización), 'd-m-Y') }}
                    </span>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <a href="{{ route('contribuyente.solFuneraria') }}" class="btn btn-block btn-info">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.master.footer')

@endsection
