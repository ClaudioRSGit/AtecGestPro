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
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Criar Turma</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
