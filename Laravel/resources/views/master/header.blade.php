<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link mb-2 btn btn-light" onclick="toggleSidebar()">
                <img src="https://cdn.icon-icons.com/icons2/2518/PNG/512/menu_icon_151204.png" alt="Menu"
                    style="width: 25px; height: 25px;">
            </a>
        </li>
    </ul>
    <h5 class="ml-2">Bem vindo, {{ Auth::user()->name }}!</h5>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="notificacoesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="https://static.vecteezy.com/system/resources/previews/010/366/202/original/bell-icon-transparent-notification-free-png.png"
                        alt="Sininho" style="width: 30px; height: 30px; margin-right: 5px;">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificacoesDropdown">
                    <a class="dropdown-item" href="#">Notificação 1</a>
                    <a class="dropdown-item" href="#">Notificação 2</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="https://pbs.twimg.com/profile_images/1087303987307728898/yyr4CwNs_400x400.jpg"
                        alt="Imagem Dropdown" class="rounded-circle"
                        style="width: 30px; height: 30px; margin-right: 5px;">
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
</nav>
