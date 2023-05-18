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

    <title>Alcaldía Nuevo Cuscatlán- @yield('title')</title>
    @yield('token')
    @include('layouts.layouts-forms.style')
</head>
<body>
    <header>
        @include('layouts.master.navbar')
    </header>
    @yield('content')
    @include('layouts.layouts-forms.script')
</body>
</html>