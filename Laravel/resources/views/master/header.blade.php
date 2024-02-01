<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="row w-100">
        <div class="col-4 d-flex align-content-center">
            <div>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link mb-2 btn btn-light" onclick="toggleSidebar()">
                        <img src="https://cdn.icon-icons.com/icons2/2518/PNG/512/menu_icon_151204.png" alt="Menu"
                             style="width: 25px; height: 25px;">
                    </a>
                </li>
            </ul>
            </div>
            <div class="mt-2">
            <h5 class="ml-2">Bem vindo, {{ Auth::user()->name }}!</h5>
            </div>
        </div>
        <div class="col-4 ">
            @if(Request::path() == 'external')
                <h3 class="text-center">Gestão de formações</h3>
            @elseif(Request::path() == 'courses')
                <h3 class="text-center">Gestão de cursos</h3>
            @elseif(Request::path() == 'tickets')
                <h3 class="text-center">Gestão de tickets</h3>
            @elseif(Request::path() == 'users')
                <h3 class="text-center">Gestão de utilizadores</h3>
            @elseif(Request::path() == 'course-classes')
                <h3 class="text-center">Gestão de turmas</h3>
            @elseif(Request::path() == 'materials')
                <h3 class="text-center">Gestão de materiais</h3>
            @elseif(Request::path() == 'material-user')
                <h3 class="text-center">Gestão de fardas</h3>
            @elseif(Request::path() == 'dashboard')
                <h3 class="text-center">Dashboard</h3>

            @endif
        </div>
        <div class="col-4">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">

                        <a class="nav-link" href="#" id="notificacoesDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="https://static.vecteezy.com/system/resources/previews/010/366/202/original/bell-icon-transparent-notification-free-png.png"
                                 alt="Sininho" style="width: 30px; height: 30px; margin-right: 5px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificacoesDropdown" style="width: 250px;">

                            @livewire('notification-component')
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="rounded-circle bg-primary text-white" style="width: 30px; height: 30px; font-size: 15px; margin-right: 5px; display: inline-block; text-align: center; line-height: 30px;">
                    <strong>{{ Auth::user()->initials }}</strong>
                </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('tecnico'))
                                <a class="dropdown-item" href="{{ route('users.edit', ['user' => Auth::user()]) }}">Perfil</a>
                            @endif
                            <a class="dropdown-item" href="#"
                               onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();">Sair</a>
                        </div>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf

            </form>
        </div>
    </div>




</nav>
<script>
    window.livewire.on('redirectToTicket', ticketId => {
        window.location.href = '/tickets/' + ticketId;
    });
</script>
