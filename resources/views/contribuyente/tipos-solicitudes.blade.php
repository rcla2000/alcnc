@extends('layouts.layouts-forms.master-layout')
@section('title', 'Mis solicitudes')

@section('content')
    <section class="container mt-menu">
        <br>
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-baseline">
                    <i class="fa-solid fa-file-invoice icono-solicitud mr-3"></i>
                    <h3>Mis solicitudes</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-3">
                <a href="{{ route('contribuyente.solEstadoFamiliar') }}">
                    <div class="card tipo-solicitud">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-people-roof icono-tipo-sol"></i>
                            <hr>
                            <h5>Registro del estado familiar</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="">
                    <div class="card tipo-solicitud">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-house icono-tipo-sol"></i>
                            <hr>
                            <h5>Catastro</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="{{ route('contribuyente.solFuneraria') }}">
                    <div class="card tipo-solicitud">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-hand-holding-heart icono-tipo-sol"></i>
                            <hr>
                            <h5>Servicios funerarios</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-3">
                <a href="{{ route('contribuyente.solMobiliario') }}">
                    <div class="card tipo-solicitud">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-chair icono-tipo-sol"></i>
                            <hr>
                            <h5>Mobiliario</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </section>

    @include('layouts.master.footer')

@endsection
