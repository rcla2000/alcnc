@extends('layouts.layouts-forms.master-layout')
@section('title', 'Mis solicitudes')

@section('content')
    <section class="container mt-menu">
        <div class="row">
            <h1 class="text-white mt-4 mb-4">Mis solicitudes</h1>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover bg-white" id="tabla-solicitudes">
                    <thead>
                        <tr>
                            <th>Tipo de solicitud</th>
                            <th>Cantidad</th>
                            <th>Estado de solicitud</th>
                            <th>Nombre documento</th>
                            <th>Fecha documento</th>
                            <th>Fecha actualización</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solicitudes as $s)
                            <tr>
                                <td>{{ $s->cat_tipo_solicitud->desc_solicitud }}</td>
                                <td>{{ $s->cantidad }}</td>
                                <td>{{ $s->t_estados_solicitude->desc_estado }}</td>
                                <td>{{ $s->nombre_documento }}</td>
                                <td>{{ $s->fecha_documento->format('d-m-Y') }}</td>
                                <td>{{ $s->fecha_actualizacion->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('contribuyente.solicitud', $s->id_solicitud) }}" class="btn btn-sm btn-info">
                                        Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('layouts.master.footer')

@endsection

@section('scripts')
    <script>
        $('#tabla-solicitudes').DataTable({
            language: {
                'decimal': '',
                'emptyTable': 'No hay información',
                'info': 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                'infoEmpty': 'Mostrando 0 to 0 of 0 Entradas',
                'infoFiltered': '(Filtrado de _MAX_ total entradas)',
                'infoPostFix': '',
                'thousands': ',',
                'lengthMenu': 'Mostrar _MENU_ registros',
                'loadingRecords': 'Cargando...',
                'processing': 'Procesando...',
                'search': 'Buscar:',
                'zeroRecords': 'Sin resultados encontrados',
                'paginate': {
                    'first': 'Primero',
                    'last': 'Último',
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        });
    </script>
@endsection
