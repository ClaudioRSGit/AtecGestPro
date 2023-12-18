@extends('master.main')
<<<<<<< HEAD
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap">

@section('content')
<style>
    body {
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
    <div class="container pl-5 pt-4">
        <h1 class="font-weight-bold">Vestuário</h1>
        <div class="d-flex justify-content-between mb-3">
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar Turma">
                </div>
                <div class="form-group mx-2">
                    <label for="filter"></label>
                    <select class="form-control" id="filter">
                        <option value="all">Todos</option>
                        @foreach($courses as $course)
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
                            <table class="table table-bordered">
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
                                    @foreach($courseClass->students as $student)
                                        <tr>

                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->username }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td><input type="checkbox"></td>
                                            <td>
                                                <a href="{{ route('users.show', $student->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('users.edit', $student->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                <form method="POST" action="{{ route('users.destroy', $student->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
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
=======

@section('content')
    <div class="container p-5">
        <h1>Vestuário</h1>


        <h5>Nome Completo</h5>
        <div class="input-group mb-3" style="width: 60%;">
            <input type="text" class="form-control" id="userToAssignClothing" placeholder="" aria-label="Username"
                aria-describedby="basic-addon1" disabled="disabled">
            <div class="input-group-prepend">
                <!-- replace the materials.index for the route to user.edit or student.edit with the user id-->
                <button class="btn btn-warning" id="EditInput" type="button" onclick="window.location.href='{{ route('materials.index') }}'">Editar</button>
            </div>
        </div>


        <div class="mb-3">
            <div class="d-flex">
                <div style="width: 30%;">
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar" >
                </div>

                <div class="ms-2">
                    <label for="filter">Filtrar por:</label>
                    <select class="form-select" id="filter">
                        <option value="all">Todos</option>
                        <option value="trainer">Formador</option>
                        <option value="trainee">Formando</option>
                        <option value="technical">Técnico </option>
                    </select>
                </div>

                <a href="{{ route('clothing.create') }}" class="btn btn-primary mb-3">Novo Vestuário</a>

            </div>
        </div>


        <form method="post">


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Género</th>
                        <th scope="col" style="text-align: center;">Tamanho</th>
                        <th scope="col" style="text-align: center;">Função</th>
                        <th scope="col" style="text-align: center;">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clothing as $clothing)

                        <tr class="material-row" data-trainer="{{ $clothing->role == 2 ? 1 : 0 }}"
                            data-trainee="{{ $clothing->role == 3 ? 1 : 0 }}"
                            data-technical="{{ $clothing->role == 4 ? 1 : 0 }}">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $clothing->id }}"
                                        id="flexCheckDefault">

                                </div>
                            </td>
                            <td>
                                <a
                                    href="{{ route('materials.show', $clothing->id) }}">{{ isset($clothing->name) ? $clothing->name : 'N.A.' }}</a>
                            </td>
                            <td>
                                @if (isset($clothing->gender))
                                    @if ($clothing->gender == 1)
                                        Masculino
                                    @elseif($clothing->gender == 0)
                                        Feminino
                                    @endif
                                @else
                                    N.A.
                                @endif
                            </td>
                            <td style="text-align: center;">{{ isset($clothing->size) ? $clothing->size : 'N.A.' }}</td>
                            <!-- usar if ou swit para substituir o numero do role pelo nome -->
                            <td style="text-align: center;">{{ isset($clothing->role) ? $clothing->role : 'N.A.' }}</td>
                            <td style="text-align: center;">{{ isset($clothing->quantity) ? $clothing->quantity : 'N.A.' }}
                            </td>
                            <td>
                                <a href="{{ route('clothing.edit', $clothing->id) }}"
                                    class="btn btn-warning btn-edit">Editar</a>
                                <form method="post" action="{{ route('clothing.destroy', $clothing->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir?')"
                                        >Excluir</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <h5>Observações </h5>
        <div class="input-group mb-3" style="width: 80%;">
            <textarea class="form-control" id="textarea" aria-label="With textarea"></textarea>
            <div class="input-group-prepend">
                <button class="btn btn-danger" type="button" onclick="location.reload()">Apagar</button>

                <!-- I intend to meet with Claudio to discuss how we are going to deal with this Save part -->

                <button class="btn btn-primary" type="button">Guardar</button>

                <!-- replace the clothing.index for the route back to turmas or wherever -->
                <button class="btn btn-primary" type="button" onclick="window.location.href='{{ route('clothing.index') }}'">Fechar</button>
            </div>
        </div>

    </div>


    <script>

        // array only  for testing, substitute later for the value from ClassCourse or CourseClass
        let users = [{
                id: 1,
                name: 'Coelho Cenoura',
                role: 3
            },
            {
                id: 2,
                name: 'Not Your Mother',
                role: 2
            },
            {
                id: 3,
                name: 'Pipa Pepino',
                role: 4
            }
        ];

        //Get the user name and show in the "Nome Completo"
        let inputElement = document.querySelector('#userToAssignClothing');
        inputElement.placeholder = users[2].name;



        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.form-check-input');
            const searchInput = document.getElementById('search');
            const filterDropdown = document.getElementById('filter');


            selectAllCheckbox.addEventListener('change', function() {
>>>>>>> b3744e6e42f855e008273c9b3607f62106dd5785
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
<<<<<<< HEAD
                checkbox.addEventListener('change', function () {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll('.accordion-checkbox:checked').length;
                });
            });

            searchInput.addEventListener('input', function () {
=======
                checkbox.addEventListener('change', function() {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                        'input[name="selectedClothing[]"]:checked').length;
                });
            });

            searchInput.addEventListener('input', function() {
>>>>>>> b3744e6e42f855e008273c9b3607f62106dd5785
                const searchTerm = searchInput.value.toLowerCase();
                filterMaterials(searchTerm);
            });

<<<<<<< HEAD
            filterDropdown.addEventListener('change', function () {
=======
            filterDropdown.addEventListener('change', function() {
>>>>>>> b3744e6e42f855e008273c9b3607f62106dd5785
                filterMaterials();
            });

            function filterMaterials(searchTerm = null) {
<<<<<<< HEAD
                const courseClassCards = document.querySelectorAll('.card');

                courseClassCards.forEach(card => {
                    const courseId = card.querySelector('.accordion-checkbox').getAttribute('data-course');
=======
                checkboxes.forEach(checkbox => {
                    const materialRow = checkbox.closest('.material-row');
                    const isTrainer = materialRow.getAttribute('data-trainer') === '1';
                    const isTrainee = materialRow.getAttribute('data-trainee') === '1';
                    const isTechnical = materialRow.getAttribute('data-technical') === '1';


>>>>>>> b3744e6e42f855e008273c9b3607f62106dd5785
                    const filterValue = filterDropdown.value;

                    const matchesFilter = (
                        (filterValue === 'all') ||
<<<<<<< HEAD
                        (filterValue === courseId)
                    );

                    const matchesSearch = !searchTerm || (
                        card.textContent.toLowerCase().includes(searchTerm) ||
                        card.querySelector('button').textContent.toLowerCase().includes(searchTerm)
                    );

                    card.style.display = matchesFilter && matchesSearch ? '' : 'none';
=======
                        (filterValue === 'trainer' && isTrainer) ||
                        (filterValue === 'trainee' && isTrainee) ||
                        (filterValue === 'technical' && isTechnical)

                    );

                    const matchesSearch = !searchTerm || (
                        materialRow.textContent.toLowerCase().includes(searchTerm) ||
                        materialRow.querySelector('a').textContent.toLowerCase().includes(searchTerm)
                    );

                    checkbox.closest('tr').style.display = matchesFilter && matchesSearch ? '' : 'none';
>>>>>>> b3744e6e42f855e008273c9b3607f62106dd5785
                });
            }
        });
    </script>
@endsection
