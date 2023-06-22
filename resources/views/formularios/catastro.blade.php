@extends('layouts.layouts-forms.master-layout')
@section('title', 'Catastro')
@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="fondo" style="background-image: url({{ $servicio->imgbg }})">
        <div class="container zindex">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <h5 class="card-header h5 text-center">Documentos Catastro</h5>
                        <div class="card-body">
                            <p><b>Nombre:</b> {{ auth()->user()->name }} </p>
                            <p><b>Dui: </b>{{ auth()->user()->dui }}</p>
                            <form action="" method="POST" id="frm-cita">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="formulario" class="mdb-main-label">Seleccione un tipo de formulario</label>
                                    <select class="mdb-select" searchable="Search here.." name="formulario" id="formulario">
                                        <option value="1">Formulario A</option>
                                        <option value="2">Formulario B</option>
                                        <option value="3">Formulario C</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary" id="btn-aceptar">
                                    Aceptar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footer')

@endsection

@section('scripts')
    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });

        const btn = document.querySelector('#btn-aceptar');

        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const formulario = document.querySelector('#formulario');
            let url = 'http://' + window.location.host + '/docs/formularios/';

            switch(parseInt(formulario.value)) {
                case 1:
                    url += 'Formulario A factibilidad de proyecto.pdf';
                    break;
                case 2:
                    url += 'Formulario B permiso de proyecto.pdf';
                    break;
                case 3:
                    url += 'Formulario C Recepcion.pdf';
                    break;
            }
            console.log(url)
            const win = window.open(url, '_blank');
            //win.focus();
        });
    </script>
@endsection
