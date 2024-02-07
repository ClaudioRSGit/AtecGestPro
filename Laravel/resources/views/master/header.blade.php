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

                        <div class="dropdown-menu dropdown-menu-right notification-area" aria-labelledby="notificacoesDropdown">
                @livewire('notification-component')
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="rounded-circle bg-primary text-white" style="width: 30px; height: 30px; font-size: 13px; margin-right: 5px; display: inline-block; text-align: center; line-height: 30px;">
                    <strong>{{ Auth::user()->initials }}</strong>
                </span>
            </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('users.edit', ['user' => Auth::user()]) }}">Perfil</a>
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
@livewireScripts
<script>
    window.livewire.on('redirectToTicket', ticketId => {
        window.location.href = '/tickets/' + ticketId;
    });
</script>
