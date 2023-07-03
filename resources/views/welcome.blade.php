@extends('layouts.master.master-layout')

@section('container')
    <section class="container-fluid mt-menu animate__animated animate__fadeInDown">
        <div class="row wow justify-content-center title-section2">
            <h2 class="text-center text-white">
                <i class="fas fa-clipboard-list mr-2"></i>
                Servicios frecuentes
            </h2>
        </div>
    </section>

    <section class="section1 animate__animated animate__fadeIn contenedor-servicios">
        {{-- SERVICIOS EN LINEA --}}
        <div class="container">
            <div class="row">
                @foreach ($servicios as $item)
                    <div class="col-md-4 mb-3 text-center justify-content-center ">
                        <!-- Card -->
                        <div class="card card-servicio card-image z-depth-4" style="background-image: url({{ $item->imgbg }});">

                            <!-- Content -->
                            <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                                <div>
                                    <h3 class="white-text"><i class="{{ $item->icono }}"></i></h3>
                                    <h5 class="card-title pt-2"><strong>{{ $item->des_servicio }}</strong></h5>

                                    <a class="btn btn-blue"
                                        href="{{ route($item->ruta, ['idarea' => $item->id_area, 'idsol' => $item->id_servicio]) }}">
                                        <i class="fas fa-clone left"></i>
                                        Ir a servicio
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- Card -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="container-fluid mb-3 mb-md-4">
        <div class="row wow justify-content-center title-section2">
            <h2 class="text-center text-white">
                <i class="far fa-envelope mr-2"></i>
                Contáctanos
            </h2>
        </div>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-12 col-md-6 mb-2">
                <!-- Material form contact -->
                <div class="card altura-contacto">
                    <h5 class="card-header white-text text-center py-4">
                        <i class="fa-solid fa-envelope white-text mr-2"></i>
                        <strong>Envíanos un mensaje</strong>
                    </h5>
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                        <!-- Form -->
                        <form method="POST" action="{{ route('mensaje.guardar') }}" id="frm-mensaje">
                            @csrf
                            <!-- Name -->
                            <div class="md-form mt-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}">
                                <div class="invalid-feedback">
                                    @error('nombre')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="md-form mt-3">
                                <label for="telefono">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{old('telefono')}}">
                                <div class="invalid-feedback">
                                    @error('telefono')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- <div class="md-form mt-3">
                                <!-- Subject -->
                                <label for="area">Tipo de reporte</label>
                                <select class="mdb-select" name="area" id="area">
                                    <option value="2">Reporte 1</option>
                                    <option value="3">Reporte 2</option>
                                    <option value="4">Reporte 3</option>
                                </select>
                            </div> --}}

                            <!--Message-->
                            <div class="md-form">
                                <label for="mensaje" class="mb-2">Mensaje</label>
                                <textarea id="mensaje" class="form-control md-textarea @error('mensaje') is-invalid @enderror" rows="3" id="mensaje" name="mensaje">{{old('mensaje')}}</textarea>
                                <div class="invalid-feedback">
                                    @error('mensaje')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!-- Send button -->
                            <button class="btn btn-primary btn-block"
                                type="submit">Enviar</button>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
                <!-- Material form contact -->
            </div>
            <div class="col-12 col-md-6">
                <div class="z-depth-3 p-3 bg-light rounded altura-contacto">
                    <div class="contenedor-mapa">
                        <iframe class="mapa"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1221.2346017244167!2d-89.26595737311105!3d13.646909720896758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f632e12abcc8147%3A0xa316fc34131ef94!2sJPWM%2BQQ8%2C%20Nuevo%20Cuscatlan!5e0!3m2!1ses-419!2ssv!4v1679542970225!5m2!1ses-419!2ssv"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script>
        $('.carousel').carousel()

        $(document).ready(function() {
            new WOW().init();
        });

        const nombre = document.querySelector('#nombre');
        const telefono = document.querySelector('#telefono');
        const mensaje = document.querySelector('#mensaje');
        const form = document.querySelector('#frm-mensaje');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            let errores = 0;

            if (estaVacio(nombre.value)) {
                errores += 1;
                agregarError(
                    nombre,
                    nombre.nextElementSibling,
                    'Ingrese su nombre completo'
                );
            } else {
                limpiarError(nombre, nombre.nextElementSibling);
            }

            if (estaVacio(telefono.value)) {
                errores += 1;
                agregarError(
                    telefono,
                    telefono.nextElementSibling,
                    'Ingrese su número de teléfono'
                );
            } else {
                limpiarError(telefono, telefono.nextElementSibling);
            }

            if (estaVacio(mensaje.value)) {
                errores += 1;
                agregarError(
                    mensaje,
                    mensaje.nextElementSibling,
                    'Ingrese el mensaje a enviar'
                );
            } else {
                limpiarError(mensaje, mensaje.nextElementSibling);
            }

            if (errores == 0) {
                $.confirm({
                    title: 'Confirmar información',
                    content: '¿Esta seguro/a que desea enviar su mensaje?',
                    buttons: {
                        si: {
                            text: 'SÍ',
                            btnClass: 'btn-success',
                            keys: ['enter', 'shift'],
                            action: function(){
                                form.submit();
                            }
                        },
                        no: {
                            text: 'NO',
                            btnClass: 'btn-danger',
                            keys: ['enter', 'shift'],
                            action: function(){
                                $.alert({
                                    title: 'Información',
                                    content: 'Operación cancelada',
                                });
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
