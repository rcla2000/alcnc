<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar animate__animated animate__fadeIn">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.svg') }}" class="logoSvg" alt="La-Nueva-Ciudad">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
            aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-home"></i>
                    Inicio <span class="sr-only">(current)</span>
                  </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                      <i class="fas fa-city"></i>
                      La nueva ciudad
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownservicios" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        Servicios
                    </a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownservicios">
                      @foreach ($servicios as $servicio)
                        <a 
                          href="{{ route($servicio->ruta, 
                            ['idarea' => $servicio->id_area, 'idsol' => $servicio->id_servicio]) 
                            }}" 
                          class="dropdown-item"
                        >
                          <i class="{{ $servicio->icono }}"></i> 
                          {{ $servicio->des_servicio }}
                        </a>    
                      @endforeach
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#contactanos">
                      <i class="fa-solid fa-envelope"></i>
                      Contáctanos
                    </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('documentos') }}">
                    <i class="fa-regular fa-folder-open"></i>
                    Documentos
                  </a>
              </li>
                <li class="nav-item">
                    @if (auth()->user())
                        <form action="{{ route('logout') }}" method="post" id="close" name="close">
                            @csrf
                        </form>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                                Mi Cuenta
                              </a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ route('contribuyente.solicitudes') }}" class="dropdown-item">
                                  <i class="fas fa-th-list mr-1"></i> 
                                  Mis solicitudes
                                </a>
                                @if (auth()->user()->rol == 5)
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">
                                      <i class="fas fa-cubes mr-1"></i>
                                        Administración
                                    </a>
                                @endif
                                <a href="#" class="dropdown-item"
                                    onclick="event.preventDefault();document.getElementById('close').submit()">
                                    <i class="fas fa-sign-out-alt mr-1"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>
                    @else
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i> Mi Cuenta</a>
                      </li>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
