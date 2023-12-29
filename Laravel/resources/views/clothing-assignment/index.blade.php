@extends('master.main')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Vestuário</h1>

        <h5>Nome do Formando Completo</h5>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="userToAssignClothing" placeholder="{{ $name }}"
                aria-label="Username" aria-describedby="basic-addon1" disabled="disabled">
        </div>

        <div class="mb-3">
            <div class="d-flex w-100 search-container">
                <div class="d-flex w-100">
                    <input type="text" id="search" class="form-control w-50" placeholder="Pesquisar Material">
                </div>
            </div>
        </div>

        <form method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">Nome</th>
                        <th scope="col">Género</th>
                        <th scope="col" style="text-align: center;">Tamanho</th>
                        <th scope="col" style="text-align: center;">Stock</th>
                        <th scope="col" style="text-align: center;">Quantidade a atribuir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="filler"></tr>
                    @foreach ($clothing_assignment as $clothing_assignment)
                        <tr class="material-row customTableStyling"
                            data-trainer="{{ $clothing_assignment->role == 2 ? 1 : 0 }}"
                            data-trainee="{{ $clothing_assignment->role == 3 ? 1 : 0 }}"
                            data-technical="{{ $clothing_assignment->role == 4 ? 1 : 0 }}">
                            <td>
                                    <input name="selectedClothing[]" type="checkbox" class="no-propagate" value="{{ $clothing_assignment->id }}" id="flexCheckDefault">
                            </td>
                            <td>
                                <a onclick="location.href='{{ route('materials.show', $clothing_assignment->id) }}'">{{ isset($clothing_assignment->name) ? $clothing_assignment->name : 'N.A.' }}</a>
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
                                    {{ isset($clothing_assignment->quantity) ? $clothing_assignment->quantity : 'N.A.' }}
                                </td>
                                <td style="text-align: center;" class="no-propagate">
                                    <input type="number" name="quantities[{{ $clothing_assignment->id }}]" value="1" min="1" max="{{$clothing_assignment->quantity}}">
                                </td>
                        </tr>
                        <tr class="filler"></tr>
                    @endforeach
                </tbody>
            </table>
            <h5>Observações </h5>
            <div class="notes d-flex">
                <textarea class="form-control" id="textarea" aria-label="With textarea"></textarea>
                <button class="btn btn-danger" type="button" id="apagarOnClick">Apagar</button>
                <button class="btn btn-primary" id="Assigment" type="button" onclick="window.location.href='{{ route('material-clothing-delivery.create', $student->id) }}'">
                    Atribuir
                </button>
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-primary" type="button" onclick="window.location.href='{{ url()->previous() }}'">Fechar</button>
            </div>
        </form>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.no-propagate');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
            });
        });

        const deleteButton = document.getElementById('apagarOnClick');
        deleteButton.addEventListener('click', function() {
            document.getElementById('textarea').value = '';

            const checkedCheckboxes = document.querySelectorAll('.no-propagate:checked');

            if (checkedCheckboxes.length === 0) {
                alert('Selecione pelo menos um material para desselecionar.');
            } else {
                checkedCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        });

        const searchInput = document.getElementById('search');

        document.getElementById('apagarOnClick').addEventListener('click', function() {
            document.getElementById('textarea').value = '';

            const checkboxes = document.querySelectorAll('.no-propagate');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        });

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            filterMaterials(searchTerm);
        });

            function filterMaterials(searchTerm = null) {
                checkboxes.forEach(checkbox => {
                    const materialRow = checkbox.closest('.material-row');
                    const isTrainer = materialRow.getAttribute('data-trainer') === '1';
                    const isTrainee = materialRow.getAttribute('data-trainee') === '1';
                    const isTechnical = materialRow.getAttribute('data-technical') === '1';

                    const matchesSearch = !searchTerm || (
                        materialRow.textContent.toLowerCase().includes(searchTerm) ||
                        materialRow.querySelector('a').textContent.toLowerCase().includes(searchTerm)
                    );

                    checkbox.closest('tr').style.display = matchesSearch ? '' : 'none';
                });
            }
        });
    </script>
@endsection
