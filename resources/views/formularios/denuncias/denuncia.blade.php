@extends('layouts.layouts-forms.master-layout')
@section('title','Contacto')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/formularios/denuncias.css')}}">

@endsection
@section('content')
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <!-- Material form contact -->
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

                  <!--Card content-->
                  <div class="card-body px-lg-5  pt-0 mt-3">

                    <!-- Form -->
                    <form class="text-center" style="color: #757575;"  method="POST" action="{{ route('regDenuncia') }}" >
                        @csrf
                        <!-- nombre -->
                        <!-- Material outline input -->
                        <div class="md-form md-outline">
                            <input type="text" id="name" name="name" class="form-control"  required>
                            <label for="name">Nombre</label>
                        </div>
                        <!-- telefono -->
                        <div class="md-form md-outline">
                            <input type="text" id="phone" name="phone" class="form-control mb-4" required>
                            <label for="name">Teléfono</label>
                        </div>
                        <!-- Subject -->
                
                        <select class="browser-default custom-select mb-4"  name="tipoAsunto" id="tipoAsunto" required>
                            <option value="" disabled  selected>Tipo de asunto</option>
                            <option value="1">Solicitud e información de alcaldía</option>
                            <option value="2">Solicitud de canchas</option>
                            <option value="3">Solicitud al CAM</option>                             
                            <option value="4">Limpieza y recolección de basura</option>
                            <option value="5">Problemas en calles y aceras</option>
                            <option value="6">Problemas de agua y acueductos</option>
                            <option value="7">otros</option>

                        </select>
                  
                        <div class="md-form md-outline " style="display: none" id="fechadiv">
                            <input type="date" name="fecha" id="fecha" class="form-control mb-4" min=@php
                            $hoy=date("Y-m-d"); echo $hoy;
                            @endphp   disabled>
                            <label for="fecha">Fecha para solicitar cancha</label>

                        </div>

                        <!--Message-->
                        <div class="form-group">
                            <textarea class="form-control rounded-0" id="mensaje" name="mensaje" rows="3" placeholder="Mensaje o asunto" required></textarea>
                        </div>

                         

                        <!-- Send button -->
                        <button class="btn btn-success btn-block  my-4" type="submit">Enviar mensaje</button>

                      </form>
                      <!-- Form -->

                  </div>

                </div>
                <!-- Material form contact -->
                
            </div>
        </div>
@endsection


@section('scripts')
    <script>// Material Select Initialization
        $(document).ready(function() {
          $('.mdb-select').materialSelect();
        });
        var asunto =  $('#tipoAsunto');
        asunto.change(function (){
            
            if( asunto.val() === '2'){
                $('#fecha').prop('disabled',false)
                $('#fechadiv').show();
            }
            else{
                $('#fecha').prop('disabled',true)
                $('#fechadiv').hide();

            }
        });
        </script>
@endsection