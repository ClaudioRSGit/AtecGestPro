@extends('master.main')

@section('content')
    <div class="container">
        <h1>Detalhes da Turma</h1>

        <form>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $courseClass->description }}" disabled>
            </div>

            <div class="form-group">
                <label for="course_id">Curso:</label>
                <select class="form-control" id="course_id" name="course_id" disabled>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $course->id == $courseClass->course_id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <a href="{{ route('course-classes.edit', $courseClass->id) }}" class="btn btn-warning">Editar Turma</a>
    </div>
@endsection
