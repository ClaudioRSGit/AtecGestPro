@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">
        <h1>Detalhes da Turma</h1>

        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" class="form-control" id="description" name="description"
                           value="{{ $courseClass->description }}" disabled>
                </div>

                <div class="form-group">
                    <label for="course_id">Curso:</label>
                    <select class="form-control" id="course_id" name="course_id" disabled>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                    {{ $course->id == $courseClass->course_id ? 'selected' : '' }} disabled>
                                {{ $course->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="course_code">Código do Curso:</label>
                    <input type="text" class="form-control" id="course_code" name="course_code"
                           value="{{ $courseClass->course->code }}" disabled>
                </div>

            </div>


            <div class="col-6 ">

                @if($courseClass->users->isEmpty())
                    <p class="pl-2 pb-2 font-weight-bold text-danger" style="text-align: center">Não existem
                        alunos nesta turma</p>
                @else
                    <label for="students">Alunos na Turma:</label>
                    <div class="form-group border">
                        <ul class="mt-2">
                            @foreach($courseClass->users as $student)
                                <li>{{ $student->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>


        <a href="{{ route('course-classes.edit', $courseClass->id) }}" class="btn btn-primary">Editar Turma</a>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
    </div>
@endsection
