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
                                                id="siguiente">Siguiente paso <i class="fas fa-arrow-right"></i></a>

                                        </div>

                                    </div>
                                </section>
                                <section id="paso2">
                                    <div class="camposPartida">
                                        <div class="row">

                                            <div class="col-md-7">
                                                <div class="md-form">
                                                    <label for="nombreDocumento">* Nombre en la partida o documento</label>
                                                    <input type="text" id="nombreDocumento"
                                                        name="nombreDocumento" class="form-control">
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
                                                    <label class="custom-control-label" for="autentica">Agregar
                                                        Autentica($2.00)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Material textarea-->
                                    <div class="md-form">
                                        <textarea id="comentario" name="comentario" class="md-textarea form-control" rows="3"></textarea>
                                        <label for="comentario">Comentario adicional</label>
                                    </div>
                                    <span class="text-danger">Si la partida o documento contiene <strong class="text-info">
                                            Rúbricas o marginaciones </strong>, se agregará un cobro de $1.00 por cada
                                        rúbrica o marginación al momento del pago.</span>
                                    <a class="btn btn-warning btn-rounded z-depth-0 my-4 waves-effect"
                                        onclick="siguienteAtras('#paso1','#paso2')" id="siguiente"><i
                                            class="fas fa-arrow-left"></i> Paso anterior </a> <!-- Send button -->
                                    <button class="btn btn-primary btn-block" type="submit" id="btn-enviar-solicitud">Enviar solicitud</button>
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

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/formularios/registro-familiar.js') }}"></script>
@endsection
