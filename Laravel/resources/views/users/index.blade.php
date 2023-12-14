@extends('master.main')

@section('content')
    <div class="container">
        <h1>Lista de Utilizadores</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Novo User</a>

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
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{('isActive') == true ? 'Sim' : 'Não'}}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Detalhes</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                        <form method="post" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
