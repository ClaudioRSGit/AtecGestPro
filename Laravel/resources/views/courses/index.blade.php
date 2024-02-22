@extends('master.main')

@section('content')
    <div class="container  w-100 fade-in">

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Lista de Cursos</h1>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                <img src="{{ asset('assets/new.svg') }}"> Novo Curso
            </a>
        </div>

        <div class="d-flex justify-content-between mb-3">


            <form action="{{ route('courses.index') }}" method="get" class="form-inline" id="filterForm">
                <div class="input-group pr-2">
                    <div class="search-container">
                        <input type="text" class="form-control" id="courseSearch" name="courseSearch"
                               value="{{ request('courseSearch') }}" placeholder="Pesquisar curso...">
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">
                            Procurar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <table class="table" id="courseTable">
            <thead style="width: 100%">
            <tr>

                <th>
                    <a href="{{ route('courses.index', ['sortColumn' => 'code', 'sortDirection' => $sortColumn === 'code' ? ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">Código</a>
                </th>
                <th>
                    <a href="{{ route('courses.index', ['sortColumn' => 'description', 'sortDirection' => $sortColumn === 'description' ? ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">Descrição</a>
                </th>
                <th class="fill"></th>
            </tr>
            </thead>
            <tbody>
            <tr class="filler"></tr>
            @foreach ($courses as $course)
                <tr class="courses-row customTableStyling" style="width: 100%">

                    <td class="clickable" style="width: 10%">
                        <a href="{{ route('courses.show', $course->id) }}"
                           class="d-flex align-items-center w-auto h-100">{{ $course->code }}</a>
                    </td>
                    <td class="clickable" style="width: 85%">
                        <a href="{{ route('courses.show', $course->id) }}"
                            class="d-flex align-items-center w-auto h-100">{{ $course->description }}</a>
                    </td>
                    <td class="editDelete" style="min-width: 7rem;">
                        <div style="width: 40%">
                            <a href="{{ route('courses.edit', $course->id) }}" class="mx-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                     viewBox="0 0 512 512">
                                    <path fill="#116fdc"
                                          d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                </svg>
                            </a>
                        </div>
                        <div style="width: 40%">
                            <form method="post" action="{{ route('courses.destroy', $course->id) }}"
                                  style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" id="modal"
                                        data-message="Tem a certeza que deseja eliminar o curso {{ $course->description }}?"
                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                         viewBox="0 0 448 512">
                                        <path fill="#116fdc"
                                              d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr class="filler"></tr>
            @endforeach
            </tbody>
        </table>
        {{ $courses->links() }}

        {{--    confirmation modal    --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="deleteBtn">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        {{--    confirmation modal    --}}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deleteButton = document.getElementById('modal');

            deleteButton.addEventListener('click', function (event) {
                event.preventDefault();

                let message = deleteButton.getAttribute('data-message');
                document.getElementById('modalBody').textContent = message;

                $('#deleteModal').modal('show');

                $('#deleteBtn').click(function () {
                    deleteButton.closest('form').submit();
                });
            });
        });
    </script>

    <script>
        function submitSortCode() {
            document.getElementById("filterForm").submit();
        }
    </script>
    <script>

        setTimeout(function () {
            $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2000);
    </script>
    <style>

    </style>
@endsection
