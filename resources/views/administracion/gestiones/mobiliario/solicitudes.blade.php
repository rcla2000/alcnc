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

@section('content')
    <div class="row mb-4">
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
                                        <th class="th-sm">
                                            Acciones
                                         </th>
                                        <th class="th-sm">
                                           DUI solicitante
                                        </th>
                                        <th class="th-sm">
                                           Lugar solicitado
                                        </th>
                                        <th class="th-sm">
                                           Fecha de solictud
                                        </th>
                                        <th class="th-sm">
                                           Fecha de evento
                                        </th>
                                        <th class="th-sm">
                                           Estado
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
    <script type="text/javascript" src="{{ asset('js/dashboard/gestiones/extras-dt.js') }}"></script>
@endsection
