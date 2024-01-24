@extends('master.main')

@section('content')
    <div class="container">
        <h1>Vestuário</h1>

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

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
                    <div class="w-40 d-flex justify-content-between align-items-center h-100" style="gap: 1rem">


                        <div class="search-container ">
                            <form action="{{ route('material-user.index') }}" method="GET">
                                <div class="input-group pr-2">
                                    <input type="text" name="searchCourseClass" class="form-control"
                                        placeholder="{{ request('searchCourseClass') ? request('searchCourseClass') : 'Procurar...' }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            Procurar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="w-15">
                            <select class="form-control" id="sort">
                                <option value="az">A-Z</option>
                                <option value="za">Z-A</option>
                            </select>
                        </div>
                    </div>
                    <div class="buttons ">

                        <form id="courseFilterForm" action="{{ route('material-user.index') }}" method="GET">
                            <div class="w-50">
                                <select class="form-control" id="courseFilter" name="courseFilter" onchange="submitForm()">
                                    <option value="" {{ request('courseFilter') === '' ? 'selected' : '' }}>Todos
                                    </option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ request('courseFilter') == $course->id ? 'selected' : '' }}>
                                            {{ $course->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <a href="{{ route('course-classes.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                <path fill="#fff"
                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                            </svg>
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
                            <div class="card-header bg-white" id="heading{{ $courseClass->id }}">
                                <h2 class="mb-0">
                                    <input type="checkbox" class="accordion-checkbox"
                                        data-course="{{ $courseClass->course_id }}" data-id="{{ $courseClass->id }}">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapse{{ $courseClass->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $courseClass->id }}">
                                        {{ $courseClass->description }}
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse{{ $courseClass->id }}" class="collapse"
                                aria-labelledby="heading{{ $courseClass->id }}" data-parent="#accordion">
                                <div class="card-body">
                                    @if ($courseClass->students->count() > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Editar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="filler"></tr>
                                                @foreach ($courseClass->students as $student)
                                                    <tr class="customTableStyling"
                                                        onclick="location.href='{{ route('material-user.create', $student->id) }}'">
                                                        @php
                                                            $myVariable = $usersWithMaterialsDelivered->contains($student->id) ? 'text-primary' : '';
                                                        @endphp
                                                        <td>{{ $student->name }}</a></td>
                                                        <td>{{ $student->username }}</td>
                                                        <td>{{ $student->email }}</td>
                                                        <td class="editDelete">
                                                            <div style="width: 40%">
                                                                <a href="{{ route('material-user.edit', $student->id) }}"
                                                                    class="mx-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16"
                                                                        width="16" viewBox="0 0 512 512">
                                                                        <path fill="#116fdc"
                                                                            d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <div style="width: 40%">
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
                <div class="w-100 d-flex justify-content-between align-items-center mb-3" style="gap: 1rem">

                    <form action="{{ route('material-user.index') }}" method="GET">
                        <div class="input-group pr-2">
                            <input type="text" name="searchNonDocent" class="form-control"
                                placeholder="{{ request('searchNonDocent') ? request('searchNonDocent') : 'Procurar...' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary">
                                    Procurar
                                </button>
                            </div>
                        </div>
                    </form>


                    <form id="roleFilterForm" action="{{ route('material-user.index') }}" method="GET">
                        <div>
                            <select class="form-control" id="roleFilter" name="roleFilter" onchange="submitFormRoles()">
                                <option value="">Todos</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ request('roleFilter') == $role->id ? 'selected' : '' }}>
                                        {{ $role->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody class="customTableStyling">
                        @foreach ($nonDocents as $nonDocent)
                            <tr class="filler"
                                onclick="location.href='{{ route('material-user.create', $nonDocent->id) }}'">
                                <td >{{ $nonDocent->name }}</td>
                                <td>{{ $nonDocent->username }}</td>
                                <td>{{ $nonDocent->email }}</td>
                                <td>
                                    <a href="{{ route('material-user.edit', $nonDocent->id) }}" class="mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                            viewBox="0 0 512 512">
                                            <path fill="#116fdc"
                                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <tr class="filler"></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        //logica filtro roles
        function submitFormRoles() {
            let roleFilterValue = document.getElementById("roleFilter").value;
            document.getElementById("roleFilterForm").submit();
        }
    </script>

    <script>
        //logica filtro curso
        function submitForm() {
            let courseFilterValue = document.getElementById("courseFilter").value;

            document.getElementById("courseFilterForm").submit();
        }
    </script>

    <script>
        //save tab in localstorage
        $(document).ready(function() {
            let activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#myTabs a[href="' + activeTab + '"]').tab('show');
            }

            $('a[data-toggle="tab"]').on('click', function(e) {
                localStorage.setItem('activeTab', $(this).attr('href'));
            });
        });
    </script>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.no-propagate');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.accordion-checkbox');
            const sortDropdown = document.getElementById('sort');

            sortDropdown.addEventListener('change', function() {
                sortMaterials();
            });

            function sortMaterials() {
                const sortValue = sortDropdown.value;
                const materialCards = Array.from(document.querySelectorAll('.card'));
                const fillerCards = Array.from(document.querySelectorAll(
                    '.fillerCard'));

                materialCards.sort((a, b) => {
                    const aName = a.querySelector('button').textContent.toLowerCase();
                    const bName = b.querySelector('button').textContent.toLowerCase();

                    if (sortValue === 'az') {
                        return aName.localeCompare(bName);
                    } else {
                        return bName.localeCompare(aName);
                    }
                });

                const accordion = document.querySelector('#accordion');
                materialCards.forEach((card, index) => {
                    accordion.appendChild(card);
                    if (fillerCards[index]) {
                        accordion.appendChild(fillerCards[index]);
                    }
                });
            }


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


            setTimeout(function() {
                $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 2000);
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
