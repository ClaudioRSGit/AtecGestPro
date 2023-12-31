@extends('master.main')

@section('content')
    <div class="container">
        <h1>Criar Turma</h1>
        <form method="post" action="{{ route('course-classes.store') }}">
            @csrf

            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>

            <div class="form-group">
                <label for="course_id">Curso:</label>
                <select class="form-control" id="course_id" name="course_id" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="container">
            <h3 class="my-3">Atribuir alunos à turma</h3>
            <div class="d-flex justify-content-between mb-3">
                <form class="form-inline w-50" id="filterForm">
                    <div class="form-group search-container mr-3 w-100" style="width: 30%;">
                        <input type="text" id="search" class="form-control w-100" placeholder="Pesquisar Alunos">
                    </div>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all">
                        </th>
                        <th>Nome</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td><input type="checkbox" name="selected_students[]" value="{{ $student->id }}"></td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->username }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <span>Edit</span>
                                <span>Delete</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <button type="submit" class="btn btn-primary">Criar Turma</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
        </form>

    </div>
@endsection
