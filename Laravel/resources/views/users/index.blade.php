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

            <a href="{{ route('users.create') }}" class="btn btn-primary">Novo Utilizador</a>
        </div>

        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Função</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="user-row" data-role="{{ strtolower($user->role) }}">
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
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Detalhes</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                            <form method="post" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
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

            nameFilterInput.addEventListener('input', function () {
                filterUsers();
            });

            roleFilterSelect.addEventListener('change', function () {
                filterUsers();
            });

            function filterUsers() {
                const nameFilter = nameFilterInput.value.toLowerCase();
                const roleFilter = roleFilterSelect.value;


                userRows.forEach(userRow => {
                    const userName = userRow.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const userRole = userRow.getAttribute('data-role');

                    const matchesName = userName.includes(nameFilter);
                    const matchesRole = roleFilter === '' || userRole === roleFilter;

                    userRow.style.display = matchesName && matchesRole ? '' : 'none';
                });
            }
        });
    </script>
@endsection
