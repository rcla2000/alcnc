
    <nav class="navbar navbar-expand-lg navbar-dark  mdb-color darken-2     fixed-top scrolling-navbar">
        <div class="container">
          <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.svg') }}" class="logoSvg"  alt="La-Nueva-Ciudad" >
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
            aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link" href="#">La nueva ciudad</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Servicios</a>
              </li>
      
              <li class="nav-item">
                <a class="nav-link" href="#">Contáctanos</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-hand-holding-usd"></i>Pago en línea</a>
              </li> --}}
              <!-- Dropdown -->
      


              <li class="nav-item">
                @if (auth()->user())
                  <form action="{{ route('logout')  }}" method="post" id="close" name="close">
                    @csrf
                  </form>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> Mi Cuenta</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                      <a href="#" class="dropdown-item"><i class="fas fa-th-list"></i> Mis solicitudes</a>
                      @if (auth()->user()->rol == 5)
                      <a href="{{route('dashboard')  }}" class="dropdown-item"><i class="fas fa-cubes"></i> Administración</a>
                      @endif
                      <a href="#" class="dropdown-item" onclick="event.preventDefault();document.getElementById('close').submit()"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>

                    </div>
                  </li>
               
                @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i> Mi Cuenta</a>
                  </li>
                @endif
              </li>
            
            </ul>
      {{-- <form class="form-inline">
              <div class="md-form my-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
              </div>
            </form> --}}
          </div>
        </div>
    </nav>

