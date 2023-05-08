@extends('layouts.layouts-forms.master-layout')
@section('title','Clinica Municipal')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('styles')
   <link rel="stylesheet" href="{{ asset('css/formularios/funeraria.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3 mb-5">
            <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Volver a Inicio</a>

        </div>
    </div>
    <div class="row justify-content-center  vh-100 ">

        <div class="col-md-6">

            <div class="card">
               
     

                <h5 class="card-header h5 text-center">Solicitudes para servicios Funerarios</h5>
                <div class="card-body">
                    <form action="{{ route('regFuneraria') }}" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>Nombre:</b>  {{ auth()->user()->name  }}  </p>  
                            <p><b>Dui:</b> {{ auth()->user()->dui  }}</p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-outline">
                                <textarea class="form-control" id="solicitud" name="solicitud" rows="4"></textarea>
                                <label class="form-label" for="textAreaExample">Escriba su solicitud</label>
                              </div>                   
                         </div>
                        <div class="col-md-12">
                         
                                <button class="btn btn-primary btn-block " type="submit">Enviar Solicitud</button>
                              
                        </div>
                    </div>
                     </form>
                </div>
            </div>
        </div>
    </div>


    @include('footer')

@endsection
 