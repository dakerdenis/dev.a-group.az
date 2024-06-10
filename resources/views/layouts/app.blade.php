<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/fav/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/fav/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/fav/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <x-site.page-title-breadcrumbs/>
</head>
<!--------->
<body>
    <x-site.partials.header/>
    <main class="{{ $class }}">
    @if(!Route::is('index'))
        @include('site.partials.breadcrumbs')
    @endif

        {{$slot}}
    </main>
    <x-site.partials.footer/>

    <script src="{{ asset('assets/js/script.min.js') }}"></script>
    @stack('extraScripts')
    {{$scripts ?? null}}

</body>
</html>
