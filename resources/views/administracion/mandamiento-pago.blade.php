@extends('layouts.layouts-dash.master-layout')
@section('title', 'gestiones')

@section('styles')
    <style>
        .table-bordered {
            border: black !important;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="text-uppercase"><u><strong> Crear mandamiento de pago </strong></u></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    Fecha: <strong> {{ date('d-m-Y h:i:s') }} </strong>
                </div>
                <div class="col-md-6">
                    Tipo de Solicitud: <strong>{{ $solicitud->solicitud }}</strong>
                </div>
                <div class="col-md-4">
                    Nombre:<strong> {{ $solicitud->nombre }} </strong>
                </div>
                <div class="col-md-2">
                    DUI:<strong> {{ $solicitud->dui }} </strong>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-sm table-hover table-bordered table-striped">
                        <thead class="unique-color white-text text-center">
                            <tr>

                                <th scope="col">Servicio</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Impuesto</th>
                                <th scope="col">Sub-Total</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="fila-informacion">
                                @foreach ($cargos as $item)
                                    <td>{{ $item->impuesto }}</td>
                                    <td>@money($item->precio * 100, 'USD')</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td data-toggle="tooltip"
                                    data-placement="top" title="Sin impuesto">$0.00</td>
                                    <td>@money($item->subtotal * 100, 'USD')</td>
                                    <td class="text-center">
                                        <a class="btn-floating btn-sm btn-success" data-toggle="tooltip"
                                            data-placement="top" title="Agregar cantidad" id="btn-agregar">
                                            <i class="fas fa-plus"></i>
                                        </a> 
                                        <a class="btn-floating btn-sm btn-danger" data-toggle="tooltip"
                                            data-placement="top" title="Reducir cantidad" id="btn-reducir">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                        <a class="btn-floating btn-sm btn-warning" data-toggle="tooltip"
                                            data-placement="top" title="Remover impuesto" id="btn-eliminar-impuesto">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <select class="mdb-select md-form mt-1" searchable="Search here..">
                        <option value="" disabled selected>Seleccionar impuesto</option>
                        @foreach ($aranceles as $item)
                            <option value="{{ $item->id_arancel }}" data-secondary-text="Precio: @money($item->precio * 100, 'USD')">
                                {{ $item->desc_arancel }}</option>
                        @endforeach
                    </select>
                    <label class="mdb-main-label">Agregar impuesto</label>
                    <a href="" class="btn btn-sm btn-block btn-primary">Agregar</a>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/dashboard/gestiones/estado-familiar/mandamiento-pago.js') }}">
    </script>
@endsection
