@extends('master.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@section('content')
    <div class="container  w-100 fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Turmas</h1>
            <a href="{{ route('course-classes.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-pen mr-1" style="color: #ffffff;"></i>
                Criar Turma
            </a>
        </div>
        @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($errorMessage))
            <div class="alert alert-danger">{{ $errorMessage }}</div>
        @endif

        <div class="d-flex justify-content-between mb-3">

            <div class="search-container">
                <form action="{{ route('course-classes.index') }}" method="GET">
                    <div class="input-group pr-2">
                        <div class="search-container">
                            <input type="text" name="courseClassSearch" class="form-control "
                            placeholder="{{ request('courseClassSearch') ? request('courseClassSearch') : 'Procurar...' }}">
                        </div>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary">
                                Procurar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="drop">
                <form id="courseFilterForm" action="{{ route('course-classes.index') }}" method="GET">
                        <select class="form-control " id="courseFilter" name="courseFilter" onchange="submitForm()">
                            <option value="all">Todos os cursos</option>
                            @foreach($courses as $course)
                                <option
                                    value="{{ $course->id }}" {{ $courseFilter == $course->id ? 'selected' : '' }}>{{ $course->description }}</option>
                            @endforeach
                        </select>
                </form>
            </div>



        </div>


        <div id="accordion">
            <div class="ms-auto">

                <span>&nbsp; &nbsp;Turma</span>
            </div>
            @foreach ($courseClasses as $courseClass)
                <div class="card mb-2 mt-2">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center"
                         id="heading{{ $courseClass->id }}">
                        <h2 class="mb-0">

                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapse{{ $courseClass->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $courseClass->id }}">
                                {{ $courseClass->description }}
                            </button>
                        </h2>
                        <div class="editDelete d-flex justify-content-center" style="gap: 3%; width: 10%">
                            <div class="d-flex justify-content-center align-items-center" style="width: 30%">
                                <a href="{{ route('course-classes.edit', $courseClass->id) }}">
                                    <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center align-items-center" style="width: 30%">
                                <a href="{{ route('course-classes.show', $courseClass->id) }}">
                                    <i class="fa-regular fa-eye fa-lg" style="color: #116fdc;"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="width: 30%">
                                <form method="POST" action="{{ route('course-classes.destroy', $courseClass->id) }}"
                                      style="display: inline; margin: 0 !important">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="modalBtn" data-message="Tem a certeza que deseja eliminar a turma {{ $courseClass->description }}?"
                                            style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                            <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="collapse{{ $courseClass->id }}" class="collapse"
                         aria-labelledby="heading{{ $courseClass->id }}" data-parent="#accordion">
                        <div class="card-body">
                            @if ($courseClass->users->count() > 0)
                                <ul>
                                    @foreach ($courseClass->users as $student)
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
            let deleteButtons = document.querySelectorAll('button[class="modalBtn"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    let message = button.getAttribute('data-message');
                    document.getElementById('modalBody').textContent = message;

                    $('#deleteModal').modal('show');

                    $('#deleteBtn').click(function () {
                        button.closest('form').submit();
                    });
                });
            });
        });
    </script>


    <script>
        //logica filtro
        function submitForm() {
            document.getElementById("courseFilterForm").submit();
        }
    </script>

    <script>

        window.setTimeout(function () {
            $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2000);
    </script>
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

        .search-container {
            position: relative;
            width: 49%;
        }

        .search-container input {
            padding-left: 40px;
        }

        .search-container:before {
            content: "";
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-image: url('assets/search.svg');
            background-size: cover;
        }

        .buttons{
            height: calc(1.6em + 0.75rem + 2px);
        }
    </style>
@endsection
