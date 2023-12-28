@extends('master.main')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="mb-4">Utilizadores</h1>

        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('users.index') }}" method="get" class="form-inline w-50" id="filterForm">
                <div class="form-group search-container mr-3 w-100">
                    <input type="text" class="form-control w-100" id="nameFilter" name="nameFilter"
                        value="{{ request('nameFilter') }}" placeholder="Pesquisar Utilizador">
                </div>
            </form>
            <div class="buttons">
                <button class="btn btn-danger" id="delete-selected">Excluir Selecionados</button>
                <div>
                    <select class="form-control" id="positionFilter" name="positionFilter">
                        <option value="">Todas as Funções</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="tecnico">Técnico</option>
                        <option value="formando">Formando</option>
                    </select>
                </div>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <img src="{{ asset('assets/new.svg') }}">
                    Novo Utilizador
                </a>
            </div>
        </div>

        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th scope="col">
                        <input type="checkbox" id="select-all">
                    </th>
                    <th scope="col">Nome</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Função</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr class="filler"></tr>
                @foreach ($users as $user)
                    <tr class="user-row customTableStyling" data-position="{{ strtolower($user->position) }}" onclick="location.href='{{ route('users.show', $user->id) }}'">
                        <td>
                            <input type="checkbox" class="no-propagate" name="selectedUsers[]" value="{{ $user->id }}">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->position == 'user')
                                User
                            @elseif($user->position == 'admin')
                                Administrador
                            @elseif($user->position == 'formando')
                                Formando
                            @elseif($user->position == 'tecnico')
                                Técnico
                            @else
                                {{ $user->position }}
                            @endif
                        </td>

                        <td>{{ $user->isActive == 1 ? 'Sim' : 'Não' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="mx-2">
                                <img src="{{ asset('assets/edit.svg') }}" alt="edit">
                            </a>
                            <form method="post" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')"
                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                    <img src="{{ asset('assets/delete.svg') }}" alt="delete">
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="filler" style="background-color: #f8fafc"></tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.no-propagate');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const nameFilterInput = document.getElementById('nameFilter');
            const positionFilterSelect = document.getElementById('positionFilter');
            const userTable = document.getElementById('userTable');
            const userRows = userTable.querySelectorAll('tbody tr');
            const selectAllCheckbox = document.getElementById('select-all');
            const deleteSelectedButton = document.getElementById('delete-selected');

            nameFilterInput.addEventListener('input', function() {
                console.log('Nome do Filtro Alterado');
                filterUsers();
            });

            positionFilterSelect.addEventListener('change', function() {
                console.log('Função do Filtro Alterada');
                filterUsers();
            });

            selectAllCheckbox.addEventListener('change', function() {
                userRows.forEach(userRow => {
                    const checkbox = userRow.querySelector('input[name="selectedUsers[]"]');
                    if (checkbox) {
                        checkbox.checked = selectAllCheckbox.checked;
                    }
                });
            });

            deleteSelectedButton.addEventListener('click', function() {
                const selectedUsers = Array.from(document.querySelectorAll(
                        'input[name="selectedUsers[]"]:checked'))
                    .map(checkbox => checkbox.value);

                if (selectedUsers.length > 0 && confirm(
                        'Tem certeza que deseja excluir os utilizadores selecionados?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('users.massDelete') }}';
                    form.style.display = 'none';

                    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

                    selectedUsers.forEach(userId => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'user_ids[]';
                        input.value = userId;
                        form.appendChild(input);
                    });

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });

            function filterUsers() {
                console.log('Filtrando Usuários...');

                const nameFilter = nameFilterInput.value.toLowerCase();
                const positionFilter = positionFilterSelect.value;

                userRows.forEach(userRow => {
                    const userNameElement = userRow.querySelector('td:nth-child(2)');

                    if (userNameElement) {
                        const userName = userNameElement.textContent.toLowerCase();
                        const userPosition = userRow.getAttribute('data-position');

                        const matchesName = userName.includes(nameFilter);
                        const matchesPosition = positionFilter === '' || userPosition === positionFilter;

                        userRow.style.display = matchesName && matchesPosition ? '' : 'none';
                    }
                });
            }
        });
    </script>
@endsection
