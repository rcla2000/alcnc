<nav class="navbar navbar-expand-lg navbar-dark  mdb-color darken-2     fixed-top scrolling-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.svg') }}" class="logoSvg" alt="La-Nueva-Ciudad" title="Alcaldía Nuevo Cuscatlán">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
            aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">INICIO <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">LA NUEVA CIUDAD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SERVICIOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">TRANSPARENCIA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CONTÁCTANOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-hand-holding-usd"></i>PAGO EN LÍNEA</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-none" id="frm-logout">
                            @csrf
                        </form>
                        <button type="submit" class="btn btn-info btn-sm btn-rounded" href="#" form="frm-logout">
                            Cerrar sesión
                        </button>
                    </li>
                @endif
            </ul>
            {{-- <form class="form-inline">
              <div class="md-form my-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
              </div>
            </form> --}}
        </div>
    </div>
</nav>
