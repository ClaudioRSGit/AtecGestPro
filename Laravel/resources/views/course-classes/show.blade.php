@extends('master.main')
@section('title', 'Detalhes da Turma')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#success-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#error-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif
        <form class="w-50">
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $courseClass->description }}" disabled>
            </div>

            <div class="form-group">
                <label for="course_id">Curso:</label>
                <select class="form-control" id="course_id" name="course_id" disabled>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $course->id == $courseClass->course_id ? 'selected' : '' }} disabled>
                            {{ $course->description }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="course_code">Código do Curso:</label>
                <input type="text" class="form-control" id="course_code" name="course_code" value="{{ $courseClass->course->code }}" disabled>
            </div>

            <div class="form-group">
                <label for="students">Alunos na Turma:</label>
                <ul>
                    @foreach($courseClass->users as $student)
                        <li>{{ $student->name }}</li>
                    @endforeach
                </ul>
            </div>
        </form>

        <a href="{{ route('course-classes.edit', $courseClass->id) }}" class="btn btn-primary">Editar Turma</a>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
    </div>
@endsection
