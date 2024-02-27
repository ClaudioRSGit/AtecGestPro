<div class="sidebarContent">
    <a href="/" style="text-decoration: none; color: black">
        <div class="logo pl-1">
            <img src="{{ asset('assets/logo.png') }}" alt="logo" style="max-width: 50px !important; max-height: 50px !important;">
            <h5 class="toggleableElement ml-3"><strong> ATEC GEST PRO </strong></h5>
            <a class="closeSidebar" onclick="closeSidebar()">
                <img src="https://cdn.icon-icons.com/icons2/2518/PNG/512/menu_icon_151204.png" alt="Menu"
                style="width: 25px; height: 25px;">
            </a>
        </div>
    </a>
    <div class="links">
        <div class="link tickets {{ Request::routeIs('tickets.*') ? 'selected' : '' }}" onclick="toggleSidebarMobile(); location.href='{{ route('tickets.index') }}'">
            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                <path fill="#116fdc"
                    d="M64 64C28.7 64 0 92.7 0 128v64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320v64c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V320c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6V128c0-35.3-28.7-64-64-64H64zm64 112l0 160c0 8.8 7.2 16 16 16H432c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H144c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32H448c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V160z" />
            </svg>
            <p class="toggleableElement ml-3">Tickets</p>
        </div>
        @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('tecnico'))
            <div class="link dashboard {{ Request::routeIs('dashboard.*') ? 'selected' : '' }}"
                onclick="toggleSidebarMobile(); location.href='{{ route('dashboard.index') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path fill="#116fdc"
                        d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm406.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L320 210.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L240 221.3l57.4 57.4c12.5 12.5 32.8 12.5 45.3 0l128-128z" />
                </svg>
                <p class="toggleableElement ml-3">Dashboard</p>
            </div>

            <div class="link users {{ Request::routeIs('users.*') ? 'selected' : '' }}"
                onclick="toggleSidebarMobile(); location.href='{{ route('users.index') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                    <path fill="#116fdc"
                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg>
                <p class="toggleableElement ml-3">Utilizadores</p>
            </div>

            <div class="link material {{ Request::routeIs('materials.*') ? 'selected' : '' }}"
                onclick="toggleSidebarMobile(); location.href='{{ route('materials.index') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512">
                    <path fill="#116fdc"
                        d="M58.9 42.1c3-6.1 9.6-9.6 16.3-8.7L320 64 564.8 33.4c6.7-.8 13.3 2.7 16.3 8.7l41.7 83.4c9 17.9-.6 39.6-19.8 45.1L439.6 217.3c-13.9 4-28.8-1.9-36.2-14.3L320 64 236.6 203c-7.4 12.4-22.3 18.3-36.2 14.3L37.1 170.6c-19.3-5.5-28.8-27.2-19.8-45.1L58.9 42.1zM321.1 128l54.9 91.4c14.9 24.8 44.6 36.6 72.5 28.6L576 211.6v167c0 22-15 41.2-36.4 46.6l-204.1 51c-10.2 2.6-20.9 2.6-31 0l-204.1-51C79 419.7 64 400.5 64 378.5v-167L191.6 248c27.8 8 57.6-3.8 72.5-28.6L318.9 128h2.2z" />
                </svg>
                <p class="toggleableElement ml-3">Material</p>
            </div>

            <div class="link trainings {{ Request::routeIs('external.*') ? 'selected' : '' }} {{ Request::routeIs('partners.*') ? 'selected' : '' }} {{ Request::routeIs('trainings.*') ? 'selected' : '' }}"
                onclick="toggleSidebarMobile(); location.href='{{ route('external.index') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512">
                    <path fill="#116fdc"
                        d="M320 32c-8.1 0-16.1 1.4-23.7 4.1L15.8 137.4C6.3 140.9 0 149.9 0 160s6.3 19.1 15.8 22.6l57.9 20.9C57.3 229.3 48 259.8 48 291.9v28.1c0 28.4-10.8 57.7-22.3 80.8c-6.5 13-13.9 25.8-22.5 37.6C0 442.7-.9 448.3 .9 453.4s6 8.9 11.2 10.2l64 16c4.2 1.1 8.7 .3 12.4-2s6.3-6.1 7.1-10.4c8.6-42.8 4.3-81.2-2.1-108.7C90.3 344.3 86 329.8 80 316.5V291.9c0-30.2 10.2-58.7 27.9-81.5c12.9-15.5 29.6-28 49.2-35.7l157-61.7c8.2-3.2 17.5 .8 20.7 9s-.8 17.5-9 20.7l-157 61.7c-12.4 4.9-23.3 12.4-32.2 21.6l159.6 57.6c7.6 2.7 15.6 4.1 23.7 4.1s16.1-1.4 23.7-4.1L624.2 182.6c9.5-3.4 15.8-12.5 15.8-22.6s-6.3-19.1-15.8-22.6L343.7 36.1C336.1 33.4 328.1 32 320 32zM128 408c0 35.3 86 72 192 72s192-36.7 192-72L496.7 262.6 354.5 314c-11.1 4-22.8 6-34.5 6s-23.5-2-34.5-6L143.3 262.6 128 408z" />
                </svg>
                <p class="toggleableElement ml-3">Formações</p>
            </div>

            <div class="link classes {{ Request::routeIs('course-classes.*') ? 'selected' : '' }}"
                onclick="toggleSidebarMobile(); location.href='{{ route('course-classes.index') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512">
                    <path fill="#116fdc"
                        d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
                </svg>
                <p class="toggleableElement ml-3">Turmas</p>
            </div>

            <div class="link clothing {{ Request::routeIs('material-user.*') ? 'selected' : '' }}" onclick="toggleSidebarMobile(); location.href='{{ route('material-user.index') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512">
                    <path fill="#116fdc"
                        d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z" />
                </svg>
                <p class="toggleableElement ml-3">Vestuário</p>
            </div>

            <div class="link courses {{ Request::routeIs('courses.*') ? 'selected' : '' }}"
                onclick="toggleSidebarMobile(); location.href='{{ route('courses.index') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                    <path fill="#116fdc"
                        d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                </svg>
                <p class="toggleableElement ml-3">Cursos</p>
            </div>
    @endif

</div>

</div>

<style>
    @media (min-width: 476px){
        .sidebarContent{
            width: 13%;
        }
        .collapsedSidebar {
            width: 5% !important;
            text-align: center;
        }
        .closeSidebar{
            display: none !important;
            width: 0 !important;
        }
    }
    .sidebarContent {
        position: fixed;
        left: 0;
        height: 100%;
        z-index: 1000;
        background-color: #fff;
        border-right: 1px solid #e5e5e5;
        overflow: hidden;
        container: sidebar / inline-size;
    }

    .logo {
        display: flex;
        justify-content: space-evenly;
        padding: 1rem 0;
    }

    .logo>img {
        width: 50px;
        aspect-ratio: 1;
    }

    .logo>* {
        display: flex;
        align-items: center;
    }


    .links {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 1rem 0;
        line-height: 2rem;
    }

    .links>div>svg {
        width: 20%;
    }

    .links>div>a,
    .links>div>p {
        width: 70%;
    }

    .links>div {
        display: flex;
        align-items: center;
        width: 100%;
        height: 2rem;
        justify-content: space-evenly;
    }

    .links a,
    .links p {
        color: black;
    }

    p {
        margin: 0;
    }

    .link:hover {
        background-color: rgba(17, 111, 220, 0.1);
        cursor: pointer;
    }

    .link a:hover,
    .link p:hover {
        text-decoration: underline;
    }

    .selected {
        background-color: rgba(17, 111, 220, 0.1);
    }

    .selected>p {
        font-weight: bold;
        color: #116fdc;
    }
    .sidebarContent h5{
        opacity: 1;
        transition: opacity .5s .2s;
    }

    @container sidebar (max-width: 145px){
        .sidebarContent h5, .sidebarContent p{
            opacity: 0 !important;
            width: 0 !important;
        }
    }
</style>

<script>
    function closeSidebar(){
        const sidebar = document.querySelector('.sidebarContent');

        let collapseElements = document.querySelectorAll('.toggleableElement');

        collapseElements.forEach(element => {
            element.classList.toggle('hideElements');
        });

        if (collapseElements[0].classList.contains('hideElements')) {
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

    function toggleSidebarMobile(){
        const sidebar = document.querySelector('.sidebarContent');
        sidebar.classList.remove('collapsedSidebar');
        localStorage.setItem('sidebarState', 'expanded');
    }
</script>
