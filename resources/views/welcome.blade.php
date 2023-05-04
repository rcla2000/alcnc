@extends('layouts.master.master-layout')

@section('container')
    <section class="container section1">
        {{-- SERVICIOS EN LINEA --}}
            <div class="row  wow fadeInUp justify-content-start" style="margin-top:130px">
                <div class="col-md-6 text-center mb-4">
                    <h2 class="title-section">Servicios Municipales en línea</h2>   
                </div>
            </div>

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
    {{--PROXIMOS EVENTOS --}}
    <section class="container-fluid cyan-bg mb-5 mt-5">
        <br>
        <br>
        {{-- <div class="row mt-5 wow fadeInUp justify-content-end">
            <div class="col-md-6 text-center mb-4 mt-3">
                <h2 class="title-section-dark">Eventos Municipales próximos</h2>   
            </div>
        </div>
         <!--Grid row-->
         <div class="row text-white">

            <!--Grid column-->
            <div class="col-lg-4 mb-4">
              <!--Featured image-->
              <div class="view overlay z-depth-1">
                <img src="{{ asset('img/fiestas.png') }}" class="img-fluid rounded-left" alt="Fistas patronales" width="400"  >
                <a>
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
            </div>
            <!--Grid column-->
  
            <!--Grid column-->
            <div class="col-lg-7 mb-4">
              <!--Excerpt-->
              {{-- <a href="" class="teal-text">
                <h6 class="pb-1"><i class="fas fa-heart"></i><strong> Lifestyle </strong></h6>
              </a> --
              <h4 class="mb-4"><strong>Fiestas Patronales Nuevo Cuscatlán</strong></h4>
              <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime
                placeat facere possimus, omnis voluptas assumenda est, omnis dolor.</p>
              <p>by <a><strong>Jessica Clark</strong></a>, 26/08/2016</p>
              <a class="btn btn-primary">Leer más</a>
            </div>
            <!--Grid column-->
  
          </div>
          <!--Grid row-->
  
          <hr class="mb-5"> --}}

    </section>
    <section class="container">
        <div class="row">
            <div class="col-md-6 text-center mb-2">
                
                <div class="z-depth-3 p-3">
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
            <div class="col-md-6">
                <div class="z-depth-3 p-3 ">
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