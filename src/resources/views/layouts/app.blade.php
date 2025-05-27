<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=1512'>
    <title>@yield('title')</title>
    <link rel='stylesheet' href="{{ asset('css/sanitize.css') }}">
    <link rel='stylesheet' href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body class='layout'>
    <header class="@yield('header_class', 'site-header')">
        <h1 class='site-header__logo'>FashionablyLate</h1>
        <div class='site-header__actions'>
            @yield('header_actions')
        </div>
    </header>
    <main class="@yield('main_class', 'layout__main')">
        @yield('content')
    </main>
</body>
</html>
