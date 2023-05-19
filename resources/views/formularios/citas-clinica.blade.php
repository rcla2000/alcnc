@extends('layouts.layouts-forms.master-layout')
@section('title', 'Clinica Municipal')
@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/formularios/clinica.css') }}">
@endsection
@section('content')
    <div class="fondo" style="background-image: url({{ $servicio->imgbg }})">
        <div class="container zindex">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <h5 class="card-header h5 text-center">Clínica Municipal - Registro de citas</h5>
                        <div class="card-body">
                            <p><b>Nombre:</b> {{ auth()->user()->name }} </p>
                            <p><b>Dui: </b>{{ auth()->user()->dui }}</p>
                            <form action="{{ route('regCita') }}" method="POST" id="frm-cita">
                                @csrf
                                <div class="form-group">
                                    <label for="espe">Seleccione una especialidad:</label>
                                    <select class="browser-default custom-select mb-2" id="espe" name="espe">
                                        <option value="" selected>Seleccione especialidad</option>
                                        @foreach ($especialidades as $item)
                                            <option value="{{ $item->id_especialidad }}">{{ $item->des_especialidad }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <label for="fecha" class="m-0">Seleccione una fecha para cita:</label>
                                <div class="md-form md-outline input-with-post-icon datepicker m-0" id="fechacita">
                                    <input placeholder="Select date" type="text" id="fecha" name="fecha"
                                        class="form-control">
                                    <i class="fas fa-calendar input-prefix" tabindex=0></i>
                                </div>
                                <div class="mi-error m-0" id="error-fecha"></div>
                                <button type="submit" class="btn btn-block btn-primary">Registrar cita</button>
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
    <script src="{{ asset('js/validaciones.js') }}"></script>
    <script src="{{ asset('js/formularios/citas-clinica.js') }}"></script>
@endsection
