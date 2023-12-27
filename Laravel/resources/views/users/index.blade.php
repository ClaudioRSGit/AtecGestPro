@extends('master.main')

@section('content')
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Lista de Utilizadores</h1>

        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('users.index') }}" method="get" class="form-inline" id="filterForm">
                <div class="form-group mr-3">
                    <input type="text" class="form-control" id="nameFilter" name="nameFilter"
                        value="{{ request('nameFilter') }}" placeholder="Pesquisar Utilizador">
                </div>
                <div class="form-group mr-3">
                    <select class="form-control" id="roleFilter" name="roleFilter">
                        <option value="">Todas as Funções</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="tecnico">Técnico</option>
                        <option value="formando">Formando</option>
                    </select>
                </div>
            </form>
            <button class="btn btn-danger" id="delete-selected">Excluir Selecionados</button>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <img src="{{ asset('assets/new.svg') }}">
                Novo Utilizador
            </a>
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
                    <tr class="user-row customTableStyling" data-role="{{ strtolower($user->role) }}">
                        <td>
                            <input type="checkbox" name="selectedUsers[]" value="{{ $user->id }}">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'user')
                                User
                            @elseif($user->role == 'admin')
                                Administrador
                            @elseif($user->role == 'formando')
                                Formando
                            @elseif($user->role == 'tecnico')
                                Técnico
                            @else
                                {{ $user->role }}
                            @endif
                        </td>

                        <td>{{ $user->isActive == 1 ? 'Sim' : 'Não' }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}">
                                <img src="{{ asset('assets/show.svg') }}" alt="show">
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="mx-2">
                                <img src="{{ asset('assets/edit.svg') }}" alt="edit">
                            </a>
                            <form method="post" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
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
        document.addEventListener('DOMContentLoaded', function () {
            const nameFilterInput = document.getElementById('nameFilter');
            const roleFilterSelect = document.getElementById('roleFilter');
            const userTable = document.getElementById('userTable');
            const userRows = userTable.querySelectorAll('tbody tr');
            const selectAllCheckbox = document.getElementById('select-all');
            const deleteSelectedButton = document.getElementById('delete-selected');

            nameFilterInput.addEventListener('input', function () {
                filterUsers();
            });

            roleFilterSelect.addEventListener('change', function () {
                filterUsers();
            });

            selectAllCheckbox.addEventListener('change', function () {
                userRows.forEach(userRow => {
                    const checkbox = userRow.querySelector('input[name="selectedUsers[]"]');
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            deleteSelectedButton.addEventListener('click', function () {
                const selectedUsers = Array.from(document.querySelectorAll('input[name="selectedUsers[]"]:checked'))
                    .map(checkbox => checkbox.value);

                if (selectedUsers.length > 0 && confirm('Tem certeza que deseja excluir os utilizadores selecionados?')) {
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
                const nameFilter = nameFilterInput.value.toLowerCase();
                const roleFilter = roleFilterSelect.value;

                userRows.forEach(userRow => {
                    const userName = userRow.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const userRole = userRow.getAttribute('data-role');

                    const matchesName = userName.includes(nameFilter);
                    const matchesRole = roleFilter === '' || userRole === roleFilter;

                    userRow.style.display = matchesName && matchesRole ? '' : 'none';
                });
            }
        });
    </script>
@endsection
