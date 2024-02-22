@extends('master.main')

@section('content')

<div class="container w-100 fade-in">
    <h1>{{ $message }}</h1>

    <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Função</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr class="filler"></tr>
                @foreach($importedUsers as $user)
                <tr class="user-row customTableStyling" data-position="{{ strtolower($user) }}"
                data-role="{{ $user->role_id }}">
                    <td>
                        <input type="checkbox" name="selectedUsers[]"
                            value="{{ $user->id }}">
                    </td>
                    <td class="clickable">
                        <a href="{{ route('users.show', $user->id) }}" class="d-flex align-items-center w-auto h-100">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->description }}</td>
                    <td class="editDelete">
                        <div style="width: 40%">
                            <a href="{{ route('users.edit', $user->id) }}">
                                <i class="fa-solid fa-pen-to-square fa-xl" style="color: #116fdc;"></i>
                            </a>
                        </div>
                        <div style="width: 40%">
                            <form method="post" action="{{ route('users.destroy', $user->id) }}"
                                  style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir?')"
                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                        <i class="fa-solid fa-trash-can fa-xl" style="color: #116fdc;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr class="filler"></tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-primary">Voltar à página de utilizadores</a>
</div>

@endsection
