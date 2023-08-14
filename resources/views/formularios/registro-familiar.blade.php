@extends('layouts.layouts-forms.master-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/formularios/solicitudes.css') }}">
    <style>
        textarea {
            resize: none !important;
        }

        #paso2 {
            display: none;
        }
    </style>
@endsection

@section('title', 'Registro Familiar')

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <div class="fondo" style="background-image: url({{ $servicio->imgbg }})">
        <div class="container zindex">
            <div class="row justify-content-center align-items-center mt-menu-2 mb-5">
                <div class="col-md-7 ">
                    <!-- Material form contact -->
                    <div class="card ">
                        <h5 class="card-header info-color white-text text-center py-4">
                            <strong>Solicitud de Partidas y Documentos</strong>
                        </h5>

                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0 pt-4">
                            <p>Nombre del solicitante: <strong>{{ auth()->user()->name }}</strong></p>
                            <p>DUI: <strong>{{ auth()->user()->dui }}</strong></p>
                            <!-- Form -->
                            <form class="text-center" action="{{ route('regSolicitud') }}" method="POST" id="registroForm">
                                @csrf
                                <section id="paso1">
                                    <input type="hidden" name="dui" value="{{ auth()->user()->dui }}">
                                    <input type="hidden" name="area" value="{{ $idarea }}">
                                    <input type="hidden" name="title" value="Solicitud de Partidas y Documentos">
                                    <div class="row">
                                        <div class="col-md-12 text-left">
                                            <span class="text-danger">(*) Campos obligatorios</span>
                                        </div>
                                        <div class="col-md-8">
                                            <!-- Subject -->
                                            <select class="mdb-select md-form" id="tipoTramite" name="tipoTramite"
                                                searchable="Buscar aquí.." required>
                                                <option value="" selected disabled>Elija una opción</option>
                                                @foreach ($tiposoli as $item)
                                                    <option value="{{ $item->id_t_solicitud }}">{{ $item->desc_solicitud }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label class="mdb-main-label">* Tipo de Partida o Documento</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form">
                                                <input type="number" class="form-control" name="cantidad" id="cantidad"
                                                    min="1" max="10" required>
                                                <label for="cantidad">* Cantidad</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a class="btn btn-primary btn-block" onclick="siguienteAtras('#paso2','#paso1')"
                                                id="siguiente">
                                                Siguiente paso
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </section>
                                <section id="paso2">
                                    <div class="camposPartida">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="md-form">
                                                    <label for="nombreDocumento">* Nombre en la partida o documento</label>
                                                    <input type="text" id="nombreDocumento" name="nombreDocumento"
                                                        class="form-control">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="md-form">
                                                    <div id="date-picker-example"
                                                        class="md-form input-with-post-icon datepicker">
                                                        <input placeholder="dd/mm/yyyy" type="text" id="fechaDoc"
                                                            name="fechaDoc" class="form-control">
                                                        <i class="fas fa-calendar input-prefix" tabindex=0></i>
                                                    </div>
                                                    <div class="mi-error" id="error-fecha-nacimiento"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 " style="align-self: center">
                                                <!-- Default checked -->
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="autentica"
                                                        name="autentica" value="1">
                                                    <label class="custom-control-label" for="autentica">
                                                        Agregar Auténtica($2.00)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Material textarea-->
                                    <div class="md-form">
                                        <textarea id="comentario" name="comentario" class="md-textarea form-control" rows="3"></textarea>
                                        <label for="comentario">Comentario adicional</label>
                                    </div>
                                    <span class="text-danger">
                                        Si la partida o documento contiene <strong class="text-info">
                                            Rúbricas o marginaciones </strong>, se agregará un cobro de $1.00 por cada
                                        rúbrica o marginación al momento del pago.
                                    </span>
                                    <a class="btn btn-primary btn-block mt-2" onclick="siguienteAtras('#paso1','#paso2')"
                                        id="siguiente">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Paso anterior
                                    </a> <!-- Send button -->
                                    <button class="btn btn-success btn-block mt-2" type="button" id="btn-enviar-solicitud">
                                        <i class="fa-solid fa-check mr-2"></i>
                                        Enviar solicitud
                                    </button>
                                    </button>
                                    <!-- Button trigger modal -->
                                </section>
                            </form>
                            <!-- Form -->

                        </div>

                    </div>
                    <!-- Material form contact -->
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-pago" tabindex="-1" role="dialog" aria-labelledby="modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header info-color white-text text-center py-4">
                    <h5 class="modal-title" id="modal-label">
                        <b>
                            Formulario de pago
                        </b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="md-form input-with-post-icon">
                                <i class="fa-regular fa-credit-card input-prefix"></i>
                                <label for="tarjeta">Número de tarjeta</label>
                                <input type="text" id="tarjeta" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="md-form">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-0">
                            <span><b>Vencimiento de la tarjeta</b></span>
                        </div>
                        <div class="col-6">
                            <label class="mdb-main-label" for="mes">Mes</label>
                            <select class="mdb-select md-form" id="mes">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <div class="mi-error"></div>
                        </div>
                        <div class="col-6">
                            <label class="mdb-main-label" for="anio">Año</label>
                            <select class="mdb-select md-form" id="anio">
                                @for ($i = date('Y'); $i <= date('Y') + 20; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <div class="mi-error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="md-form input-with-post-icon">
                                <i class="fa-solid fa-user input-prefix"></i>
                                <label for="nombres">Nombres</label>
                                <input type="text" id="nombres" class="form-control">
                            </div>
                            <div class="mi-error"></div>
                        </div>
                        <div class="col-6">
                            <div class="md-form input-with-post-icon">
                                <i class="fa-solid fa-user input-prefix"></i>
                                <label for="apellidos">Apellidos</label>
                                <input type="text" id="apellidos" class="form-control">
                            </div>
                            <div class="mi-error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="md-form input-with-post-icon">
                                <i class="fa-regular fa-envelope input-prefix"></i>
                                <label for="email">Correo electrónico:</label>
                                <input type="email" id="email" class="form-control">
                            </div>
                            <div class="mi-error"></div>
                        </div>
                        <div class="col-6">
                            <div class="md-form input-with-post-icon">
                                <i class="fa-solid fa-mobile input-prefix"></i>
                                <label for="telefono">Teléfono:</label>
                                <input type="tel" id="telefono" class="form-control">
                            </div>
                            <div class="mi-error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="region">País y región</label>
                            <select id="region"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="md-form">
                                <label for="direccion">Dirección</label>
                                <textarea id="direccion" class="md-textarea form-control" rows="3"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <span class="total" id="totalCancelar"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn-pago">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/formularios/registro-familiar.js') }}"></script>
@endsection
