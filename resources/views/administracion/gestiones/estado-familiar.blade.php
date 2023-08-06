@extends('layouts.layouts-dash.master-layout')
@section('title', 'Gestiones')
@section('styles')
    <style>
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:before {
            bottom: .5em;
        }
    </style>
@endsection

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Table with panel -->
            <div class="card card-cascade narrower">
                <!--Card image-->
                <div
                    class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

                    <h4 class="white-text mx-3">Lista de solicitudes</h4>

                    <div>
                        <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                            <i class="fas fa-info-circle mt-0"></i>
                        </button>
                    </div>

                </div>
                <!--/Card image-->

                <div class="px-4">
                    <div class="table-wrapper">
                        <!--Table-->
                        <table id="dtBasicExample" class="table table-hover mb-0">
                            <!--Table head-->
                            <thead class="text-center">
                                <tr>
                                    <th class="">
                                        <a>No.
                                        </a>
                                    </th>
                                    <th class="th-lg">
                                        <a href="">Nombre

                                        </a>
                                    </th>
                                    <th class="th-lg">
                                        <a href="">Solicitud
                                        </a>
                                    </th>
                                    <th class="th-lg">
                                        <a href="">Fecha de solictud
                                        </a>
                                    </th>
                                    <th class="">
                                        <a href="">Estado
                                        </a>
                                    </th>

                                    <th class="th-lg">
                                        <a href="">Area
                                        </a>
                                    </th>
                                    <th class="th-lg">
                                        <a href="">Acciones

                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>
                                @foreach ($lista as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->solicitud }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item->fecha)) }}</td>
                                        <td class="text-center">
                                            @switch($item->estado)
                                              @case('Abierta')
                                                <span class="badge badge-warning">
                                              @break
                                              @case('Pendiente de pago')
                                                <span class="badge badge-info">
                                              @break
                                              @case('Completada')
                                                <span class="badge badge-success ">
                                              @break
                                              @default
                                              <span class="badge badge-danger ">
                                            @endswitch {{ $item->estado }}</span>
                                        </td>
                                        <td>{{ $item->area }}</td>
                                        <td class="text-center">
                                            <a class="btn-floating btn-sm btn-default" data-toggle="tooltip"
                                                onclick="detaSoli({{ $item->id }})" data-placement="top"
                                                title="Ver detalles de solicitud"><i class="fas fa-eye"></i></a>

                                            <a class="btn-floating btn-sm btn-light-green"
                                                href="{{ route('mandamiento', $item->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="Procesar solicitud"><i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
            <!-- Table with panel -->
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
        // Tooltips Initialization
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function detaSoli(idSoli) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post("/detalle-gestion", {
                    id: idSoli
                },
                function(data, status) {
                    $('#detalleSolicitud').empty();
                    $('#detalleSolicitud').html(data);
                    $('#centralModalSm').modal('toggle')
                }).fail(function(e) {
                console.log(e);
                alert("error: " + e);
            });
        }
    </script>
@endsection


@section('modal')
    <!-- Central Modal Small -->
    <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Detalles de solicitud</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detalleSolicitud">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-indigo btn-sm" data-dismiss="modal">Cerrar</button>
                    {{-- <button type="button" class="btn btn-primary btn-sm">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Central Modal Small -->
@endsection
