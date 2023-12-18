@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Turma</h1>
        <form method="post" action="{{ route('course-classes.update', $courseClass->id) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $courseClass->description }}" required>
            </div>
            <div class="form-group">
                <label for="course_id">Curso:</label>
                <select class="form-control" id="course_id" name="course_id" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $course->id == $courseClass->course_id ? 'selected' : '' }}>
                            {{ $course->description }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="course_code">Código do Curso:</label>
                <input type="text" class="form-control" id="course_code" name="course_code" value="{{ $courseClass->course->code }}" readonly>
            </div>

            <div class="form-group">
                <label for="students">Alunos na Turma:</label>
                <ul>
                    @foreach($courseClass->students as $student)
                        <li>{{ $student->name }}</li>
                    @endforeach
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Turma</button>
            <a href="{{ route('course-classes.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </form>
    </div>
@endsection
