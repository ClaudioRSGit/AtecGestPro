@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Utilizador</h1>

        <form method="post" action="{{ route('users.update', $user->id) }}" id="userForm">
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
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $user->username }}">

                            @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $user->email }}">

                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contacto:</label>
                        <input type="text" class="form-control" id="contact" name="contact"
                            value="{{ $user->contact }}">

                            @error('contact')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="{{ $user->password ? 'Não altere para manter a password existente' : '' }}">

                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">Função:</label>
                        <select class="form-select" id="role" name="role">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                            <option value="tecnico" {{ $user->role === 'tecnico' ? 'selected' : '' }}>Técnico</option>
                            <option value="formando" {{ $user->role === 'formando' ? 'selected' : '' }}>Formando</option>
                        </select>
                    </div>

                    @if ($user->isStudent == 1)
                        <div class="mb-3" id="labelCourseClass">
                            <label for="course_class_id" class="form-label">Turma:</label>
                            <select class="form-select" id="course_class_id" name="course_class_id">
                                @foreach ($courseClasses as $class)
                                    <option value="{{ $class->id }}"
                                        {{ $user->course_class_id == $class->id ? 'selected' : '' }}>
                                        {{ $class->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="labelCourseDescription">
                            <label for="courseDescription" class="form-label">Curso:</label>
                            <select class="form-select" id="courseDescription" name="courseDescription">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->description }}"
                                        {{ $user->courseClass->course->description == $course->description ? 'selected' : '' }}>
                                        {{ $course->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="isActive" class="form-label">Estado:</label>
                        <select class="form-select" id="isActive" name="isActive">
                            <option value="1" {{ $user->isActive == 1 ? 'selected' : '' }}>Ativo</option>
                            <option value="0" {{ $user->isActive == 0 ? 'selected' : '' }}>Desativado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="actions">Ações:</label>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <button type="submit" form="deleteForm" class="btn btn-danger mt-3">Excluir</button>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </div>
                </div>

            </div>
    </div>
    </form>
    <form id="deleteForm" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#course_class_id, #courseDescription, #labelCourseClass, #labelCourseDescription').hide();

        function toggleFieldsBasedOnRole() {
            var selectedRole = $('#role').val();

            if (selectedRole === 'formando') {
                $('#course_class_id, #courseDescription, #labelCourseClass, #labelCourseDescription').show();
            } else {
                $('#course_class_id, #courseDescription, #labelCourseClass, #labelCourseDescription').hide();
            }
        }
        toggleFieldsBasedOnRole();

        $('#role').change(toggleFieldsBasedOnRole);
    });

    </script>
@endsection
