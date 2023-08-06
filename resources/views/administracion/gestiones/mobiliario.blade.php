@extends('layouts.layouts-dash.master-layout')
@section('title', 'Solicitudes mobiliario')
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
                        <div class="table-responsive">
                            <!--Table-->
                            <table id="tabla-mobiliario" class="table table-sm table-hover mb-0">
                                <!--Table head-->
                                <thead class="text-center">
                                    <tr>
                                        <th class="th-lg">
                                           DUI solicitante
                                        </th>
                                        <th class="th-lg">
                                           Lugar solicitado
                                        </th>
                                        <th class="th-lg">
                                           Fecha de solictud
                                        </th>
                                        <th class="th-lg">
                                           Fecha de evento
                                        </th>
                                        <th class="th-lg">
                                           Estado
                                        </th>
                                        <th class="th-lg">
                                           Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>
                                </tbody>
                                <!--Table body-->
                            </table>
                            <!--Table-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table with panel -->
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/dashboard/gestiones/mobiliario.js') }}"></script>
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
