@extends('layouts.layouts-forms.master-layout')
@section('title', 'Contacto')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/formularios/denuncias.css') }}">

@endsection
@section('content')
    <div class="fondo" style="background-image: url({{ $servicio->imgbg }})">
        <div class="container mt-menu-2 zindex">
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-6">
                    <!-- Material form contact -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset('img/logo.svg') }}" class="logoSvg logo-footer z-depth-1-half mb-2"
                                        alt="">
                                </div>
                                <div class="col-md-10">
                                    <h3 class="text-center"><strong>Contacto Ciudadano</strong></h3>
                                    <h5 class=" text-center py-2"><strong>Alcaldía Nuevo Cuscatlán</strong>

                                    </h5>
                                </div>
                            </div>
                        </div>

                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0 mt-3">
                            <!-- Form -->
                            <form style="color: #757575;" method="POST"
                                action="{{ route('regDenuncia') }}" id="frm-denuncia">
                                @csrf
                                <!-- nombre -->
                                <!-- Material outline input -->
                                <div class="md-form md-outline">
                                    <label for="name">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <!-- telefono -->
                                <div class="md-form md-outline">
                                    <label for="name">Teléfono</label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <!-- Subject -->

                                <div class="form-group">
                                    <label for="tipoAsunto">Tipo de asunto</label>
                                    <select class="browser-default custom-select" name="tipoAsunto" id="tipoAsunto">
                                    <option value="1">Solicitud e información de alcaldía</option>
                                    <option value="2">Solicitud de canchas</option>
                                    <option value="3">Solicitud al CAM</option>
                                    <option value="4">Limpieza y recolección de basura</option>
                                    <option value="5">Problemas en calles y aceras</option>
                                    <option value="6">Problemas de agua y acueductos</option>
                                    <option value="7">otros</option>
                                </select>
                                </div>

                                <div class="md-form md-outline " style="display: none" id="fechadiv">
                                    <input type="date" name="fecha" id="fecha" class="form-control mb-4"
                                        min=@php
$hoy=date("Y-m-d"); echo $hoy; @endphp disabled>
                                    <label for="fecha">Fecha para solicitar cancha</label>
                                </div>

                                <!--Message-->
                                <div class="">
                                    <label for="mensaje">Mensaje o asunto</label>
                                    <textarea class="form-control rounded-0" id="mensaje" name="mensaje" rows="3" placeholder="Mensaje o asunto"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Send button -->
                                <button class="btn btn-primary btn-block my-4" type="submit" id="btn-enviar">Enviar mensaje</button>
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
    <script type="text/javascript" src="{{ asset('js/formularios/denuncia.js') }}"></script>
@endsection
