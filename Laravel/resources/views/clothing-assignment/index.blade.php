@extends('master.main')

@section('content')
    <div class="container pl-5 pt-4">

        <h1>Vestuário</h1>


        <h5>Nome Completo</h5>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="userToAssignClothing" placeholder="{{ $name }}" aria-label="Username"
                aria-describedby="basic-addon1" disabled="disabled">
            <div class="input-group-prepend">
            </div>
        </div>


        <div class="d-flex justify-content-between mb-3">
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar Vestuário" >
                </div>

                <div class="form-group mx-3">
                    <label for="filter">Filtrar por:</label>
                    <select class="form-control mx-3" id="filter">
                        <option value="all">Todos</option>
                        <option value="trainer">Formador</option>
                        <option value="trainee">Formando</option>
                        <option value="technical">Técnico </option>
                    </select>
                </div>


                <a href="{{ route('clothing-assignment.create') }}" class="btn btn-primary">Novo Vestuário</a>
            </div>
        </div>


        <div>
            <table class="table bg-white">
                <thead>
                    <tr>
                        <th scope="col"> <input type="checkbox" id="select-all"> </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Género</th>
                        <th scope="col" style="text-align: center;">Tamanho</th>
                        <th scope="col" style="text-align: center;">Função</th>
                        <th scope="col" style="text-align: center;">Quantidade</th>
                        <th scope="col" style="text-align: center;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clothing_assignment as $clothing_assignment)

                        <tr class="material-row" data-trainer="{{ $clothing_assignment->role == 2 ? 1 : 0 }}"
                            data-trainee="{{ $clothing_assignment->role == 3 ? 1 : 0 }}"
                            data-technical="{{ $clothing_assignment->role == 4 ? 1 : 0 }}">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $clothing_assignment->id }}"
                                        id="flexCheckDefault">

                                </div>
                            </td>
                            <td>
                                <a
                                    href="{{ route('materials.show', $clothing_assignment->id) }}">{{ isset($clothing_assignment->name) ? $clothing_assignment->name : 'N.A.' }}</a>
                            </td>
                            <td>
                                @if (isset($clothing_assignment->gender))
                                    @if ($clothing_assignment->gender == 1)
                                        Masculino
                                    @elseif($clothing_assignment->gender == 0)
                                        Feminino
                                    @endif
                                @else
                                    N.A.
                                @endif
                            </td>
                            <td style="text-align: center;">{{ isset($clothing_assignment->size) ? $clothing_assignment->size : 'N.A.' }}</td>
                            <td style="text-align: center;">{{ isset($clothing_assignment->role) ? $clothing_assignment->role : 'N.A.' }}</td>
                            <td style="text-align: center;">{{ isset($clothing_assignment->quantity) ? $clothing_assignment->quantity : 'N.A.' }}
                            </td>
                            <td>
                                <a href="{{ route('clothing-assignment.edit', $clothing_assignment->id) }}"
                                    class="btn btn-warning btn-edit">Editar</a>

                                <form method="post" action="{{ route('clothing-assignment.destroy', $clothing_assignment->id) }}" style="display:inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h5>Observações </h5>
        <div class="input-group mb-3">
            <textarea class="form-control" id="textarea" aria-label="With textarea"></textarea>
        </div>
        <div class="d-flex flex-row-reverse">
            <div class="input-group-prepend">
                <button class="btn btn-danger mx-1" type="button" onclick="location.reload()">Apagar</button>
                <button class="btn btn-primary mx-1" type="button">Guardar</button>
                <button class="btn btn-primary mx-1" type="button" onclick="window.location.href='{{ url()->previous() }}'">Fechar</button>
            </div>
        </div>

    </div>


    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.form-check-input');
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
                        'input[name="selectedClothing[]"]:checked').length;
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
                checkboxes.forEach(checkbox => {
                    const materialRow = checkbox.closest('.material-row');
                    const isTrainer = materialRow.getAttribute('data-trainer') === '1';
                    const isTrainee = materialRow.getAttribute('data-trainee') === '1';
                    const isTechnical = materialRow.getAttribute('data-technical') === '1';


                    const filterValue = filterDropdown.value;

                    const matchesFilter = (
                        (filterValue === 'all') ||
                        (filterValue === 'trainer' && isTrainer) ||
                        (filterValue === 'trainee' && isTrainee) ||
                        (filterValue === 'technical' && isTechnical)

                    );

                    const matchesSearch = !searchTerm || (
                        materialRow.textContent.toLowerCase().includes(searchTerm) ||
                        materialRow.querySelector('a').textContent.toLowerCase().includes(searchTerm)
                    );

                    checkbox.closest('tr').style.display = matchesFilter && matchesSearch ? '' : 'none';
                });
            }
        });
    </script>
    <style>
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
    </style>
@endsection
