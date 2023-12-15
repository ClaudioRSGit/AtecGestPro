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
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="role" class="form-label">Função:</label>
                    <select class="form-select" id="role" name="role" disabled>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        <option value="tecnico" {{ $user->role === 'tecnico' ? 'selected' : '' }}>Técnico</option>
                        <option value="formando" {{ $user->role === 'formando' ? 'selected' : '' }}>Formando</option>
                    </select>
                </div>

                @if ($user->isStudent == 1)
                <div class="mb-3">
                    <label for="course_class_id" class="form-label">Turma:</label>
                    <select class="form-select" id="course_class_id" name="course_class_id" disabled>
                        @foreach($courseClasses as $class)
                        <option value="{{ $class->id }}" {{ $user->course_class_id == $class->id ? 'selected' : '' }}>
                            {{ $class->description }}
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="courseDescription" class="form-label">Curso:</label>
                    <select class="form-select" id="courseDescription" name="courseDescription" disabled>
                        @foreach($courses as $course)
                            <option value="{{ $course->description }}" {{ $user->courseClass->course->description == $course->description ? 'selected' : '' }}>
                                {{ $course->description }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="mb-3">
                    <label for="isActive" class="form-label">Estado:</label>
                    <select class="form-select" id="isActive" name="isActive" disabled>
                        <option value="1" {{ $user->isActive === '1' ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ $user->isActive === '0' ? 'selected' : '' }}>Desativado</option>
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
