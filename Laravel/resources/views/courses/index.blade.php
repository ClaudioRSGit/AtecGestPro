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
            <button class="btn btn-danger" id="delete-selected">Excluir Selecionados</button>

            <a href="{{ route('courses.create') }}" class="btn btn-primary">Novo Curso</a>
        </div>

        <table class="table" id="courseTable">
            <thead style="width: 100%">
                <tr class="no-hover">
                    <th scope="col">
                        <input type="checkbox" id="select-all">
                    </th>
                    <th scope="col">Código</th>
                    <th scope="col">Descrição</th>
                    <th class="fill"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="filler"></tr>
                @foreach ($courses as $course)
                    <tr class="courses-row customTableStyling">
                        <td>
                            <input type="checkbox" name="selectedCourses[]" value="{{ $course->id }}">
                        </td>
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
                    <tr class="filler"></tr>
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
            const selectAllCheckbox = document.getElementById('select-all');
            const deleteSelectedButton = document.getElementById('delete-selected');

            nameFilterInput.addEventListener('input', function () {
                filterCourses();
            });

            selectAllCheckbox.addEventListener('change', function () {
                courseRows.forEach(courseRow => {
                    const checkbox = courseRow.querySelector('input[name="selectedCourses[]"]');
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            deleteSelectedButton.addEventListener('click', function () {
                const selectedCourses = Array.from(document.querySelectorAll('input[name="selectedCourses[]"]:checked'))
                    .map(checkbox => checkbox.value);

                if (selectedCourses.length > 0 && confirm('Tem certeza que deseja excluir os cursos selecionados?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('courses.massDelete') }}';
                    form.style.display = 'none';

                    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

                    selectedCourses.forEach(courseId => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'course_ids[]';
                        input.value = courseId;
                        form.appendChild(input);
                    });

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });

            function filterCourses() {
                const nameFilter = nameFilterInput.value.toLowerCase();

                courseRows.forEach(courseRow => {
                    const courseName = courseRow.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const matchesName = courseName.includes(nameFilter);
                    courseRow.style.display = matchesName ? '' : 'none';
                });
            }
        });
    </script>
@endsection
