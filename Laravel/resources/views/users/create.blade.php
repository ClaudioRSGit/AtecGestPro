@extends('master.main')

@section('content')
    <div class="container">
        <h1>Criar Novo Utilizador</h1>

        <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Utilizador:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contacto:</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="text" class="form-control" id="password" name="password" value="{{ old('password') }}">
                    </div>
                </div>

                <div class="col-md-6">
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
                        <label for="course_class_id" class="form-label">Turma:</label>
                        <select class="form-select" id="course_class_id" name="course_class_id">
                            @foreach($courseClasses as $class)
                                <option value="{{ $class->id }}">{{ $class->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="courseDescription" class="form-label">Curso:</label>
                        <select class="form-select" id="courseDescription" name="courseDescription">
                            @foreach($courses as $course)
                                <option value="{{ $course->description }}">{{ $course->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="isActive" class="form-label">Estado:</label>
                        <select class="form-select" id="isActive" name="isActive">
                            <option value="1">Ativo</option>
                            <option value="0">Desativado</option>
                        </select>
                    </div>
                </div>


            <button type="submit" class="btn btn-primary">Criar Utilizador</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
