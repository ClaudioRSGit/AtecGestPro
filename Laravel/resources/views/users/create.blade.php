@extends('master.main')

@section('content')
    <div class="container">
        <h1>Criar Novo Utilizador</h1>

        <form method="post" action="{{ route('users.store') }}">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('John') }}">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('John123') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('John@gmail.com') }}">
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contacto:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ old('990000000') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="text" class="form-control" id="password" name="password" value="{{ old('password') }}">
            </div>


            <div class="mb-3">
                <label for="role" class="form-label">Função:</label>
                <input type="text" class="form-control" id="role" name="role" value="{{ old('user') }}">
            </div>

            <div class="mb-3">
                <label for="isActive" class="form-label">Ativo:</label>
                <select class="form-select" id="isActive" name="isActive">
                    <option value="1" {{ old('isActive') == 1 ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ old('isActive') == 0 ? 'selected' : '' }}>Não</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="isStudent" class="form-label">Ativo:</label>
                <select class="form-select" id="isStudent" name="isActive">
                    <option value="1" {{ old('isStudent') == 1 ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ old('isStudent') == 0 ? 'selected' : '' }}>Não</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Criar Utilizador</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
