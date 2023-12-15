@extends('master.main')

@section('content')
    <div class="container">
        <h1>Detalhes do Utilizador</h1>

        <div class="row">
            <div class="col-md-6">

                <div class="mb-3">
                    <label for="name" class="form-label">Nome do Utilizador:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contacto:</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="{{ $user->contact }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Função:</label>
                    <select class="form-select" id="role" name="role" disabled>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        <option value="tecnico" {{ $user->role === 'tecnico' ? 'selected' : '' }}>Técnico</option>
                        <option value="formando" {{ $user->role === 'formando' ? 'selected' : '' }}>Formando</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="isActive" class="form-label">Ativo:</label>
                    <select class="form-select" id="isActive" name="isActive" disabled>
                        <option value="1" {{ $user->isActive === '1' ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ $user->isActive === '0' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="actions">Ações:</label>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
