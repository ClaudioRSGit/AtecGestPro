@extends('master.main')

@section('content')
    <div class="container">

        <h1>Atribuir</h1>


        <h5>Nome Completo</h5>
        <div class="input-group mb-3" style="width: 60%;">
            <input type="text" class="form-control" id="userToAssignClothing" placeholder="{{ $student->name }}"
                value="{{ $student->name }}" aria-label="Username" aria-describedby="basic-addon1" disabled="disabled">
        </div>

        <div class="d-flex justify-content-between mb-3">
            <form class="form-inline w-50" id="filterForm">
                <div class="form-group search-container mr-3 w-100" style="width: 30%;">
                    <input type="text" id="search" class="form-control w-100" placeholder="Pesquisar Material">
                </div>

            </form>
            <div class="buttons">
                <div>
                    <select class="form-control" id="sort">
                        <option value="az" selected>A-Z</option>
                        <option value="za">Z-A</option>
                    </select>
                </div>

                <div style="display: none;">
                    <select class="form-control" id="filter" disabled>
                        <option value="all">Todos</option>
                        <option value="trainer">Formador</option>
                        <option value="trainee" selected>Formando</option>
                        <option value="technical">Técnico </option>
                    </select>
                </div>

            </div>
        </div>



        <form action="{{ route('material-user.store') }}" method="post">
            @csrf

            <input type="hidden" name="user_id" value="{{ $student->id }}">
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
                        <th scope="col" style="text-align: center;">Data de Entrega</th>


                    </tr>
                </thead>
                <tbody>
                    @forelse  ($clothing_assignment as $clothing_assignment)
                        <tr class="material-row" data-trainee="{{ $clothing_assignment->role == 3 ? 1 : 0 }}">

                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" name="selectedClothing[]" type="checkbox"
                                        value="{{ $clothing_assignment->id }}" id="flexCheckDefault">

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
                                    Neutro
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <select class="form-control size-select" id="filter{{ $loop->index }}">
                                    @forelse ($clothing_assignment->sizes as $size)
                                        <option value="{{ $size->size }}" data-stock="{{ $size->pivot->stock }}" data-size-id="{{ $size->id }}">
                                            {{ $size->size }}({{ $size->pivot->stock }})
                                        </option>
                                    @empty
                                        <option value="N.A." data-stock="{{ $clothing_assignment->quantity }}" data-size-id="N.A.">
                                            N.A.({{ $clothing_assignment->quantity }})
                                        </option>
                                    @endforelse
                                </select>
                                <input type="hidden" name="size_id[]" class="size-id-input" value="">
                            </td>

                            <td style="text-align: center; " class="text-muted">
                                Formando
                            </td>
                            <td style="text-align: center;">
                                <input type="number" class="form-control quantity-input" id="quantity{{ $loop->index }}"
                                    name="quantity[]" value="1" min="1" style="width: 60px; text-align: center;">
                            </td>
                            <td style="text-align: center;">
                                <input type="date" class="form-control" id="date" name="delivery_date"
                                    value="{{ date('Y-m-d') }}">
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">Não existem materiais para atribuir</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-bottom: 20px;">
                <label for="delivered">Entrega Completa</label>
                <select class="form-control" id="delivered" name="delivered_all" style="width: 80px;text-align: center;">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <h5>Observações </h5>
            <div class="row">
                <div class="col-4">
                    <textarea class="form-control" name="additionalNotes" id="textarea" aria-label="With textarea"></textarea>
                </div>
                <div class="col">
                    <div class="buttons">

                        <button class="btn  btn-primary" type="button" id="apagarOnClick">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="25" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg> Apagar
                        </button>

                        <button class="btn btn-primary" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="25" fill="currentColor"
                                class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z" />
                                <path
                                    d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                            </svg> Guardar
                        </button>

                        <button class="btn btn-primary" type="button"
                            onclick="window.location.href='{{ url()->previous() }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="25" fill="currentColor"
                                class="bi bi-x-square" viewBox="0 0 16 16">
                                <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg> Fechar
                        </button>

                    </div>
                </div>
            </div>

    </div>

    </div>

    </form>





    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.form-check-input');
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

            sortDropdown.dispatchEvent(new Event('change'));

            $(document).ready(function() {
                $('.material-row .size-select').each(function(index, select) {
                    var quantityInput = $('.material-row .quantity-input').eq(index);
                    $(select).change(function() {
                        var selectedOption = $(this).children("option:selected");
                        var stock = parseInt(selectedOption.data('stock'));
                        quantityInput.attr('max', stock);

                        if (parseInt(quantityInput.val()) > stock) {
                            quantityInput.val(stock);
                        }
                    }).trigger('change');

                    quantityInput.on('input', function() {
                        var max = parseInt($(this).attr('max'));
                        if (parseInt($(this).val()) > max) {
                            $(this).val(max);
                        }
                    });


                });
            });

            //test
            document.querySelectorAll('.size-select').forEach((select) => {
                select.addEventListener('change', (event) => {
                    const selectedOption = event.target.options[event.target.selectedIndex];
                    const sizeId = selectedOption.getAttribute('data-size-id');
                    const correspondingSizeIdInput = event.target.parentNode.querySelector('.size-id-input');
                    correspondingSizeIdInput.value = sizeId;
                });
            });

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

            $(document).ready(function() {
                $('form').on('keydown', function(e) {
                    if (e.keyCode == 13) {
                        e.preventDefault();
                        return false;
                    }
                });
            });
        });
    </script>
@endsection
