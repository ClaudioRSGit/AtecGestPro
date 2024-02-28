@extends('master.main')

@section('content')
    <div class="container  w-100 fade-in">
        <div class="mb-4 position-relative materialsTitle">
            <h1>Lista de Materiais</h1>

            <a href="{{ route('materials.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-pen mr-1" style="color: #ffffff;"></i>
                Novo Material
            </a>
            <img src="{{ asset('assets/questionMark.png') }}" onclick="event.stopPropagation(); changeUserTab(); triggerMaterialIntro();" class="questionMarkBtn">
        </div>

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <ul class="nav nav-tabs mb-3" id="userTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#materiais">Todos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reciclagem_materiais">Reciclagem</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="materiais" class="tab-pane fade show active">

                <div class="d-flex justify-content-between mb-3 w-100 materialsTableFilters">
                    <div class="d-flex justify-content-between">

                        <form action="{{ route('materials.index') }}" method="GET" class="materials-searchBar">
                            <div class="input-group pr-2">
                                <div class="search-container">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="{{ request('search') ? request('search') : 'Procurar...' }}">
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        Procurar
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="buttons">
                        <button class="btn btn-danger" id="delete-selected">Excluir Selecionados</button>


                        <form id="materialFilterForm" action="{{ route('materials.index') }}" method="GET">
                            <div>
                                <select class="form-control" id="materialFilter" name="materialFilter"
                                    onchange="submitForm()">
                                    <option value="all" {{ $materialFilter === 'all' ? 'selected' : '' }}>Todos</option>
                                    <option value="internal" {{ $materialFilter === 'internal' ? 'selected' : '' }}>
                                        Interno
                                    </option>
                                    <option value="clothing" {{ $materialFilter === 'clothing' ? 'selected' : '' }}>
                                        Fardamento
                                    </option>
                                    <option value="external" {{ $materialFilter === 'external' ? 'selected' : '' }}>
                                        Externo
                                    </option>
                                </select>
                            </div>
                        </form>


                    </div>
                </div>


                <div>
                    @if ($materials->isEmpty())
                        <img src="{{ asset('assets/tool.png') }}"
                            alt="Não existem materiais" class="bin" draggable="false">
                    @else
                        <table class="table bg-white rounded-top">
                            <thead>
                                <tr>
                                    <th scope="col" class="mobileHidden">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th scope="col">
                                        <a
                                            href="{{ route('materials.index', ['sortColumn' => 'name', 'sortDirection' => $sortColumn === 'name' ? ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">
                                            Nome
                                            @if ($sortDirection === 'desc' && $sortColumn === 'name')
                                                <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                            @else
                                                <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col">
                                        Quantidade
                                    </th>
                                    <th scope="col" class="mobileHidden">
                                        <a
                                            href="{{ route('materials.index', ['sortColumn' => 'acquisition_date', 'sortDirection' => $sortColumn === 'acquisition_date' ? ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">
                                            Data de Aquisição
                                            @if ($sortDirection === 'desc' && $sortColumn === 'acquisition_date')
                                                <i class="fa-solid fa-arrow-down-wide-short" style="color: #116fdc;"></i>
                                            @else
                                                <i class="fa-solid fa-arrow-up-short-wide" style="color: #116fdc;"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="mobileHidden">Fornecedor</th>
                                    <th scope="col">Género</th>
                                    <th scope="col">
                                        <div class="centerTd">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="filler"></tr>
                                @foreach ($materials as $material)
                                    <tr class="customTableStyling materialTableRow" data-internal="{{ $material->isInternal }}"
                                        data-clothing="{{ $material->isClothing }}">
                                        <td class="mobileHidden">
                                            <input type="checkbox" name="selectedMaterials[]" value="{{ $material->id }}">
                                        </td>
                                        <td class="clickable material-name">
                                            <a href="{{ route('materials.show', $material->id) }}"
                                                class="d-flex align-items-center w-auto h-100">{{ isset($material->name) ? $material->name : 'N.A.' }}</a>
                                        </td>
                                        <td class="position-relative">

                                            @if ($material->isClothing == 1)
                                                @php
                                                    $minus5 = 2;
                                                @endphp

                                                @if ($material->sizes->count() > 0)
                                                    @foreach ($material->sizes as $size)
                                                        @if ($size->pivot->stock <= 5 && $size->pivot->stock > 0)
                                                            @php
                                                                $minus5 = 1;
                                                            @endphp
                                                        @elseif($size->pivot->stock === 0)
                                                            @php
                                                                $minus5 = 0;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @php
                                                        $minus5 = 0;
                                                    @endphp
                                                @endif
                                                {{ $material->sizes->sum('pivot.stock') }}

                                                @if ($minus5 === 1)
                                                    <span class="warning-icon position-absolute" style="left: -20px;">
                                                        <i class="fa fa-info-circle" data-toggle="tooltip"
                                                            title="Atenção!Pelo menos um tamanho prestes a ficar sem stock!"></i>
                                                    </span>
                                                @elseif ($minus5 === 0)
                                                    <span class="warning-icon position-absolute" style="left: -20px;">
                                                        <i class="fa-solid fa-triangle-exclamation" data-toggle="tooltip"
                                                            title="Atenção! Produto sem artigos em stock!"
                                                            style="color: #f12704;"></i>
                                                    </span>
                                                @endif
                                            @else
                                                {{ isset($material->quantity) ? $material->quantity : 'N.A.' }}
                                                @if (isset($material->quantity) && $material->quantity <= 5 && $material->quantity > 0)
                                                    <span class="warning-icon position-absolute" style="left: -20px;">
                                                        <i class="fa fa-info-circle" data-toggle="tooltip"
                                                            title="Atenção! Produto prestes a entrar em rotura de stock!"></i>
                                                    </span>
                                                @elseif (isset($material->quantity) && $material->quantity === 0)
                                                    <span class="warning-icon position-absolute" style="left: -20px;">
                                                        <i class="fa fa-info-circle" data-toggle="tooltip"
                                                            title="Atenção! Produto sem artigos em stock!"></i>
                                                    </span>
                                                @endif
                                            @endif
                                        </td>

                                        <td class="mobileHidden">
                                            {{ isset($material->acquisition_date) ? \Carbon\Carbon::parse($material->acquisition_date)->format('Y-m-d') : 'N.A.' }}
                                        </td>


                                        <td class="mobileHidden">
                                            @if ($material->supplier !== '' && $material->supplier !== null)
                                                {{ $material->supplier }}
                                            @else
                                                N.A.
                                            @endif
                                        </td>

                                        <td>
                                            @if ($material->isClothing === 0)
                                                N.A.
                                            @else
                                                @if ($material->gender === 1)
                                                    Masculino
                                                @elseif($material->gender === 0)
                                                    Feminino
                                                @else
                                                    N.A.
                                                @endif
                                            @endif

                                        </td>

                                        <td class="editDelete" style="padding: 0.25rem">
                                            <div style="width: 40%;">
                                                <a href="{{ route('materials.edit', $material->id) }}" class="mx-2">
                                                    <i class="fa-solid fa-pen-to-square fa-lg"
                                                        style="color: #116fdc;"></i>
                                                </a>
                                            </div>
                                            <div style="width: 40%">
                                                <form method="post"
                                                    action="{{ route('materials.destroy', $material->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="modalBtn"
                                                        data-message="Tem a certeza que deseja eliminar o material {{ $material->name }}?"
                                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                        <i class="fa-solid fa-trash-can fa-lg"
                                                            style="color: #116fdc;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="filler"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                {{ $materials->appends(['mPage' => $materials->currentPage()])->links() }}
            </div>


            <div id="reciclagem_materiais" class="tab-pane fade">
                <div class="d-flex justify-content-between mb-3 w-100 materialsTableFilters">
                    <div class="d-flex justify-content-between">

                        <form action="{{ route('materials.index') }}" method="GET">
                            <div class="input-group pr-2">
                                <div class="search-container">
                                    <input type="text" name="searchRecycled" class="form-control"
                                        placeholder="{{ request('search') ? request('search') : 'Procurar...' }}">
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        Procurar
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>
                    <div class="buttons">

                        <button class="btn btn-success" id="restore-selected">Restaurar Selecionados</button>
                        <button class="btn btn-danger" id="forceDelete-selected">Apagar Selecionados</button>


                        <form id="materialRecycledFilterForm" action="{{ route('materials.index') }}" method="GET">
                            <div>
                                <select class="form-control" id="materialRecycledFilter" name="materialRecycledFilter"
                                    onchange="submitFormRecycled()">
                                    <option value="all" {{ $materialRecycledFilter === 'all' ? 'selected' : '' }}>
                                        Todos
                                    </option>
                                    <option value="internal"
                                        {{ $materialRecycledFilter === 'internal' ? 'selected' : '' }}>
                                        Interno
                                    </option>
                                    <option value="clothing"
                                        {{ $materialRecycledFilter === 'clothing' ? 'selected' : '' }}>
                                        Fardamento
                                    </option>
                                    <option value="external"
                                        {{ $materialRecycledFilter === 'external' ? 'selected' : '' }}>
                                        Externo
                                    </option>
                                </select>
                            </div>
                        </form>


                    </div>
                </div>
                <div>
                    @if ($recycleMaterials->isEmpty())
                        <img src="{{ asset('assets/reciclagem_azul_extra_bold_2_sem fundo.png') }}"
                            alt="Não existem materiais" class="bin" draggable="false">
                    @else
                        <table class="table bg-white rounded-top">
                            <thead>
                                <tr>
                                    <th scope="col" class="mobileHidden">
                                        <input type="checkbox" id="recycledSelect-all">
                                    </th>
                                    <th scope="col">
                                        <a
                                            href="{{ route('materials.index', ['sortColumn' => 'name', 'sortDirection' => $sortColumn === 'name' ? ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">
                                            Nome
                                            @if ($sortDirection === 'desc' && $sortColumn === 'name')
                                                <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                            @else
                                                <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="mobileHidden">
                                        Quantidade
                                    </th>
                                    <th scope="col" class="mobileHidden">
                                        <a
                                            href="{{ route('materials.index', ['sortColumn' => 'acquisition_date', 'sortDirection' => $sortColumn === 'acquisition_date' ? ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">
                                            Data de Aquisição
                                            @if ($sortDirection === 'desc' && $sortColumn === 'acquisition_date')
                                                <i class="fa-solid fa-arrow-down-wide-short" style="color: #116fdc;"></i>
                                            @else
                                                <i class="fa-solid fa-arrow-up-short-wide" style="color: #116fdc;"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="mobileHidden">Fornecedor</th>
                                    <th scope="col">Género</th>

                                    <th scope="col">
                                        <div class="centerTd">Restaurar</div>
                                    </th>

                                    <th scope="col">
                                        <div class="centerTd">Apagar</div>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="filler">
                                    @foreach ($recycleMaterials as $material)
                                <tr class="customTableStyling materialTableRow" data-internal="{{ $material->isInternal }}"
                                    data-clothing="{{ $material->isClothing }}">
                                    <td class="mobileHidden">
                                        <input type="checkbox" name="selecteRecycledMaterials[]"
                                            value="{{ $material->id }}">
                                    </td>
                                    <td>
                                        <p>{{ isset($material->name) ? $material->name : 'N.A.' }}</p>
                                    </td>
                                    <td class="mobileHidden">
                                        @if ($material->isClothing == 1)
                                            {{ $material->sizes->sum('pivot.stock') }}
                                        @else
                                            {{ isset($material->quantity) ? $material->quantity : 'N.A.' }}
                                        @endif
                                    </td>

                                    <td class="mobileHidden">
                                        {{ isset($material->acquisition_date) ? \Carbon\Carbon::parse($material->acquisition_date)->format('Y-m-d') : 'N.A.' }}
                                    </td>
                                    <td class="mobileHidden">{{ $material->supplier !== null ? $material->supplier : 'N.A.' }}</td>

                                    <td>
                                        @if ($material->isClothing === 0)
                                            N.A.
                                        @else
                                            @if ($material->gender === 1)
                                                Masculino
                                            @elseif($material->gender === 0)
                                                Feminino
                                            @else
                                                N.A.
                                            @endif
                                        @endif

                                    </td>

                                    <td>
                                        <div class="centerTd">
                                            <form method="get" action="{{ route('materials.restore', $material->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                <button class="centerTd modalBtn" type="submit"
                                                    data-message="Tem a certeza que deseja restaurar o material {{ $material->name }}?"
                                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <img src="{{ asset('assets/restore.svg') }}">
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="centerTd">
                                            <form method="post"
                                                action="{{ route('materials.forceDelete', $material->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="modalBtn"
                                                    data-message="Tem a certeza que deseja eliminar permanentemente o material {{ $material->name }}?"
                                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <img src="{{ asset('assets/permaDelete.svg') }}" alt="Delete">

                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="filler"></tr>
                    @endforeach
                    </tbody>
                    </table>
                    @endif

                </div>
                {{ $recycleMaterials->appends(['mPage' => $recycleMaterials->currentPage()])->links() }}

            </div>
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
            document.addEventListener('DOMContentLoaded', function() {
                let deleteButtons = document.querySelectorAll('button[class="modalBtn"]');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();

                        let message = button.getAttribute('data-message');
                        document.getElementById('modalBody').textContent = message;

                        $('#deleteModal').modal('show');

                        $('#deleteBtn').click(function() {
                            button.closest('form').submit();
                        });
                    });
                });
            });
        </script>



        <script>
            //logica tabs
            $(document).ready(function() {
                function determineContext() {
                    return 'pagination';
                }

                function getFragment() {
                    return window.location.hash.substring(1);
                }

                function setFragment(fragment) {
                    history.pushState(null, null, '#' + fragment);
                }

                function setActiveTab(tabId) {
                    $(`#userTabs a[href="#${tabId}"]`).tab('show');
                }

                const pageName = window.location.pathname.split('/').pop();
                const activeTabInfo = localStorage.getItem(`activeTabInfo_${pageName}`);

                if (activeTabInfo) {
                    const {tabId, context} = JSON.parse(activeTabInfo);
                    setActiveTab(tabId);
                    setFragment(tabId);
                }

                $('#userTabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const tabId = $(e.target).attr('href').substring(1);
                    const context = determineContext();

                    const activeTabInfo = JSON.stringify({tabId, context});
                    localStorage.setItem(`activeTabInfo_${pageName}`, activeTabInfo);

                    setFragment(tabId);
                });

                window.addEventListener('hashchange', function() {
                    const fragment = getFragment();
                    setActiveTab(fragment);
                });

                window.addEventListener('beforeunload', function() {
                    history.pushState("", document.title, window.location.pathname + window.location.search);
                });
            });

        </script>
        <script>
            window.setTimeout(function() {
                $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 2000);
        </script>
        <script>
            //logica filtro materiais
            function submitForm() {
                let materialFilterValue = document.getElementById("materialFilter").value;

                if (materialFilterValue) {
                    document.getElementById("materialFilterForm").submit();
                }
            }
        </script>

        <script>
            //logica filtro materiais reciclados
            function submitFormRecycled() {
                let materialRecycledFilterValue = document.getElementById("materialRecycledFilter").value;

                if (materialRecycledFilterValue) {
                    document.getElementById("materialRecycledFilterForm").submit();
                }
            }
        </script>


        <script>
            const deleteSelectedButton = document.getElementById('delete-selected');
            const restoreSelectedButton = document.getElementById('restore-selected');
            const forceDeleteSelectedButton = document.getElementById('forceDelete-selected');

            document.addEventListener('DOMContentLoaded', function() {
                const selectAllCheckbox = document.getElementById('select-all');
                const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');

                const recycledSelectAllCheckbox = document.getElementById('recycledSelect-all');
                const recycledCheckboxes = document.querySelectorAll('input[name="selecteRecycledMaterials[]"]');

                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                });

                recycledSelectAllCheckbox.addEventListener('change', function() {
                    recycledCheckboxes.forEach(checkbox => {
                        checkbox.checked = recycledSelectAllCheckbox.checked;
                    });
                });




                recycledCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        recycledSelectAllCheckbox.checked = recycledCheckboxes.length === document
                            .querySelectorAll(
                                'input[name="selecteRecycledMaterials[]"]:checked').length;
                    });
                });

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                            'input[name="selectedMaterials[]"]:checked').length;
                    });
                });


            });

            restoreSelectedButton.addEventListener('click', function() {
                const selectedMaterials = Array.from(document.querySelectorAll(
                        'input[name="selecteRecycledMaterials[]"]:checked'))
                    .map(checkbox => checkbox.value);
                if (selectedMaterials.length > 0) {
                    let message = 'Tem certeza que deseja restaurar os materiais selecionados?';
                    document.getElementById('modalBody').textContent = message;
                    $('#deleteModal').modal('show');
                    document.getElementById('deleteBtn').style.display = 'block';

                    document.getElementById('deleteBtn').addEventListener('click', function() {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('materials.massRestore') }}';
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
                    });
                } else {
                    let message = 'Selecione pelo menos um material para restaurar!';
                    document.getElementById('modalBody').textContent = message;
                    $('#deleteModal').modal('show');
                    document.getElementById('deleteBtn').style.display = 'none';
                }
            });


            forceDeleteSelectedButton.addEventListener('click', function() {
                const selectedMaterials = Array.from(document.querySelectorAll(
                        'input[name="selecteRecycledMaterials[]"]:checked'))
                    .map(checkbox => checkbox.value);
                if (selectedMaterials.length > 0) {
                    let message = 'Tem certeza que deseja excluir permanentemente os materiais selecionados?';
                    document.getElementById('modalBody').textContent = message;
                    $('#deleteModal').modal('show');

                    document.getElementById('deleteBtn').addEventListener('click', function() {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('materials.massForceDelete') }}';
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
                    });
                } else {
                    let message = 'Selecione pelo menos um material para excluir!';
                    document.getElementById('modalBody').textContent = message;
                    $('#deleteModal').modal('show');
                    document.getElementById('deleteBtn').style.display = 'none';
                }
            });


            deleteSelectedButton.addEventListener('click', function() {
                const selectedMaterials = Array.from(document.querySelectorAll(
                        'input[name="selectedMaterials[]"]:checked'))
                    .map(checkbox => checkbox.value);
                if (selectedMaterials.length > 0) {
                    let message = 'Tem certeza que deseja excluir os materiais selecionados?';
                    document.getElementById('modalBody').textContent = message;
                    $('#deleteModal').modal('show');
                    document.getElementById('deleteBtn').style.display = 'block';

                    document.getElementById('deleteBtn').addEventListener('click', function() {
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
                    });
                } else {
                    let message = 'Selecione pelo menos um material para excluir!';
                    document.getElementById('modalBody').textContent = message;
                    $('#deleteModal').modal('show');
                    document.getElementById('deleteBtn').style.display = 'none';
                }
            });


            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endsection
    @push('scripts')
    <script src="{{ asset('js/userOnboarding/intro.js') }}"></script>
    <script src="{{ asset('js/userOnboarding/materialIntro.js') }}"></script>
    @endpush
