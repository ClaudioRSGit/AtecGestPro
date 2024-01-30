@extends('master.main')

@section('content')
    <div class="container">
        <h1>Criar Turma</h1>
        <form method="post" action="{{ route('course-classes.store') }}" id="createCourseClassForm" class="w-70 mb-3">
            @csrf

            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" class="form-control" id="description" name="description">

                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_id">Curso:</label>
                <select class="form-control" id="course_id" name="course_id" required>

                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->description }}</option>
                    @endforeach
                </select>

                @error('course_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="container">
                <h3 class="my-3">Atribuir alunos à turma</h3>
                <div class="d-flex justify-content-between w-100">
                    <div class="form-group mr-3 w-75 search-container">
                        <input type="text" id="search" class="form-control w-100" placeholder="Pesquisar Aluno">
                    </div>
                    <div class="form-group w-25">
                        <a href="{{ route('users.create') }}" class="btn btn-primary w-100">
                            <img src="{{ asset('assets/new.svg') }}">
                            Novo Aluno
                        </a>
                    </div>
                </div>
                <table class="table" id="studentsTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Nome</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td><input type="checkbox" name="selected_students[]" value="{{ $student->id }}"></td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $students->links() }}
            </div>


            <button type="submit" class="btn btn-primary" name="noImport" id="criarTurmaBtn">Criar Turma</button>
            <button type="submit" class="btn btn-primary" name="import">Criar Turma e importar alunos a partir de
                Excel</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#select-all").click(function() {
                $("input[name='selected_students[]']").prop('checked', $(this).prop('checked'));
            });

            $("#criarTurmaBtn").click(function() {
                document.getElementById('createCourseClassForm').submit();
            });

            $("#search").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#studentsTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
