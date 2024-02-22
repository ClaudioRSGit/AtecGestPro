@extends('master.main')

@section('content')
    <div class="container  w-100 fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Vestuário</h1>
            <a href="{{ route('course-classes.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-pen mr-1" style="color: #ffffff;"></i>
                Criar Turma
            </a>
        </div>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

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
                                    <div class="search-container">
                                        <input type="text" name="searchCourseClass" class="form-control"
                                               placeholder="{{ request('searchCourseClass') ? request('searchCourseClass') : 'Procurar...' }}">
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            Procurar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>


                    <form id="courseFilterForm" action="{{ route('material-user.index') }}" method="GET">
                        <select class="form-control" id="courseFilter" name="courseFilter" onchange="submitForm()">
                            <option value="" {{ request('courseFilter') === '' ? 'selected' : '' }}>Todos
                            </option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ request('courseFilter') == $course->id ? 'selected' : '' }}>
                                    {{ $course->description }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div id="accordion">
                    <div class="ms-auto">

                        <span>&nbsp; &nbsp;Turma</span>
                    </div>
                    @foreach ($courseClasses as $courseClass)
                        <div class="card mb-2 mt-2">

                            <div class="card-header ">
                                <h2 class="mb-0">


                                    <button class="btn btn-link "
                                            type="button" data-toggle="collapse" data-target="#collapse{{ $courseClass->id }}"
                                            aria-expanded="false" aria-controls="collapse{{ $courseClass->id }}">
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
                                            <tr >
                                                <th>Nome</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Editar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="filler"></tr>
                                            @foreach ($courseClass->students as $student)
                                                <tr class="customTableStyling {{ $usersWithMaterialsDelivered->contains($student->id) ? 'bg-blue' : '' }}">
                                                    @php
                                                        $myVariable = $usersWithMaterialsDelivered->contains($student->id) ? 'bg-blue' : '';
                                                    @endphp
                                                    <td class="clickable {{ $myVariable }}">
                                                        <a href="{{ route('material-user.create', $student->id) }}"
                                                           class="d-flex align-items-center w-auto h-100">{{ $student->name }}</a>
                                                    </td>
                                                    <td class="{{ $myVariable }}">{{ $student->username }}</td>
                                                    <td class="{{ $myVariable }}">{{ $student->email }}</td>
                                                    <td class="editDelete {{ $myVariable }}">
                                                        <div style="width: 40%">
                                                            <a href="{{ route('material-user.edit', $student->id) }}"
                                                               class="mx-2 ">
                                                               <i class="fa-solid fa-pen-to-square fa-xl" style="color: #116fdc;"></i>
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
                {{ $courseClasses->appends(['cPage' => $courseClasses->currentPage()])->links() }}
            </div>


            <div class="tab-pane fade" id="outros">
                <div class="w-100 d-flex justify-content-between align-items-center mb-3" style="gap: 1rem">

                    <form action="{{ route('material-user.index') }}" method="GET">
                        <div class="input-group pr-2">
                            <div class="search-container">
                                <input type="text" name="searchNonDocent" class="form-control"
                                       placeholder="{{ request('searchNonDocent') ? request('searchNonDocent') : 'Procurar...' }}">
                            </div>
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

                        <tr class="{{ $usersWithMaterialsDelivered->contains($nonDocent->id) ? 'bg-blue' : '' }}">

                            <td class="clickable ">
                                <a href="{{ route('material-user.create', $nonDocent->id) }}"
                                   class="d-flex align-items-center w-auto h-100">{{ $nonDocent->name }}</a>
                            </td>
                            <td class="{{ $myVariable }}">{{ $nonDocent->username }}</td>
                            <td class="{{ $myVariable }}">{{ $nonDocent->email }}</td>
                            <td>
                                <a href="{{ route('material-user.edit', $nonDocent->id) }}" class="mx-2">
                                    <i class="fa-solid fa-pen-to-square fa-xl" style="color: #116fdc;"></i>
                                </a>
                            </td>
                        </tr>
                        <tr class="filler"></tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $nonDocents->appends(['nPage' => $nonDocents->currentPage()])->links() }}
            </div>

        </div>

    </div>

    <script>
        //fade out alert
        setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2000);
    </script>


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
        $(document).ready(function () {
            let activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#myTabs a[href="' + activeTab + '"]').tab('show');
            }

            $('a[data-toggle="tab"]').on('click', function (e) {
                localStorage.setItem('activeTab', $(this).attr('href'));
            });
        });
    </script>


    <style>
        .bg-blue {
            background-color: rgba(54, 162, 235, 0.3);
        }

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
