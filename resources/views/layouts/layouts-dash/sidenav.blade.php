
  <form action="{{ route('logout')  }}" method="post" id="close" name="close">
    @csrf
  </form>
    <!--Double navigation-->
    <header >
      <!-- Sidebar navigation -->
      <div id="slide-out" class="side-nav sn-bg-3 fixed" >
        <ul class="custom-scrollbar" >
   
          <li>
            <ul class="collapsible collapsible-accordion" >
              <li>
                <a class="waves-effect {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{ route('dashboard') }}" ><i class="fas fa-chart-pie" ></i>Resumen General</a>
              </li>
              <li>
                <a class=" waves-effect {{ (request()->is('gestiones')) ? 'active' : '' }}" href="{{ route('gestiones') }}"><i class="fas fa-cubes"></i>Administrar Gestiones</a>
              </li>
              <li>
                <a class=" waves-effect"><i class="fas fa-tasks"></i>Generar Solicitudes</a>
              </li>
              <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-file-pdf"></i>
                  Informes y reportes<i class="fas fa-angle-down rotate-icon"></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="#" class="waves-effect">For bloggers</a>
                    </li>
                    <li><a href="#" class="waves-effect">For authors</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-eye"></i> Gestión de usuarios<i class="fas fa-angle-down rotate-icon"></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="#" class="waves-effect">Empleados</a>
                    </li>
                    <li><a href="#" class="waves-effect">Contribuyentes</a>
                    </li>
                    <li><a href="#" class="waves-effect">Menores de edad</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li><a class=" waves-effect"><i class="far fa-envelope"></i>Tickets IT</a>
                
              </li>
            </ul>
          </li>
          <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg mask-strong"></div>
      </div>
      <!--/. Sidebar navigation -->
      <!-- Navbar -->
      <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav">
        <!-- SideNav slide-out button -->
        <div class="float-left">
          <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Breadcrumb-->
        <div class="breadcrumb-dn mr-auto">
          <p>Sistema de Administración de Gestiones Nuevo Cuscatlán</p>
        </div>
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i> <span class="clearfix d-none d-sm-inline-block">Inicio</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link"><i class="fas fa-bell"></i> <span class="clearfix d-none d-sm-inline-block">Notificaciones</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link"><i class="fa fa-comments-o"></i> <span class="clearfix d-none d-sm-inline-block">Soporte</span></a>
          </li>
     
          <li class="nav-item dropdown">
          
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i> Mi perfil
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Ver información</a>
           
              <a href="#" onclick="event.preventDefault();document.getElementById('close').submit()">Cerrar sesión</a>
             
              
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.Navbar -->
    </header>
    <!--/.Double navigation-->
  
    <!--Main Layout-->
    <main >
      @yield('content')
    </main>
    <!--Main Layout-->
  
