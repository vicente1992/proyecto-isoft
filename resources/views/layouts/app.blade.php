<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layout.style')
</head>

<body>
    @include('layout.header')

    @include('layout.sidebar')
    <main id="main" class="main">
        @yield('content')
    </main>

    @include('layout.script')
</body>

</html>
