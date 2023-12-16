@extends('master.main')

@section('content')
    <div class="container p-5">
        <h1>Vestuário</h1>


            <h5>Nome Completo</h5>
            <div class="input-group mb-3" style="width: 60%;">
                <input type="text" class="form-control" placeholder="Coelho Cenouras" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <button class="btn btn-warning" type="button">Editar</button>
                </div>
            </div>


        <div class="mb-3">
            <div class="d-flex">
                <div style="width: 30%;">
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar">
                </div>
                 <!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
                <div class="ms-2">
                    <label for="filter">Filtrar por:</label>
                    <select class="form-select" id="filter">
                        <option value="all">Todos</option>
                        <option value="internal">Formador</option>
                        <option value="clothing">Formando</option>
                        <option value="external">Técnico </option>
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
                    @foreach($clothing as $clothing)
                        <!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
                        <tr class="material-row" data-internal="{{ $clothing->isInternal }}" data-clothing="{{ $clothing->isClothing }}">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $clothing->id }}" id="flexCheckDefault">

                                </div>
                            </td>
                            <td>
                                <a href="{{ route('materials.show', $clothing->id) }}">{{ isset($clothing->name) ? $clothing->name : 'N.A.' }}</a>
                            </td>
                            <td>
                                @if(isset($clothing->gender))
                                    @if($clothing->gender == 1)
                                        Masculino
                                    @elseif($clothing->gender == 0)
                                        Feminino
                                    @endif
                                @else
                                    N.A.
                                @endif
                            </td>
                            <td style="text-align: center;">{{ isset($clothing->size) ? $clothing->size : 'N.A.' }}</td>
                            <td style="text-align: center;">{{ isset($clothing->role) ? $clothing->role : 'N.A.' }}</td>
                            <td style="text-align: center;">{{ isset($clothing->quantity) ? $clothing->quantity : 'N.A.' }}</td>
                            <td>
                                <a href="{{ route('clothing.edit', $clothing->id) }}" class="btn btn-warning btn-edit">Editar</a>
                                <form method="post" action="{{ route('clothing.destroy', $clothing->id) }}" style="display:inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>

                                </form>
                            </td>
                        </tr>


                    @endforeach
                </tbody>
            </table>
        </form>

        <h5>Observações </h5>
        <div class="input-group mb-3" style="width: 80%;">
            <textarea class="form-control" aria-label="With textarea"></textarea>
            <div class="input-group-prepend">
                <button class="btn btn-danger" type="button">Apagar</button>
                <button class="btn btn-primary" type="button">Guardar</button>
                <button class="btn btn-primary" type="button">Fechar</button>
            </div>
        </div>

    </div>


    <script>
        //VER PROJECTO C# SOBRE FILTROS E PESQUISAS
        // <!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="selectedClothing[]"]');
            const searchInput = document.getElementById('search');
            const filterDropdown = document.getElementById('filter');

                // <!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
            // <!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll('input[name="selectedClothing[]"]:checked').length;
                });
            });
            // <!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();
                filterMaterials(searchTerm);
            });
            // <!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
            filterDropdown.addEventListener('change', function () {
                filterMaterials();
            });
            //<!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
            function filterMaterials(searchTerm = null) {
                checkboxes.forEach(checkbox => {
                    const materialRow = checkbox.closest('.material-row');
                    const isInternal = materialRow.getAttribute('data-internal') === '1';
                    const isClothing = materialRow.getAttribute('data-clothing') === '1';

                    const filterValue = filterDropdown.value;
                    //<!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
                    const matchesFilter = (
                        (filterValue === 'all') ||
                        (filterValue === 'internal' && isInternal) ||
                        (filterValue === 'clothing' && isClothing) ||
                        (filterValue === 'external' && !isInternal && !isClothing)
                    );
                    // <!-- REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOOOOOOOOOOOOOOOO-->
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
