@extends('master.main')

@section('content')
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Lista de Cursos</h1>

        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('users.index') }}" method="get" class="form-inline" id="filterForm">
                <div class="form-group mr-3">
                    <input type="text" class="form-control" id="nameFilter" name="nameFilter"
                        value="{{ request('nameFilter') }}" placeholder="Pesquisar Curso">
                </div>
            </form>

            <a href="{{ route('courses.create') }}" class="btn btn-primary">Novo Curso</a>
        </div>

        <table class="table" id="courseTable">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Descrição</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr class="courses-row">
                        <td>{{ $course->code }}</td>
                        <td>{{ $course->description }}</td>
                        <td>
                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info">Detalhes</a>
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Editar</a>
                            <form method="post" action="{{ route('courses.destroy', $course->id) }}" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $courses->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameFilterInput = document.getElementById('nameFilter');
            const courseTable = document.getElementById('courseTable');
            const courseRows = courseTable.querySelectorAll('tbody tr');

            nameFilterInput.addEventListener('input', function () {
                filterCourses();
            });

            function filterCourses() {
                const nameFilter = nameFilterInput.value.toLowerCase();

                courseRows.forEach(courseRow => {
                    const courseName = courseRow.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const matchesName = courseName.includes(nameFilter);
                    courseRow.style.display = matchesName ? '' : 'none';
                });
            }
        });
    </script>
@endsection
