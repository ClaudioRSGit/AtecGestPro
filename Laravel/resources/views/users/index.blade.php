@extends('master.main')

@section('content')
    <div class="container  w-100 fade-in">

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function () {
                    $('#success-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function () {
                    $('#error-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Utilizadores</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-pen mr-1" style="color: #ffffff;"></i>
                Novo Utilizador
            </a>
        </div>

        <ul class="nav nav-tabs mb-3" id="userTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#allTable">Todos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#recycleTable">Reciclagem</a>
            </li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane fade show active" id="allTable">
                <div class="d-flex justify-content-between mb-3">

                    <form action="{{ route('users.index') }}" method="GET">
                        <div class="input-group pr-2">
                            <div class="search-container">
                                <input type="text" name="searchName" class="form-control"
                                       placeholder="{{ request('searchName') ? request('searchName') : 'Procurar...' }}">
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary">
                                    Procurar
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="buttons">
                        <button class="btn btn-danger modalBtn" id="delete-selected" data-message="Tem a certeza que pretende enviar os utilizadores selecionados para a reciclagem?" data-no-selection-message="Selecione pelo menos um utilizador para excluir.">Excluir Selecionados</button>
                        <form action="{{ route('users.index') }}" method="GET" id="roleFilterForm">
                            <div>
                                <select class="form-control" id="roleFilter" name="roleFilter" onchange="submitForm()">
                                    <option value="" {{ request('roleFilter') === '' ? 'selected' : '' }}>Todas as
                                        Funções
                                    </option>
                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->id }}" {{ request('roleFilter') == $role->id ? 'selected' : '' }}>{{ $role->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table" id="userTable">
                    <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>
                            <a href="{{ route('users.index', ['sortColumn' => 'name', 'sortDirection' => $sortColumn === 'name' ?
                ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">
                                Nome
                                @if ($sortDirection === 'desc' && $sortColumn === 'name')
                                <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                @else
                                <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('users.index', ['sortColumn' => 'username', 'sortDirection' => $sortColumn === 'username' ?
                ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">
                                Username
                                @if ($sortDirection === 'desc' && $sortColumn === 'username')
                                <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                @else
                                <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col">Email</th>
                        <th scope="col">Função</th>
                        <th scope="col">Ativo</th>
                        <th scope="col">
                            <div class="centerTd">Ações</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="filler"></tr>
                    @foreach ($users as $user)
                        <tr class="user-row customTableStyling" data-position="{{ strtolower($user) }}"
                            data-role="{{ $user->role_id }}">
                            <td>
                                <input type="checkbox" name="selectedUsers[]"
                                       value="{{ $user->id }}">
                            </td>
                            <td class="clickable">
                                <a href="{{ route('users.show', $user->id) }}"
                                   class="d-flex align-items-center w-auto h-100">{{ $user->name }}</a>
                            </td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->role->description }}
                            </td>

                            <td>{{ $user->isActive == 1 ? 'Sim' : 'Não' }}</td>
                            <td class="editDelete">
                                <div style="width: 40%">
                                    <a href="{{ route('users.edit', $user->id) }}">
                                        <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                                    </a>
                                </div>
                                <div style="width: 40%">
                                    <form method="post" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="modalBtn" data-message="Tem a certeza que pretende enviar o {{ strtolower($user->role->description) }} {{ $user->name }} para a reciclagem?"
                                                style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="filler" style="background-color: #f8fafc"></tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $users->appends(['uPage' => $users->currentPage()])->links() }}

                <div class="container">
                    <form action="{{ route('import-excel.importUsers') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Excel - Importar Utilizadores</label><br>
                            <label for="file" class="btn btn-primary">Selecionar ficheiro</label>
                            <input type="file" name="file" id="file" class="btn" style="display: none;">
                            @error('attachment')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <p>Certifique-se que o arquivo tem menos de 20MB</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Importar</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade " id="recycleTable">

                @if($deletedUsers->isEmpty())
                    <img src="{{ asset('assets/reciclagem_azul_extra_bold_2_sem fundo.png') }}"
                         alt="Não existem registos" class="bin">
                @else

                    <div class="">
                        <table class="table">
                            <thead>
                            <tr>

                                <th scope="col">Nome</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">
                                    <div class="centerTd">Restaurar</div>
                                </th>
                                <th scope="col">
                                    <div class="centerTd">Apagar</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="filler"></tr>
                            @foreach($deletedUsers as $deletedUser)
                                <tr class="user-row customTableStyling" data-position="" data-role="" onclick="">
                                    <td>{{ $deletedUser->name }}</td>
                                    <td>{{ $deletedUser->username }}</td>
                                    <td>{{ $deletedUser->email }}</td>


                                    <td>
                                        <div class="centerTd">
                                            <form method="post" action="{{ route('users.restore', $deletedUser->id) }}"
                                                  style="display:inline;">
                                                @csrf
                                                <button type="submit" class="modalBtn"
                                                        data-message="Tem a certeza que deseja restaurar o {{strtolower($deletedUser->role->description)}} {{ $deletedUser->name }}?"
                                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <img src="{{ asset('assets/restore.svg') }}">
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="centerTd">
                                            <form method="post"
                                                  action="{{ route('users.forceDelete', $deletedUser->id) }}"
                                                  style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="modalBtn"
                                                        data-message="Tem a certeza que deseja apagar permanentemente o {{strtolower($deletedUser->role->description)}} {{ $deletedUser->name }}?"
                                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <img src="{{ asset('assets/permaDelete.svg') }}" alt="Delete">

                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                <tr class="filler" style="background-color: #f8fafc"></tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $deletedUsers->appends(['dPage' => $deletedUsers->currentPage()])->links() }}
                    </div>
                @endif

            </div>

        </div>

        {{--    confirmation modal    --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="deleteBtn">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        {{--    confirmation modal    --}}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deleteButtons = document.querySelectorAll('button[class="modalBtn"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    let message = button.getAttribute('data-message');
                    document.getElementById('modalBody').textContent = message;

                    $('#deleteModal').modal('show');

                    $('#deleteBtn').click(function () {
                        button.closest('form').submit();
                    });
                });
            });
        });
    </script>
    <style>
        .bin {
            margin-top: 100px !important;
            width: 200px;
            height: 200px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <script>
        $(document).ready(function () {
            function determineContext() {
                return 'pagination';
            }

            function getFragment() {
                return window.location.hash.substring(1);
            }

            function setFragment(fragment) {
                history.pushState(null, null, '#' + fragment);
            }

            function setActiveTab(tabId) {
                $(`#userTabs a[href="#${tabId}"]`).tab('show');
            }

            const activeTabInfo = localStorage.getItem('activeTabInfo');

            if (activeTabInfo) {
                const {tabId, context} = JSON.parse(activeTabInfo);
                setActiveTab(tabId);
                setFragment(tabId);
            }

            $('#userTabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                const tabId = $(e.target).attr('href').substring(1);
                const context = determineContext();

                const activeTabInfo = JSON.stringify({tabId, context});
                localStorage.setItem('activeTabInfo', activeTabInfo);

                setFragment(tabId);
            });

            window.addEventListener('hashchange', function () {
                const fragment = getFragment();
                setActiveTab(fragment);
            });



            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var tabId = $(e.target).attr('href');
                history.pushState(null, null, tabId);
            });

            window.addEventListener('beforeunload', function () {
                history.pushState("", document.title, window.location.pathname + window.location.search);
                localStorage.removeItem('activeTabInfo'); // Add this line

            });
        });
    </script>


    <script>
        //logica filtro
        function submitForm() {

            document.getElementById("roleFilterForm").submit();
        }
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const deleteSelectedButton = document.getElementById('delete-selected');
            const userCheckboxes = document.getElementsByName('selectedUsers[]');
            const selectAllCheckbox = document.getElementById('select-all');

            deleteSelectedButton.addEventListener('click', function (event) {
                event.preventDefault();

                let userIds = [];
                userCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        userIds.push(checkbox.value);
                    }
                });

                let message;
                if (userIds.length > 0) {
                    message = this.getAttribute('data-message');
                    deleteBtn.style.display = 'inline-block';
                } else {
                    message = this.getAttribute('data-no-selection-message');
                    deleteBtn.style.display = 'none';
                }
                document.getElementById('modalBody').textContent = message;

                $('#deleteModal').modal('show');

                $('#deleteBtn').click(function () {
                    if (userIds.length > 0) {
                        massDeleteUsers();
                    }
                });
            });

            selectAllCheckbox.addEventListener('change', function () {
                userCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            function massDeleteUsers() {
                let userIds = [];
                userCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        userIds.push(checkbox.value);
                    }
                });

                if (userIds.length > 0) {
                    let form = document.createElement('form');
                    form.action = '{{ route('users.massDelete') }}';
                    form.method = 'post';
                    form.style.display = 'none';

                    let inputToken = document.createElement('input');
                    inputToken.type = 'hidden';
                    inputToken.name = '_token';
                    inputToken.value = '{{ csrf_token() }}';
                    form.appendChild(inputToken);

                    userIds.forEach(userId => {
                        let inputUser = document.createElement('input');
                        inputUser.type = 'hidden';
                        inputUser.name = 'user_ids[]';
                        inputUser.value = userId;
                        form.appendChild(inputUser);
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            }
        });

    </script>
@endsection
