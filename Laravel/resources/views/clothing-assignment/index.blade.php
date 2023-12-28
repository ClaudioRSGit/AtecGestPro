@extends('master.main')

@section('content')
    <div class="container">

        <h1>Vestuário</h1>


        <h5>Nome Completo</h5>
        <div class="input-group mb-3" style="width: 60%;">
            <input type="text" class="form-control" id="userToAssignClothing" placeholder="{{ $name }}"
                aria-label="Username" aria-describedby="basic-addon1" disabled="disabled">
        </div>


        <div class="mb-3">
            <div class="d-flex w-100">
                <div class="d-flex w-75" style="gap: 1rem">
                    <input type="text" id="search" class="form-control w-50" placeholder="Pesquisar">

                    <select class="form-control w-25" id="filter">
                        <option value="all">Todos</option>
                        <option value="trainer">Formador</option>
                        <option value="trainee">Formando</option>
                        <option value="technical">Técnico </option>
                    </select>
                </div>

                <div class="buttons" style="width: 25%">
                    <a href="{{ route('clothing-assignment.create') }}" class="btn btn-primary">Novo Vestuário</a>
                </div>
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
                    <tr class="filler"></tr>
                    @foreach ($clothing_assignment as $clothing_assignment)
                        <tr class="material-row customTableStyling" data-trainer="{{ $clothing_assignment->role == 2 ? 1 : 0 }}"
                            data-trainee="{{ $clothing_assignment->role == 3 ? 1 : 0 }}"
                            data-technical="{{ $clothing_assignment->role == 4 ? 1 : 0 }}"
                            onclick="location.href='{{ route('materials.show', $clothing_assignment->id) }}'">
                            <td>
                                    <input name="selectedClothing[]" type="checkbox" class="no-propagate" value="{{ $clothing_assignment->id }}"
                                        id="flexCheckDefault">
                            </td>
                            <td>
                                {{ isset($clothing_assignment->name) ? $clothing_assignment->name : 'N.A.' }}
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
                            <td style="text-align: center;">
                                {{ isset($clothing_assignment->size) ? $clothing_assignment->size : 'N.A.' }}</td>

                            <td style="text-align: center;">
                                {{ isset($clothing_assignment->role) ? $clothing_assignment->role : 'N.A.' }}</td>
                            <td style="text-align: center;">
                                {{ isset($clothing_assignment->quantity) ? $clothing_assignment->quantity : 'N.A.' }}
                            </td>
                            <td>
                                <a href="{{ route('clothing-assignment.edit', $clothing_assignment->id) }}"
                                    class="btn btn-warning btn-edit">Editar</a>
                                <form method="post"
                                    action="{{ route('clothing-assignment.destroy', $clothing_assignment->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>

                                </form>
                            </td>
                        </tr>
                        <tr class="filler"></tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <h5>Observações </h5>
        <div class="notes d-flex">

            <textarea class="form-control" id="textarea" aria-label="With textarea"></textarea>
            <div class="mb-3 buttons">

                <div>
                    <button class="btn btn-danger" type="button" id="apagarOnClick">Apagar</button>

                    <!-- .............ooooooooooooooooooooooooooooooo -->


                    <button class="btn btn-primary" type="submit">Guardar</button>




                    <button class="btn btn-primary" type="button" onclick="window.location.href='{{ url()->previous() }}'">Fechar</button>
                </div>
            </div>
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

        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.form-check-input');
            const searchInput = document.getElementById('search');
            const filterDropdown = document.getElementById('filter');

           //     //testettttttttttt


            document.getElementById('apagarOnClick').addEventListener('click', function() {

                document.getElementById('textarea').value = '';


                const checkboxes = document.querySelectorAll('.form-check-input');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });


                document.getElementById('select-all').checked = false;
            });


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
@endsection
