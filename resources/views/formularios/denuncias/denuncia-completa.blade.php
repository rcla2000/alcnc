@extends('layouts.layouts-forms.master-layout')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <!-- Card -->
        <div class="card">

            <div class="card-header bg-gray-ni">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('img/logo.svg') }}" class="logoSvg logo-footer z-depth-1-half mb-2" alt="" >
                    </div>
                    <div class="col-md-10">
                        <h3 class="text-center"><strong>Contacto Ciudadano</strong></h3>
                        <h5 class=" text-center py-2"><strong>Alcaldía Nuevo Cuscatlán</strong>
                    
                        </h5>
                    </div>
                </div>
            </div>
        
            <!-- Card content -->
            <div class="card-body">
        
            <!-- Title -->
            <h4 class="card-title">Mensaje enviado</h4>
            <!-- Text -->
            <p class="card-text">Su denuncia ha sido enviada de manera éxitosa, el área correspondiente se contactará en la brevedad.</p>
            <!-- Button -->
            <a href="{{ route('denuncia') }}" class="btn bg-cyan-ni">Regresar</a>
        
            </div>
        
        </div>
        <!-- Card -->
    </div>
</div>


@endsection