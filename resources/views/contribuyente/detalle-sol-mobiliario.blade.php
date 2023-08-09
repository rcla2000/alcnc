@extends('layouts.layouts-forms.master-layout')
@section('title', 'Mi solicitud')

@section('content')
    <section class="container mt-menu">
        <br>
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-baseline">
                    <i class="fa-solid fa-file-invoice icono-solicitud mr-3"></i>
                    <h3>Información de la solicitud</h3>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('partials.info-sol-mobiliario', ['solicitud' => $solicitud])
                <div class="row mt-4">
                    <div class="col-12">
                        <a href="{{ route('contribuyente.solMobiliario') }}" class="btn btn-block btn-info">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.master.footer')

@endsection
