@extends('master.main')

@section('content')
    <div class="container  w-100 fade-in">
        <h1>Editar Turma</h1>
        <form method="post" action="{{ route('course-classes.update', $courseClass->id) }}">
            @csrf
            @method('put')

            <div class="row courseClassEditInfo">
                <div class="col-6">
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <input type="text" class="form-control" id="description" name="description"
                               value="{{ $courseClass->description }}">

                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="course_id">Curso:</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                        {{ $course->id == $courseClass->course_id ? 'selected' : '' }} data-code="{{ $course->code }}">
                                    {{ $course->description }}
                                </option>
                            @endforeach
                        </select>

                        @error('course_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row my-3 courseClassEditStudents">
                <div class="col-6 ">
                    <div class="form-group card ">
                        <label class="pl-2 pt-2 font-weight-bold" for="students">Remover alunos</label>
                        @if($students->isEmpty())
                            <p class="pl-2 pb-2 font-weight-bold text-danger" style="text-align: center">Não existem
                                alunos nesta turma</p>
                        @else
                            <div class="scrollable">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Número Interno</th>
                                        <th class="center-checkbox">Remover</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->username }}</td>
                                            <td class="center-checkbox">
                                                <input type="checkbox" name="studentsToRemove[]"
                                                       value="{{ $student->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-6  ">
                    <div class="form-group card">
                        <label class="pl-2 pt-2 font-weight-bold" for="students">Adicionar alunos</label>
                        @if($studentsWithoutClassCourse->isEmpty())
                            <p class="pl-2 pb-2 font-weight-bold text-danger" style="text-align: center">Não existem
                                alunos sem turma para adicionar</p>
                        @else
                            <div class="scrollable">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Número Interno</th>
                                        <th class="center-checkbox">Adicionar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($studentsWithoutClassCourse as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->username }}</td>
                                            <td class="center-checkbox">
                                                <input type="checkbox" name="studentsToAdd[]"
                                                       value="{{ $student->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="btns">
                <button type="submit" class="btn btn-primary">Atualizar Turma</button>
                <a href="{{ route('course-classes.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>

    </div>

    <style>
        .center-checkbox {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .scrollable {
            max-height: 30rem;
            overflow-y: auto;
        }
    </style>
@endsection

{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        var courseDropdown = document.getElementById('course_id');--}}

{{--        function setCourseCode() {--}}
{{--            var selectedOption = courseDropdown.options[courseDropdown.selectedIndex];--}}
{{--        }--}}

{{--        setCourseCode();--}}

{{--        courseDropdown.addEventListener('change', setCourseCode);--}}
{{--    });--}}
{{--</script>--}}
