@extends('master.main')

@section('content')
    <div class="container">
        <h1>Vestuário</h1>
        <div class="d-flex justify-content-between mb-3">
            <div class="w-100 d-flex align-items-center" style="gap: 1rem">
                <div class="form-group search-container w-50" >
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar Turma">
                </div>
                <div class="form-group mx-2" style="width: 30%">
                    <select class="form-control" id="filter">
                        <option value="all">Todos</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <a href="{{ route('course-classes.create') }}" class="btn btn-primary">
                <img src="{{ asset('assets/new.svg') }}">
                Criar Turma
            </a>
        </div>

        <div id="accordion">
            <div class="ms-auto">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="select-all">
                <label for="select-all"></label>
                <span>&nbsp; &nbsp;Turma</span>
            </div>
            @foreach($courseClasses as $courseClass)
                <div class="card mb-2 mt-2">
                    <div class="card-header bg-white" id="heading{{ $courseClass->id }}">
                        <h2 class="mb-0">
                            <input type="checkbox" class="accordion-checkbox" data-course="{{ $courseClass->course_id }}" data-id="{{ $courseClass->id }}">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $courseClass->id }}" aria-expanded="false" aria-controls="collapse{{ $courseClass->id }}">
                                {{ $courseClass->description }}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{ $courseClass->id }}" class="collapse" aria-labelledby="heading{{ $courseClass->id }}" data-parent="#accordion">
                        <div class="card-body">
                            @if ($courseClass->students->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Entregue</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="filler"></tr>
                                    @foreach($courseClass->students as $student)
                                        <tr class="customTableStyling" onclick="location.href='{{ route('users.show', $student->id) }}'">

                                            <td>{{ $student->name }}</a></td>
                                            <td>{{ $student->username }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td><input type="checkbox"></td>
                                            <td>
                                                <a href="{{ route('users.edit', $student->id) }}" class="mx-2">
                                                    <img src="{{ asset('assets/edit.svg') }}" alt="edit">
                                                </a>
                                                <form method="POST" action="{{ route('users.destroy', $student->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                        <img src="{{ asset('assets/delete.svg') }}" alt="delete">
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr class="filler"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <p>Não existem estudantes nesta turma</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $courseClasses->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.accordion-checkbox');
            const searchInput = document.getElementById('search');
            const filterDropdown = document.getElementById('filter');

            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll('.accordion-checkbox:checked').length;
                });
            });

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();
                filterMaterials(searchTerm);
            });

            filterDropdown.addEventListener('change', function () {
                filterMaterials();
            });

            function filterMaterials(searchTerm = null) {
                const courseClassCards = document.querySelectorAll('.card');

                courseClassCards.forEach(card => {
                    const courseId = card.querySelector('.accordion-checkbox').getAttribute('data-course');
                    const filterValue = filterDropdown.value;

                    const matchesFilter = (
                        (filterValue === 'all') ||
                        (filterValue === courseId)
                    );

                    const matchesSearch = !searchTerm || (
                        card.textContent.toLowerCase().includes(searchTerm) ||
                        card.querySelector('button').textContent.toLowerCase().includes(searchTerm)
                    );

                    card.style.display = matchesFilter && matchesSearch ? '' : 'none';
                });
            }
        });
    </script>
    <style>
        #accordion .card {
            border: none;
        }

        #accordion .card-header {
            border-bottom: none;
        }

        #accordion .card-body {
            background-color: #f8fafc;
        }
    </style>
@endsection
