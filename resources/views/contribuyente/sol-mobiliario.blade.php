@extends('layouts.layouts-forms.master-layout')
@section('title', 'Solicitud de mobiliario')

@section('content')
    <section class="container mt-menu">
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-baseline">
                            <i class="fa-solid fa-chair icono-solicitud mr-3"></i>
                            <h3>Mis solicitudes de mobiliario</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover bg-white" id="tabla-solicitudes">
                    <thead>
                        <tr>
                            <th>Lugar solicitado</th>
                            <th>Fecha de evento</th>
                            <th>Estado de solicitud</th>
                            <th>Fecha de la solicitud</th>
                            <th>Fecha actualización</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solicitudes as $s)
                            <tr>
                                <td>{{ $s->lugar_solicitado }}</td>
                                <td>{{ date_format(date_create($s->fecha_evento), 'd-m-Y') }}</td>
                                <td>{{ $s->estado_solicitud->desc_estado }}</td>
                                <td>{{ date_format(date_create($s->fecha_solicitud), 'd-m-Y') }}</td>
                                <td>{{ date_format(date_create($s->fecha_actualizacion), 'd-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('contribuyente.detalleSolMobiliario', $s->id_solicitud) }}"
                                        class="btn btn-sm btn-info">
                                        Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <a href="{{ route('contribuyente.solicitudes') }}" class="btn btn-block btn-info">Volver</a>
            </div>
        </div>
    </section>

    @include('layouts.master.footer')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/contribuyentes/datatables.js') }}"></script>
@endsection
