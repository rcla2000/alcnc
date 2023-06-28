<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Nuevo Cuscatlán, La Nueva ciudad">
    <meta name="keywords" content="Alcaldía, Nuevo Cuscatlán, Nuevas ideas">
    <meta name="author" content="Luis H. Medrano">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo68.png') }}" type="image/png" style="width: 50%;">
    @yield('token')
    <title>Alcaldía Nuevo Cuscatlán- @yield('title')</title>
    @include('layouts.layouts-dash.style')
</head>

<body class="fixed-sn cyan-skin">
    @include('layouts.layouts-dash.sidenav')

    <!--Main Layout-->
    <main>
        @yield('content')
    </main>
    <!--Main Layout-->

    <!-- Variables de JS -->
    @include('footer')
    @include('layouts.layouts-dash.script')
    @yield('modal')
</body>

</html>
