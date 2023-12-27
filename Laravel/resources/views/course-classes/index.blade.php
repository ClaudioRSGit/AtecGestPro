@extends('master.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@section('content')
    <style>
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
    <div class="container">
        <h1>Turmas</h1>

        <div class="d-flex justify-content-between mb-3">
            <div class="form-inline">
                <div style="form-group">
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar Turma">
                </div>
                <div class="form-group">
                    <label for="filter"></label>
                    <select class="form-control" id="filter">
                        <option value="all">Todos</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <button class="btn btn-danger" id="delete-selected">Excluir Selecionados</button>
                <a href="{{ route('course-classes.create') }}" class="btn btn-primary">
                    <img src="{{ asset('assets/new.svg') }}">
                    Criar Turma
                </a>
            </div>

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
                            <input type="checkbox" name="selectedCourseClass[]" class="accordion-checkbox"
                                data-course="{{ $courseClass->course_id }}" data-id="{{ $courseClass->id }}" value="{{$courseClass->id}}">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapse{{ $courseClass->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $courseClass->id }}">
                                {{ $courseClass->description }}
                            </button>
                        </h2>
                        <div>
                            <a href="{{ route('course-classes.edit', $courseClass->id) }}">
                                <img src="{{ asset('assets/edit.svg') }}" alt="edit">
                            </a>

                            <a href="{{ route('course-classes.show', $courseClass->id) }}" class="mx-2">
                                <img src="{{ asset('assets/show.svg') }}" alt="edit">
                            </a>
                            <form method="POST" action="{{ route('course-classes.destroy', $courseClass->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                    <img src="{{ asset('assets/delete.svg') }}" alt="delete">
                                </button>
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
            const deleteSelectedButton = document.getElementById('delete-selected');

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

            deleteSelectedButton.addEventListener('click', function() {
                const selectedCourseClass = Array.from(document.querySelectorAll(
                        'input[name="selectedCourseClass[]"]:checked'))
                    .map(checkbox => checkbox.value);
                if (selectedCourseClass.length > 0 && confirm(
                        'Tem certeza que deseja excluir as turmas selecionadas?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('course-classes.massDelete') }}';
                    form.style.display = 'none';
                    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                    selectedCourseClass.forEach(courseClassId => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'course_class_ids[]';
                        input.value = courseClassId;
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


        });
    </script>
@endsection
