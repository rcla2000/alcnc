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
                    <form class="text-center"  action="{{ route('regSolicitud') }}" method="POST">

                        @csrf
                        <input type="hidden" name="dui" value="{{ auth()->user()->dui }}">
                        <input type="hidden" name="title" value="Solicitud de Partidas y Documentos">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <span class="text-danger">(*) Campos obligatorios</span>
                            </div>
                            <div class="col-md-8">
                                 <!-- Subject -->
                                <select class="mdb-select md-form"  id="tipoTramite" name="tipoTramite" searchable="Buscar aquí.." required>
                                    <option value="" selected disabled >Elija una opción</option>
                                    @foreach ($tiposoli as $item)
                                    <option value="{{ $item->id_t_solicitud }}" >{{ $item->desc_solicitud }}</option>

                                    @endforeach
                                </select>
                                <label class="mdb-main-label">* Tipo de Partida o Documento</label>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form">
                                    <input type="number" class="form-control" name="cantidad" id="cantidad" min="1" max="10" required>
                                    <label for="form1">* Cantidad</label>

                                </div>
                            </div>


                        </div>
                        
                       
                        <div class="camposPartida">
                        <div class="row" >
                        
                            <div class="col-md-7">
                                <div class="md-form">
                                    <input type="text" id="nombreDocumento" name="nombreDocumento" class="form-control" >
                                    <label for="nombreDocumento">* Nombre en la partida o documento</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="md-form">
                                    <div id="date-picker-example"  class="md-form input-with-post-icon datepicker">
                                        <input placeholder="" type="text" id="fechaDoc" name="fechaDoc" class="form-control">
                                         
                                        <i class="fas fa-calendar input-prefix" tabindex=0></i>
                                      </div>
                                </div>
                            </div>
                         
                            
                            <div class="col-md-6 " style="align-self: center">
                                <!-- Default checked -->
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="autentica" name="autentica" value="1">
                                    <label class="custom-control-label" for="autentica">Agregar Autentica($2.00)</label>
                                </div>
                            </div>
                        </div>
                       

                        
                    </div>
                        <!--Material textarea-->
                        <div class="md-form">
                            <textarea id="comentario" name="comentario" class="md-textarea form-control" rows="3"></textarea>
                            <label for="comentario">Comentario adicional</label>
                        </div>                        <!-- Send button -->
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
        $('.datepicker').datepicker(
            {
                format: 'dd/mm/yyyy',
                formatSubmit:'dd/mm/yyyy',
                hiddenPrefix: 'prefix__',
                hiddenSuffix: '__suffix'
            }
        );
    });

    //filtro de campos para mostra u ocultarlos cuando se elija el tipo de tramite
    $('#tipoTramite').change(function() {
         var tipoTramite = $('#tipoTramite');
        if(tipoTramite.val() <= 3)
        {
            valor =  tipoTramite.val(); 
            console.log(valor);
            $('.camposPartida').show();
            switch (valor) {
                case '1':
                    $('#fechaDoc').attr('placeholder', '* Fecha de nacimiento');

                    break;
                case '2': 
                    $('#fechaDoc').attr('placeholder', '* Fecha de matrimonio');
                    break;
                case '3':
                    $('#fechaDoc').attr('placeholder', '* Fecha de defunción');
                    break;
            }    
            
            $('#nombreDocumento').attr('required',true);

            $('#fechaDoc').attr('required',true);
        
        }
        else
        {
            $('.camposPartida').hide();
            $('#nombreDocumento').attr('required',false);
            $('#fechaDoc').attr('required',false);

        }
    })
</script>

@endsection