@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Turma</h1>
        <form method="post" action="{{ route('course-classes.update', $courseClass->id) }}" class="w-50">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="description">Descrição:</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="{{ $courseClass->description }}">

                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="course_id">Curso:</label>
                <select class="form-control" id="course_id" name="course_id" required>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ $course->id == $courseClass->course_id ? 'selected' : '' }} data-code="{{ $course->code }}">
                            {{ $course->description }}
                        </option>
                    @endforeach
                </select>

                @error('course_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_code">Código do Curso:</label>
                <input type="text" class="form-control" id="courseCode_id" name="course_id"
                    value="{{ $courseClass->course->id }}" readonly>
            </div>

            <div class="form-group">
                <label for="students">Alunos na Turma:</label>
                <ul>
                    @foreach ($courseClass->users as $student)
                        <li>{{ $student->name }}</li>
                    @endforeach
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Turma</button>
            <a href="{{ route('course-classes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var courseDropdown = document.getElementById('course_id');
        var courseCode = document.getElementById('courseCode_id');

        function setCourseCode() {
            var selectedOption = courseDropdown.options[courseDropdown.selectedIndex];
            courseCode.value = selectedOption.getAttribute('data-code');
        }

        setCourseCode();

        courseDropdown.addEventListener('change', setCourseCode);
    });
</script>
