@extends('layouts.master.master-layout')

@section('container')
    <section class="container-fluid pt-2 mb-2 mt-0 z-depth-3 title-section2">
        <div class="row  wow fadeInUp justify-content-center  text-center" style="margin-top:130px">
            <div class="col-md-6  text-white mb-4">
                <h2 class=""><i class="fas fa-clipboard-list"></i> Servicios Frecuentes</h2>   
            </div>
        </div>
    </section>
    <section class="container section1">
        {{-- SERVICIOS EN LINEA --}}
           

            <div class="row  wow fadeInUp">
                @foreach ($servicios as $item)
                    <div class="col-md-4 mb-3 text-center justify-content-center ">
                        <!-- Card -->
                        <div class="card card-image z-depth-4"
                            style="background-image: url({{ $item->imgbg }});">

                            <!-- Content -->
                            <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                                <div>
                                    <h3 class="white-text"><i class="{{ $item->icono }}"></i></h3>
                                    <h3 class="card-title pt-2"><strong>{{ $item->des_servicio }}</strong></h3>
                        
                                    <a class="btn btn-blue" href="{{ route($item->ruta, ['idarea'=>$item->id_area,'idsol'=>$item->id_servicio]) }}"><i class="fas fa-clone left"></i>Ir a servicio</a>
                                </div>
                            </div>

                        </div>
                        <!-- Card -->
                    </div>
                @endforeach
            
                
            

        
                
            </div>
    </section>
    <section class="container-fluid pt-4 mb-3 mt-3 z-depth-3 title-section2">
        <div class="row  wow fadeInUp justify-content-center  text-center" >
            <div class="col-md-6  text-white mb-4">
                <h2 class=""><i class="far fa-envelope"></i> Contáctanos</h2>   
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row" >
            <div class="col-md-6 text-center mb-2">
                
                <div class="z-depth-3 p-3 bg-light rounded">
                    <h2 class="title-section ">Contáctanos</h2>   
                    <form action="" method="POST">
                    
                        <input type="text" class="form-control mb-2" id="nombre" name="nombre" placeholder="Nombre">
                        <input type="text" class="form-control mb-2" id="telefono" name="telefono" placeholder="Teléfono">

                        <select name="area" id="area" class="form-control mb-2" >
                            <option value="" selected>Tipo de reporte</option>
                        </select>
                        <textarea placeholder="Mensaje" class="form-control mb-2 " name="" id="" cols="30" rows="3"></textarea>
                        <button type="submit" class="btn btn-sm btn-block btn-info ">Enviar</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="z-depth-3 p-3 bg-light rounded ">
                    <div class="mapa">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1221.2346017244167!2d-89.26595737311105!3d13.646909720896758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f632e12abcc8147%3A0xa316fc34131ef94!2sJPWM%2BQQ8%2C%20Nuevo%20Cuscatlan!5e0!3m2!1ses-419!2ssv!4v1679542970225!5m2!1ses-419!2ssv"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        
                    </div>
                    
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script>
        $('.carousel').carousel()

        $( document ).ready(function() {
            new WOW().init();
        });
    </script>
@endsection