@extends('master.main')

@section('content')
    <div class="container">
        <h1>Lista de Materiais</h1>

        <div class="d-flex justify-content-between mb-3 w-100">
            <div class="d-flex justify-content-between w-40">

                <form action="{{ route('materials.index') }}" method="GET">
                    <div class="input-group pr-2">
                        <input type="text" name="search" class="form-control" placeholder="{{ request('search') ? request('search') : 'Procurar...' }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary">
                                Procurar
                            </button>
                        </div>
                    </div>
                </form>

                <div class="w-15">
                    <select class="form-control w-100" id="sort">
                        <option value="az">A-Z</option>
                        <option value="za">Z-A</option>
                    </select>
                </div>
            </div>
            <div class="buttons">
                <button class="btn btn-danger" id="delete-selected">Excluir Selecionados</button>



                <form id="materialFilterForm" action="{{ route('materials.index') }}" method="GET">
                    <div>
                        <select class="form-control" id="materialFilter" name="materialFilter" onchange="submitForm()">
                            <option value="all" {{ $materialFilter === 'all' ? 'selected' : '' }}>Todos</option>
                            <option value="internal" {{ $materialFilter === 'internal' ? 'selected' : '' }}>Interno</option>
                            <option value="clothing" {{ $materialFilter === 'clothing' ? 'selected' : '' }}>Fardamento</option>
                            <option value="external" {{ $materialFilter === 'external' ? 'selected' : '' }}>Externo</option>
                        </select>
                    </div>
                </form>



                <a href="{{ route('materials.create') }}" class="btn btn-primary">
                    <img src="{{ asset('assets/new.svg') }}">
                    Novo Material
                </a>
            </div>
        </div>



        <div>
            <table class="table bg-white rounded-top">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Data de Aquisição</th>
                        <th scope="col">Fornecedor</th>
                        <th scope="col">Género</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="filler"></tr>
                    @foreach ($materials as $material)
                        <tr class="material-row customTableStyling" data-internal="{{ $material->isInternal }}"
                            data-clothing="{{ $material->isClothing }}"
                            onclick="location.href='{{ route('materials.show', $material->id) }}'">
                            <td>
                                <input type="checkbox" class="no-propagate" name="selectedMaterials[]"
                                    value="{{ $material->id }}">
                            </td>
                            <td>
                                <a
                                    href="{{ route('materials.show', $material->id) }}">{{ isset($material->name) ? $material->name : 'N.A.' }}</a>
                            </td>
                            <td>
                                @if($material->isClothing == 1)
                                    {{ $material->sizes->sum('pivot.stock') }}
                                @else
                                    {{ isset($material->quantity) ? $material->quantity : 'N.A.' }}
                                @endif
                            </td>

                            <td>
                                {{ isset($material->acquisition_date) ? \Carbon\Carbon::parse($material->acquisition_date)->format('Y-m-d') : 'N.A.' }}
                            </td>


                            <td>{{ $material->supplier !== null ? $material->supplier : 'N.A.' }}</td>

                            <td>
                                @if($material->isClothing == 0)
                                    N.A.
                                @else
                                    @if($material->gender == 1)
                                        Masculino
                                    @elseif($material->gender == 0)
                                        Feminino
                                    @endif
                                @endif

                            </td>

                            <td class="editDelete" style="padding: 0.25rem">
                                <div style="width: 40%;">
                                    <a href="{{ route('materials.edit', $material->id) }}" class="mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                            viewBox="0 0 512 512">
                                            <path fill="#116fdc"
                                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                        </svg>
                                    </a>
                                </div>
                                <div style="width: 40%">
                                    <form method="post" action="{{ route('materials.destroy', $material->id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')"
                                            style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                                viewBox="0 0 448 512">
                                                <path fill="#116fdc"
                                                    d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="filler"></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $materials->links() }}
    </div>

    <script>
        //logica filtro
        function submitForm() {
            let materialFilterValue = document.getElementById("materialFilter").value;

            if (materialFilterValue) {
                document.getElementById("materialFilterForm").submit();
            }
        }
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

        const deleteSelectedButton = document.getElementById('delete-selected');
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');
            const searchInput = document.getElementById('search');
            const filterDropdown = document.getElementById('filter');
            const sortDropdown = document.getElementById('sort');

            sortDropdown.addEventListener('change', function() {
                sortMaterials();
            });

            function sortMaterials() {
                const sortValue = sortDropdown.value;
                const materialRows = Array.from(document.querySelectorAll('.material-row'));
                const fillerRows = Array.from(document.querySelectorAll('.filler'));

                materialRows.sort((a, b) => {
                    const aName = a.querySelector('a').textContent.toLowerCase();
                    const bName = b.querySelector('a').textContent.toLowerCase();

                    if (sortValue === 'az') {
                        return aName.localeCompare(bName);
                    } else {
                        return bName.localeCompare(aName);
                    }
                });

                const tbody = document.querySelector('tbody');
                materialRows.forEach((row, index) => {
                    tbody.appendChild(row);
                    if (fillerRows[index]) {
                        tbody.appendChild(fillerRows[index]);
                    }
                });
            }



            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                        'input[name="selectedMaterials[]"]:checked').length;
                });
            });

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();
                filterMaterials(searchTerm);
            });

            filterDropdown.addEventListener('change', function() {
                filterMaterials();
            });


        });

        deleteSelectedButton.addEventListener('click', function() {
            const selectedMaterials = Array.from(document.querySelectorAll(
                    'input[name="selectedMaterials[]"]:checked'))
                .map(checkbox => checkbox.value);
            if (selectedMaterials.length > 0 && confirm(
                'Tem certeza que deseja excluir os materiais selecionados?')) {
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
