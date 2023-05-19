@extends('layouts.layouts-forms.master-layout')
@section('title', 'Clinica Municipal')
@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/formularios/mobiliario.css') }}">
@endsection
@section('content')
    <div class="fondo" style="background-image: url(/{{ $servicio->imgbg }})">
        <div class="container mt-menu-2 zindex">
            <div class="row justify-content-center  vh-100 ">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header h5 text-center">Solicitudes para eventos sociales</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('regMobiliario') }}" method="POST" id="frm-solicitar">
                                        @csrf
                                        <input type="hidden" id="tipo-solicitud">
                                        <p><b>Nombre:</b> {{ auth()->user()->name }} </p>
                                        <p><b>Dui:</b> {{ auth()->user()->dui }}</p>
                                        <div class="row justify-content-center">
                                            <div class="preloader-wrapper active" id="loader-carga">
                                                <div class="spinner-layer spinner-blue-only">
                                                    <div class="circle-clipper left">
                                                        <div class="circle"></div>
                                                    </div>
                                                    <div class="gap-patch">
                                                        <div class="circle"></div>
                                                    </div>
                                                    <div class="circle-clipper right">
                                                        <div class="circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="botones-iniciales row justify-content-center">
                                            <a onclick="mostrarCampos(1)" class="btn btn-primary"><i
                                                    class="fas fa-building"></i>
                                                Solicitar lugar</a>
                                            <a onclick="mostrarCampos(2)" class="btn btn-secondary"> <i
                                                    class="fas fa-chair"></i>
                                                Solicitar mobiliario</a>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 campo-fecha text-center">

                                                <label for='fecha'>Fecha de evento</label>
                                                <div class="md-form md-outline input-with-post-icon datepicker m-0"
                                                    id="fechacita">
                                                    <input placeholder="Select date" type="text" id="fecha"
                                                        name="fecha" class="form-control">
                                                    <i class="fas fa-calendar input-prefix" tabindex=0></i>
                                                </div>
                                                <div class="mi-error m-0" id="error-fecha"></div>
                                            </div>
                                            <div class="col-md-6 campo-lugar ">
                                                <div class="text-center">
                                                    <label for="lugar">Lugar a solicitar</label>
                                                    <select name="lugar" id="lugar"
                                                        class="browser-default custom-select">
                                                        <option value="" selected>Elija una opción</option>
                                                        <option value="1">Plaza Municipal</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="campos-mobiliario mb-4">
                                            <p class="text-center mt-2">Mobiliario a solicitar</p>

                                            <div class="row justify-content-center">
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            onclick="habilitarCampos('sillas','cantSillas')"
                                                            class="custom-control-input" id="sillas" name="sillas">
                                                        <label class="custom-control-label" value="1"
                                                            for="sillas">Sillas</label>
                                                    </div>
                                                    <input disabled type="number" id="cantSillas" min="1"
                                                        name="cantSillas" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            onclick="habilitarCampos('mesas','cantMesas')"
                                                            class="custom-control-input" id="mesas" name="mesas">
                                                        <label class="custom-control-label" value="1"
                                                            for="mesas">Mesas</label>
                                                    </div>
                                                    <input disabled type="number" id="cantMesas" name="cantMesas"
                                                        min="1" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                            onclick="habilitarCampos('canopis','cantCanopis')"
                                                            class="custom-control-input" id="canopis" name="canopis">
                                                        <label class="custom-control-label" value="1"
                                                            for="canopis">Canopis</label>
                                                    </div>
                                                    <input disabled type="number" id="cantCanopis" name="cantCanopis"
                                                        min="1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        @if (session('message'))
                                            <div class="alert alert-success" role="alert" id='alerta'>
                                                {{ session('message') }} <a href="" class="boton">x</a>
                                            </div>
                                        @endif
                                        <div class="botonera">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <a onclick="mostrarCampos(3)" class="btn btn-warning"><i
                                                            class="fas fa-arrow-left"></i> Regresar</a>

                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-5 text-right">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-check"></i>
                                                        Solicitar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

@endsection

@section('scripts')
    <script src="{{ asset('js/validaciones.js') }}"></script>
    <script src="{{ asset('js/formularios/mobiliario.js') }}"></script>
@endsection
