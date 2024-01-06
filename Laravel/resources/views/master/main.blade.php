<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AtecGest Pro</title>
    {{-- STYLE SECTION --}}
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" media="all" type="text/css" />
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/91/Gear-icon-blue-white-background.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    @yield('styles')
    {{-- .STYLE SECTION --}}
</head>
<body>

    {{-- Main --}}
<main>
    @component('master.header')
    @endcomponent


    @component('master.sidebar')
    @endcomponent


    <div class="content">
        @yield('content')
    </div>

    <div class="push">

    </div>

    @component('master.footer')
    @endcomponent
</main>
{{-- .Main --}}



{{-- SCRIPTS SECTION --}}
<script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>

@yield('scripts')
{{-- .SCRIPTS SECTION --}}

</body>
</html>
