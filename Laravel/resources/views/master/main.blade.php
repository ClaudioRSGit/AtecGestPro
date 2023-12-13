<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Project</title>
    {{-- STYLE SECTION --}}
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" media="all" type="text/css" />
    @yield('styles')
    {{-- .STYLE SECTION --}}
</head>
<body>
{{-- Header --}}
@component('master.header')
@endcomponent
{{-- .Header --}}

{{-- Main --}}
<main>
    @yield('content')

    <div class="title m-b-md">
        Laravel
    </div>

    <div class="links">
        <a href="https://laravel.com/docs">Docs</a>
        <a href="https://laracasts.com">Laracasts</a>
        <a href="https://laravel-news.com">News</a>
        <a href="https://blog.laravel.com">Blog</a>
        <a href="https://nova.laravel.com">Nova</a>
        <a href="https://forge.laravel.com">Forge</a>
        <a href="https://vapor.laravel.com">Vapor</a>
        <a href="https://github.com/laravel/laravel">GitHub</a>
    </div>

</main>
{{-- .Main --}}

{{-- Footer --}}
@component('master.footer')
@endcomponent
{{-- .Footer --}}

{{-- SCRIPTS SECTION --}}
<script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>
@yield('scripts')
{{-- .SCRIPTS SECTION --}}
</body>
</html>
