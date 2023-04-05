<!--Carousel Wrapper-->
<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-2" data-slide-to="1"></li>
      <li data-target="#carousel-example-2" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <div class="view">
          <img class="d-block w-100 slideAlc slideweb" src="{{ asset('img/slide/slide1.png') }}"
            alt="First slide">
            <img class="d-block w-100 slideAlc slidemovil"  src="{{ asset('img/slide/slides-movil/slide1.png') }}"
            alt="First slide">
          {{-- <div class="mask rgba-black-light"></div> --}}
        </div>
        {{-- <div class="carousel-caption">
          <h3 class="h3-responsive">Light mask</h3>
          <p>First text</p>
        </div> --}}
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img class="d-block w-100 slideAlc slideweb" src="{{ asset('img/slide/slide2.png') }}"
            alt="Second slide">
            <img class="d-block w-100 slideAlc slidemovil"  src="{{ asset('img/slide/slides-movil/slide2.png') }}"
            alt="First slide">
          {{-- <div class="mask rgba-black-strong"></div> --}}
        </div>
        {{-- <div class="carousel-caption">
          <h3 class="h3-responsive">Strong mask</h3>
          <p>Secondary text</p>
        </div> --}}
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img class="d-block w-100 slideAlc slideweb" src="{{ asset('img/slide/slide3.png') }}"
            alt="Third slide">
            <img class="d-block w-100 slideAlc slidemovil"  src="{{ asset('img/slide/slides-movil/slide3.png') }}"
            alt="First slide">
          {{-- <div class="mask rgba-black-slight"></div> --}}
        </div>
        {{-- <div class="carousel-caption">
          <h3 class="h3-responsive">Slight mask</h3>
          <p>Third text</p>
        </div> --}}
      </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
        <i class="fas fa-angle-left"></i>
              <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next"   href="#carousel-example-2" role="button" data-slide="next">
        <i class="fas fa-angle-right"></i>      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
  </div>
  <!--/.Carousel Wrapper-->