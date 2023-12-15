@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Material</h1>

        <form method="post" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Utilizador:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contacto:</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="{{ $user->contact }}">
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Função:</label>
                        <select class="form-select" id="role" name="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="tecnico">Técnico</option>
                            <option value="formando">Formando</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="isActive" class="form-label">Ativo:</label>
                        <select class="form-select" id="isActive" name="isActive">
                            <option value="1" {{ old('isActive') == 1 ? 'selected' : '' }}>Sim</option>
                            <option value="0" {{ old('isActive') == 0 ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="actions">Ações:</label>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-secondary mt-3">Excluir</a>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </div>
                </div>

                </div>

            </div>



        </form>
    </div>
@endsection
