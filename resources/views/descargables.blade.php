@extends('layouts.master.master-layout')

@section('title', 'Documentos descargables')

@section('container')
    <section class="container-fluid mt-menu animate__animated animate__fadeInDown">
        <div class="row wow justify-content-center title-section2">
            <h2 class="text-center text-white">
                <i class="fa-regular fa-folder-open mr-2"></i>
                Documentos descargables
            </h2>
        </div>
        <ul class="nav nav-tabs nav-justified md-tabs indigo" id="myTabJust" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#catastro" role="tab"
                    aria-controls="catastro" aria-selected="true">Catastro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#planificacion" role="tab"
                    aria-controls="planificacion" aria-selected="false">Planificación</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab-just" data-toggle="tab" href="#unidad-ambiental" role="tab"
                    aria-controls="unidad-ambiental" aria-selected="false">Unidad ambiental</a>
            </li>
        </ul>

        <div class="tab-content card pt-5" id="myTabContentJust">
            <div class="tab-pane fade show active" id="catastro" role="tabpanel" aria-labelledby="home-tab-just">
                <a class="btn btn-block btn-primary mb-2" href="{{ asset('docs/catastro/LA ORDENANZA REGULADORA DE TASAS Y CONTRIBUCIONES ESPECIALES MUNICIPALES DE NUEVO CUSCATLÁN.PDF') }}" download="">
                  ORDENANZA REGULADORA DE TASAS Y CONTRIBUCIONES ESPECIALES MUNICIPALES DE NUEVO CUSCATLÁN
                </a>
                <a class="btn btn-block btn-primary mb-2" href="{{ asset('docs/catastro/LEY ESPECIAL TRANSITORIA QUE OTORGA FACILIDADES PARA EL CUMPLIMIENTO.pdf') }}" download="">
                    Ley especial transitoria que otorga facilidades para el cumplimiento
                </a>
                <a class="btn btn-block btn-primary mb-2" href="{{ asset('docs/catastro/Ley General Tributaria Municipal.PDF') }}" download="">
                    Ley General Tributaria Municipal
                </a>
                <a class="btn btn-block btn-primary mb-2" href="{{ asset('docs/catastro/ORDENANZA%20REGULADORA%20DEL%20PAGO%20DE%20TASAS%20E%20IMPUESTOS%20MUNICIPALES%20EN%20ESPECIE%20O%20EN%20SERVICIOS%20A%20FAVOR%20DEL%20MUNICIPIO%20DE%20NUEVO%20CUSCATL%C3%81N,%20DEPARTAMENTO%20DE%20LA%20LIBERTAD.PDF') }}" download="">
                  ORDENANZA REGULADORA DEL PAGO DE TASAS E IMPUESTOS MUNICIPALES EN ESPECIE O EN SERVICIOS A FAVOR DEL MUNICIPIO DE NUEVO CUSCATLÁN, DEPARTAMENTO DE LA LIBERTAD
                </a>
                <a class="btn btn-block btn-primary mb-2" href="{{ asset('docs/catastro/ORDENANZA%20TRANSITORIA%20DE%20AMNISTIA%20TRIBUTARIA%20PARA%20LA%20EXNOERACI%C3%93N%20DE%20MULTAS%20E%20INTERESES%20PRODUCTO%20DE%20TASAS%20Y%20CONTRIBUCIONES%20ESPECIALES.PDF') }}" download="">
                    Ordenanza transitoria de amnistía tributaria para la exoneración de multas e intereses producto de
                    tasas y contribuciones especiales
                </a>
            </div>
            <div class="tab-pane fade" id="planificacion" role="tabpanel" aria-labelledby="profile-tab-just">
                <a class="btn btn-block btn-info mb-2" href="{{ asset('docs/planificacion/DECRETA%20LA%20SIGUIENTE%20REFORMA%20A%20LA%20ORDENANZA%20DE%20COBRO%20POR%20SERVICIOS%20PARA%20EL%20DESARROLLO%20TERRITORIAL%20EN%20EL%20MUNICIPIO%20DE%20NUEVO%20CUSCATLAN,%20DEPARTAMENTO%20DE%20LA%20LIBERTAD.PDF') }}" download="">
                    Reforma a la ordenanza de cobro por servicios para el desarrollo territorial en
                    el municipio de Nuevo Cuscatlán, departamento de la libertad
                </a>
                <a class="btn btn-block btn-info mb-2" href="{{ asset('docs/planificacion/LEY%20Y%20REGLAMENTO%20DE%20URBANISMO%20Y%20CONSTRUCCI%C3%93N.pdf') }}" download="">
                    Ley y reglamento de urbanismo y construcción
                </a>
                <a class="btn btn-block btn-info mb-2" href="{{ asset('docs/planificacion/ORDENANZA%20DE%20DECLARATORIA%20DE%20ZONA%20DE%20DESARROLLO,%20ZONA%20SUR,%20DEL%20MUNICIPIO%20DE%20NUEVO%20CUSCATLAN.PDF') }}" download="">
                    Ordenanza de declaratoria de zona de desarrollo, zona sur, del municipio de nuevo cuscatlan
                </a>
            </div>
            <div class="tab-pane fade" id="unidad-ambiental" role="tabpanel" aria-labelledby="contact-tab-just">
                <a class="btn btn-block btn-success mb-2" href="{{ asset('docs/unidad-ambiental/ORDENANZA PARA LA PROTECCION ARBOREA Y EL DESARROLLO DE NUEVO CUSCATLAN EN ARMONIA CON EL MEDIO AMBIENTE.PDF') }}" download="">
                    Ordenanza para la protección arbórea y el desarrollo de Nuevo Cuscatlán en armonía con el medio
                    ambiente
                </a>
                <a class="btn btn-block btn-success mb-2" href="{{ asset('docs/unidad-ambiental/REFORMA%20DE%20LA%20ORDENANZA%20PARA%20LA%20PROTECCI%C3%93N%20DEL%20PATRIMONIO%20ARB%C3%93REO%20DEL%20MUNICIPIO%20DE%20NUEVO%20CUSCATL%C3%81N.PDF') }}" download="">
                    Reforma de la ordenanza para la protección del patrimonio arbóreo del municipio de nuevo Cuscatlán
                </a>
            </div>
        </div>
        <div class="espacio"></div>
    </section>
@endsection

@section('scripts')
@endsection
