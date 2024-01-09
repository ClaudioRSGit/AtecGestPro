@extends('master.main')

@section('content')
    <div class="container">
        <h1>Vestuário</h1>

        <ul class="nav nav-tabs mb-2" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#formandos">Formandos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#outros">Outros</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="formandos">
        <div class="d-flex justify-content-between mb-3">
            <div class="w-75 d-flex align-items-center" style="gap: 1rem">
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
                                        <tr class="customTableStyling" onclick="location.href='{{ route('material-clothing-delivery.create', $student->id) }}'">

                                            <td>{{ $student->name }}</a></td>
                                            <td>{{ $student->username }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td><input type="checkbox" class="no-propagate"></td>
                                            <td class="editDelete">
                                                <div style="width: 40%">
                                                    <a href="{{ route('users.edit', $student->id) }}" class="mx-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#116fdc" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </a>
                                                </div>
                                                <div style="width: 40%">
                                                    <form method="POST" action="{{ route('users.destroy', $student->id) }}" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#116fdc" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                                                        </button>
                                                    </form>
                                                </div>
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
    <div class="tab-pane fade" id="outros">
        <div class="w-100 d-flex align-items-center" style="gap: 1rem">
            <div class="form-group search-container w-50" >
                <input type="text" id="search" class="form-control" placeholder="Pesquisar Utilizador">
            </div>
            <div class="form-group mx-2">
                <select class="form-control" id="filter">
                    <option value="all">Todos</option>
                    @foreach($nonDocents as $nonDocent)
                        @if($nonDocent->position === 'admin')
                            <option value="{{ $nonDocent->id }}">Administrador</option>
                        @elseif($nonDocent->position === 'tecnico')
                            <option value="{{ $nonDocent->id }}">Técnico</option>
                        @else
                            <option value="{{ $nonDocent->id }}">{{ $nonDocent->position }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <table class="table bg-white">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Entregue</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody class="customTableStyling mb-2">
                @foreach($nonDocents as $nonDocent)
                    <tr class="filler" onclick="location.href='{{ route('material-clothing-delivery.create', $nonDocent->id) }}'">
                        <td>{{$nonDocent->name}}</td>
                        <td>{{$nonDocent->username}}</td>
                        <td>{{$nonDocent->email}}</td>
                        <td><input type="checkbox" class="no-propagate"></td>
                        <td>
                            <a href="{{ route('users.edit', $nonDocent->id) }}" class="mx-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#116fdc" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                            </a>
                        </td>
                    </tr>
                    <tr class="filler"></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.no-propagate');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        });

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
                filterInput(searchTerm);
            });

            filterDropdown.addEventListener('change', function () {
                filterInput();
            });

            function filterInput(searchTerm = null) {
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
            function filterInputNonDocent(searchTerm = null) {
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
