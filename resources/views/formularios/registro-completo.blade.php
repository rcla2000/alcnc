@extends('layouts.layouts-forms.master-layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/formularios/solicitudes.css')}}">

@endsection
@section('title','Registro Familiar')
    


@section('content')
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-7 ">
            <!-- Material form contact -->
            <div class="card ">

                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>{{ $title }}</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0 pt-4">
                  <p> Estimado <strong>{{ auth()->user()->name }} </strong> su solicitud ha sido enviada de manera exitosa, nuestro equipo le notificara en la brevedad posible la resolución.</p> 
                  

                </div>

            </div>
            <!-- Material form contact -->
        </div>
       
    </div>
    
@endsection

@section('scripts')
    

@endsection