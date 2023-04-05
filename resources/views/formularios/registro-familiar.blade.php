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
                    <strong>Solicitud de Partidas y Documentos</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0 pt-4">
                    <p>Nombre del solicitante: <strong>{{ auth()->user()->name }}</strong></p>
                    <p>DUI: <strong>{{ auth()->user()->dui }}</strong></p>
                    <!-- Form -->
                    <form class="text-center" style="color: #757575;" action="#!">

                
                        <!-- Subject -->
                        <select class="mdb-select md-form"  id="tipoTramite" name="tipoTramite" searchable="Buscar aquí..">
                            <option value="" selected disabled >Elija una opción</option>
                            @foreach ($tiposoli as $item)
                            <option value="{{ $item->id_t_solicitud }}" >{{ $item->desc_solicitud }}</option>

                            @endforeach

                            
                        </select>
                        <label class="mdb-main-label">Tipo de Partida o Documento</label>
                        <div class="camposPartida">
                        <div class="row" >
                            <div class="col-md-6">
                                <div class="md-form">
                                    <input type="text" id="form1" class="form-control" required>
                                    <label for="form1">Nombre en la partida o documento</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="md-form">
                                    <input type="text" id="form1" class="form-control">
                                    <label for="form1">Folio</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form">
                                    <div id="date-picker-example" class="md-form input-with-post-icon datepicker">
                                        <input placeholder="Select date" type="text" id="example" class="form-control">
                                        
                                        <i class="fas fa-calendar input-prefix" tabindex=0></i>
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <!-- Default checked -->
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="defaultChecked2" checked>
                                    <label class="custom-control-label" for="defaultChecked2">Agregar Autentica($2.00)</label>
                                </div>
                            </div>
                        </div>
                       

                        
                    </div>
                        <!-- Send button -->
                        <button class="btn btn-success btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Enviar Solicitud</button>

                    </form>
                    <!-- Form -->

                </div>

            </div>
            <!-- Material form contact -->
        </div>
       
    </div>
    
@endsection

@section('scripts')
    <script>
    // Material Select Initialization
    $(document).ready(function() {
        $('.mdb-select').materialSelect();
        $('.datepicker').datepicker();
    });

    //filtro de campos para mostra u ocultarlos cuando se elija el tipo de tramite
    $('#tipoTramite').change(function() {
    var tipoTramite = $('#tipoTramite');
        if(tipoTramite.val() <= 3)
        {
            $('.camposPartida').show();
        }
        else
        {
            $('.camposPartida').hide();
        }
    })
</script>

@endsection