@extends('master.main')

@section('content')
    <div class="container  pl-5 pt-4">

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
                        <option value="" {{ request('roleFilter') === '' ? 'selected' : '' }}>Todas as Funções
                        </option>
                        <option value="admin" {{ request('roleFilter') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('roleFilter') === 'user' ? 'selected' : '' }}>User</option>
                        <option value="tecnico" {{ request('roleFilter') === 'tecnico' ? 'selected' : '' }}>Técnico</option>
                        <option value="formando" {{ request('roleFilter') === 'formando' ? 'selected' : '' }}>Formando
                        </option>
                    </select>
                </div>
            </form>

            <a href="{{ route('users.create') }}" class="btn btn-primary">Novo Utilizador</a>
        </div>

        <table class="table">
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
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
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
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $('#nameFilter, #roleFilter').on('input', function(event) {
            if (event.key === 'Enter') {
                updateUsersList();
            }
        });

        function updateUsersList() {
            $.ajax({
                url: $('#filterForm').attr('action'),
                method: 'get',
                data: $('#filterForm').serialize(),
                success: function(response) {
                    $('#userTable tbody').html($(response).find('#userTable tbody').html());
                },
                error: function(error) {
                    console.error('Update Error', error);
                }
            });
        }
    </script>
@endsection
