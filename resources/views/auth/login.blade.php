<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Nuevo Cuscatlán, La Nueva ciudad">
    <meta name="keywords" content="Alcaldía, Nuevo Cuscatlán, Nuevas ideas">
    <meta name="author" content="Luis H. Medrano">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo68.png') }}" type="image/png" style="width: 50%;">
    <title>Alcaldía Nuevo Cuscatlán | Login</title>
    @include('layouts.master.style')
</head>

<body>
    <div class="contenedor-vista-login">
        <!-- Material form login -->
        <div class="contenedor-login">
            <div class="card">
                <div class="card-header white-text text-center py-1 d-flex justify-content-between align-items-center">
                    <strong class="ml-3 titulo-login">Iniciar sesión</strong>
                    <img src="{{ asset('img/logo.svg') }}" class="logoSvg" alt="La-Nueva-Ciudad">
                </div>
                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">
                    <!-- Form -->
                    <form method="POST" class="text-center" style="color: #757575;" action="{{ route('login') }}">
                        @csrf
                        <!-- Email -->
                        <div class="md-form">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email') }}" autofocus>
                            <label for="email">Correo electrónico: </label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="md-form">
                            <input type="password" id="password" name="password" class="form-control">
                            <label for="password">Contraseña: </label>
                        </div>

                        <!-- Sign in button -->
                        <button class="btn btn-primary btn-block"
                            type="submit">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Acceder
                        </button>
                    </form>
                    <!-- Form -->
                </div>
            </div>
        </div>
        <!-- Material form login -->
    </div>
    @include('layouts.master.script')
</body>

</html>
