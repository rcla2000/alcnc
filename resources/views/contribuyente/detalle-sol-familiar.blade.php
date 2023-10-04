@extends('layouts.layouts-forms.master-layout')
@section('title', 'Mi solicitud')

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
                        <b>DUI solicitante:</b> {{ $solicitud->dui_solicitante }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Tipo de solicitud:</b> {{ $solicitud->cat_tipo_solicitud->desc_solicitud }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Cantidad de documentos solicitados:</b> {{ $solicitud->cantidad }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Nombre de documento:</b> {{ $solicitud->nombre_documento }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Fecha de documento:</b>
                        {{ date_format(date_create($solicitud->fecha_documento), 'd-m-Y') }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Posee auténtica:</b> {{ $solicitud->autentica == 1 ? 'Sí' : 'No' }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Fecha en que se realizó la solicitud:</b>
                        {{ date_format(date_create($solicitud->fecha_solicitud), 'd-m-Y') }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Costo:</b>
                        @if ($pago != 0)
                            ${{ number_format($pago, 2) }}
                        @else  
                            Pendiente de pago
                        @endif
                        
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Estado:</b> 
                        <span class="estado-solicitud estado-solicitud-{{ $solicitud->t_estados_solicitude->id_estado }}">
                            {{ $solicitud->t_estados_solicitude->desc_estado }}
                        </span>
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Fecha de actualización:</b>
                        {{ date_format(date_create($solicitud->fecha_actualización), 'd-m-Y') }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Fecha de resolución:</b>
                        {{ $solicitud->fecha_resolucion == null ? 'No resuelta' : date_format(date_create($solicitud->fecha_resolucion), 'd-m-Y') }}
                    </span>
                    <span>
                        <i class="fa-regular fa-circle-dot mr-2"></i>
                        <b>Observaciones:</b>
                        {{ $solicitud->observacion == null ? 'Sin observaciones' : $solicitud->observacion }}
                    </span>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <a href="{{ route('contribuyente.solEstadoFamiliar') }}" class="btn btn-block btn-info">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.master.footer')

@endsection
