@extends('master.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@section('content')
    <style>
        .container {
            font-family: 'Manrope', sans-serif;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 1%;
            right: 0%;
            bottom: 0%;
            left: 50%;
            position: fixed;
            background-image: radial-gradient(circle, rgba(17, 111, 220, 0.1), rgba(120, 143, 228, 0.2), rgba(173, 177, 237, 0.1), rgba(217, 215, 246, 0), rgba(255, 255, 255, 0.1));
            z-index: -1;
        }

        #accordion .card {
            border: none;
        }

        #accordion .card-header {
            border-bottom: none;
        }

        #accordion .card-body {
            border-top: 12px solid #fff;
        }
    </style>
    <div class="container  pl-5 pt-4">
        <h1>Turmas</h1>

        <div class="d-flex justify-content-between mb-3">
            <div class="form-inline">
                <div style="form-group">
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar Turma">
                </div>
                <div class="form-group mx-2">
                    <label for="filter"></label>
                    <select class="form-control" id="filter">
                        <option value="all">Todos</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <a href="{{ route('course-classes.create') }}" class="btn btn-primary">Criar Turma</a>
        </div>

        <div id="accordion">
            <div class="ms-auto">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="select-all">
                <label for="select-all"></label>
                <span>&nbsp; &nbsp;Turma</span>
            </div>
            @foreach ($courseClasses as $courseClass)
                <div class="card mb-2 mt-2">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center"
                        id="heading{{ $courseClass->id }}">
                        <h2 class="mb-0">
                            <input type="checkbox" class="accordion-checkbox" data-course="{{ $courseClass->course_id }}"
                                data-id="{{ $courseClass->id }}">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapse{{ $courseClass->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $courseClass->id }}">
                                {{ $courseClass->description }}
                            </button>
                        </h2>
                        <div>
                            <a href="{{ route('course-classes.edit', $courseClass->id) }}" class="btn btn-info btn-sm"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <a href="{{ route('course-classes.show', $courseClass->id) }}"
                                class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                            <form method="POST" action="{{ route('course-classes.destroy', $courseClass->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tem certeza que deseja excluir?')"><i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>

                    <div id="collapse{{ $courseClass->id }}" class="collapse"
                        aria-labelledby="heading{{ $courseClass->id }}" data-parent="#accordion">
                        <div class="card-body">
                            @if ($courseClass->students->count() > 0)
                                <ul>
                                    @foreach ($courseClass->students as $student)
                                        <li>{{ $student->name }}</li>
                                    @endforeach
                                </ul>
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
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.accordion-checkbox');
            const searchInput = document.getElementById('search');
            const filterDropdown = document.getElementById('filter');

            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                        '.accordion-checkbox:checked').length;
                });
            });

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();
                filterMaterials(searchTerm);
            });

            filterDropdown.addEventListener('change', function() {
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
@endsection
