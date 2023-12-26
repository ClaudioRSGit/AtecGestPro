@extends('master.main')

@section('content')
    <div class="container pl-5 pt-4">
        <h1>Lista de Materiais</h1>

        <div class="d-flex justify-content-between mb-3">
            <form class="form-inline" id="filterForm">
                <div class="form-group mr-3" style="width: 30%;">
                    <input type="text" id="search" class="form-control" placeholder="Pesquisar Material">
                </div>

                <div class="form-group mx-5">
                    <label for="filter"></label>
                    <select class="form-control" id="filter">
                        <option value="all">Todos</option>
                        <option value="internal">Interno</option>
                        <option value="clothing">Fardamento</option>
                        <option value="external">Externo</option>
                    </select>
                </div>
            </form>
            <button class="btn btn-danger" id="delete-selected">Excluir Selecionados</button>
            <a href="{{ route('materials.create') }}" class="btn btn-primary">Novo Material</a>
        </div>



        <form method="post">
            @csrf
            @method('delete')

            <table class="table bg-white rounded-top">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Data de Aquisição</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Género</th>
                        <th scope="col">Tamanho</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                        <tr class="material-row" data-internal="{{ $material->isInternal }}" data-clothing="{{ $material->isClothing }}">
                            <td>
                                <input type="checkbox" name="selectedMaterials[]" value="{{ $material->id }}">
                            </td>
                            <td>
                                <a href="{{ route('materials.show', $material->id) }}">{{ isset($material->name) ? $material->name : 'N.A.' }}</a>
                            </td>
                            <td>{{ isset($material->quantity) ? $material->quantity : 'N.A.' }}</td>
                            <td>{{ isset($material->aquisition_date) ? $material->aquisition_date : 'N.A.' }}</td>
                            <td>{{ isset($material->supplier) ? $material->supplier : 'N.A.' }}</td>
                            <td>
                                @if(isset($material->gender))
                                    @if($material->gender == 1)
                                        Masculino
                                    @elseif($material->gender == 0)
                                        Feminino
                                    @endif
                                @else
                                    N.A.
                                @endif
                            </td>
                            <td>{{ isset($material->size) ? $material->size : 'N.A.' }}</td>
                            <td>
                                <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning btn-edit">Editar</a>
                                <form method="post" action="{{ route('materials.destroy', $material->id) }}" style="display:inline;">
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
        {{ $materials->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');
            const searchInput = document.getElementById('search');
            const filterDropdown = document.getElementById('filter');
            const deleteSelectedButton = document.getElementById('delete-selected');

            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll('input[name="selectedMaterials[]"]:checked').length;
                });
            });

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();
                filterMaterials(searchTerm);
            });

            filterDropdown.addEventListener('change', function () {
                filterMaterials();
            });

            function filterMaterials(searchTerm = null) {
                checkboxes.forEach(checkbox => {
                    const materialRow = checkbox.closest('.material-row');
                    const isInternal = materialRow.getAttribute('data-internal') === '1';
                    const isClothing = materialRow.getAttribute('data-clothing') === '1';

                    const filterValue = filterDropdown.value;

                    const matchesFilter = (
                        (filterValue === 'all') ||
                        (filterValue === 'internal' && isInternal) ||
                        (filterValue === 'clothing' && isClothing) ||
                        (filterValue === 'external' && !isInternal && !isClothing)
                    );

                    const matchesSearch = !searchTerm || (
                        materialRow.textContent.toLowerCase().includes(searchTerm) ||
                        materialRow.querySelector('a').textContent.toLowerCase().includes(searchTerm)
                    );

                    checkbox.closest('tr').style.display = matchesFilter && matchesSearch ? '' : 'none';
                });
            }
        });

        deleteSelectedButton.addEventListener('click', function () {
            const selectedMaterials = Array.from(document.querySelectorAll('input[name="selectedMaterials[]"]:checked'))
                .map(checkbox => checkbox.value);
            if (selectedMaterials.length > 0 && confirm('Tem certeza que deseja excluir os materiais selecionados?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('materials.massDelete') }}';
                form.style.display = 'none';
                const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                selectedMaterials.forEach(materialId => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'material_ids[]';
                    input.value = materialId;
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
    </script>
@endsection
