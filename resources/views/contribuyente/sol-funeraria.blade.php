@extends('layouts.layouts-forms.master-layout')
@section('title', 'Servicios funerarios')

@section('content')
    <section class="container mt-menu">
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-baseline">
                            <i class="fa-solid fa-hand-holding-heart icono-solicitud mr-3"></i>
                            <h3>Mis solicitudes de servicios funerarios</h3>
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
                            <th>Solicitud</th>
                            <th>Estado de solicitud</th>
                            <th>Fecha de la solicitud</th>
                            <th>Fecha actualización</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solicitudes as $s)
                            <tr>
                                <td>{{ substr($s->solicitud, 0, 15) . ' ...' }}</td>
                                <td>{{ $s->estado_solicitud->desc_estado }}</td>
                                <td>{{ $s->fecha_solicitud->format('d-m-Y') }}</td>
                                <td>{{ $s->fecha_actualizacion->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('contribuyente.detalleSolFuneraria', $s->id_solicitud) }}"
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
