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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let sidebarWidth = document.querySelector('.sidebarContent').offsetWidth;
        const container = document.querySelector('.container');
        container.style.width = `calc(100% - ${sidebarWidth}px)`;
    });

    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebarContent');
        const navbar = document.querySelector('.navbar');
        const content = document.querySelector('.content');

        let collapseElements = document.querySelectorAll('.toggleableElement');

        collapseElements.forEach(element => {
            element.classList.toggle('hideElements');
        });

        if(collapseElements[0].classList.contains('hideElements')) {
            sidebar.classList.add('collapsedSidebar');
            navbar.classList.add('expandElements');
            content.classList.add('expandElements');
            localStorage.setItem('sidebarState', 'collapsed');
        } else {
            sidebar.classList.remove('collapsedSidebar');
            navbar.classList.remove('expandElements');
            content.classList.remove('expandElements');
            localStorage.setItem('sidebarState', 'expanded');
        };

    }

    document.addEventListener('DOMContentLoaded', (event) => {
        const sidebarState = localStorage.getItem('sidebarState');
        const sidebar = document.querySelector('.sidebarContent');
        const navbar = document.querySelector('.navbar');
        const content = document.querySelector('.content');
        let collapseElements = document.querySelectorAll('.toggleableElement');

        if (sidebarState === 'collapsed') {
            collapseElements.forEach(element => {
                element.classList.add('hideElements');
            });
            sidebar.classList.add('collapsedSidebar');
            navbar.classList.add('expandElements');
            content.classList.add('expandElements');
        } else {
            collapseElements.forEach(element => {
                element.classList.remove('hideElements');
            });
            sidebar.classList.remove('collapsedSidebar');
            navbar.classList.remove('expandElements');
            content.classList.remove('expandElements');
        }
    });
</script>
    @livewireScripts
</body>
</html>
