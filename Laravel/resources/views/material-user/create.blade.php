@extends('master.main')

@section('content')
    <div class="container">

        <h1>Atribuir</h1>

        <div class="d-flex justify-content-between mb-3">
        <div class="input-group mb-3" style="width: 60%;">
            <p class="mr-3 font-weight-bold">Formando: {{ $student->name }} </p>

        </div>


            <div class="buttons">


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
                    <th scope="col" style="text-align: center;">Tamanho</th>
                    <th scope="col" style="text-align: center;">Quantidade</th>
                    <th scope="col" style="text-align: center;">Data de Entrega</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clothes as $clothingItem)
                    @php
                        $totalStock = $clothingItem->sizes->sum('pivot.stock');
                        $disabled = $totalStock > 0 ? '' : 'disabled';
                    @endphp
                    <tr class="material-row">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" name="selectedClothing[{{ $clothingItem->id }}]"
                                       type="checkbox" value="{{ $clothingItem->id }}" data-size-select="#filter{{ $loop->index }}"
                                       id="flexCheckDefault{{ $loop->index }}" {{ $disabled }}>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('materials.show', $clothingItem->id) }}">{{ isset($clothingItem->name) ? $clothingItem->name : 'N.A.' }}</a>
                        </td>
                        <td style="text-align: center;">
                            <input type="hidden" name="material_size_id[]" class="material-size-id-input" value="" {{ $disabled }}>
                            <select class="form-control size-select" id="filter{{ $loop->index }}"
                                    name="material_size_id[{{ $clothingItem->id }}]" data-clothing-id="{{ $clothingItem->id }}" {{ $disabled }}>

                                    @php
                                    $hasStock = false;
                                @endphp

                                @foreach($clothingItem->sizes as $size)
                                    @if($size->pivot->stock > 0)
                                        @php
                                            $hasStock = true;
                                        @endphp
                                        <option value="{{ $size->id }}" data-stock="{{ $size->pivot->stock }}">
                                            {{ $size->size }} ({{ $size->pivot->stock }})
                                        </option>
                                    @else
                                        <option disabled>{{ $size->size }} (Não existe stock)</option>
                                    @endif
                                @endforeach

                                @if(!$hasStock)
                                    <option disabled selected>Não existe nenhum tamanho com stock</option>
                                @endif

                            </select>
                        </td>
                        <td style="text-align: center;">
                            <input type="number" class="form-control quantity-input" id="quantity{{ $loop->index }}"
                                   name="quantity[{{ $clothingItem->id }}]" value="1" min="1"
                                   style="width: 60px; text-align: center;" {{ $disabled }}>
                        </td>
                        <td style="text-align: center;">
                            <input type="date" class="form-control" name="delivery_date[{{ $clothingItem->id }}]"
                                   value="{{ date('Y-m-d') }}" {{ $disabled }}>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>


            <div class="row mb-3 ">
                <div class="col-4">
                    <textarea placeholder="Observações" class="form-control" name="additionalNotes" id="textarea" aria-label="With textarea"></textarea>
                </div>
                <div class="col-2 d-flex ">
                    <label for="delivered"  style="margin: auto;" class=" ">Entrega Completa</label>
                    <input type="hidden" name="delivered_all" value="0">
                    <input type="checkbox" class="form-control" id="delivered" name="delivered_all" value="1" style="width: 15px;text-align: left;margin: auto ">
                </div>
                <div class="col-6 d-flex justify-content-end" style="margin: auto">
                        <button class="btn btn-primary mx-3" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="25" fill="currentColor"
                                 class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z" />
                                <path
                                    d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg> Guardar
                        </button>
                        <button class="btn btn-danger" type="button"
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

        </form>

        {{$clothes->links() }}



    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.form-check-input');

            $(document).ready(function () {
                $('.material-row .size-select').each(function (index, select) {
                    var quantityInput = $('.material-row .quantity-input').eq(index);
                    $(select).change(function () {
                        var selectedOption = $(this).children("option:selected");
                        var stock = parseInt(selectedOption.data('stock'));
                        quantityInput.attr('max', stock);

                        if (parseInt(quantityInput.val()) > stock) {
                            quantityInput.val(stock);
                        }
                    }).trigger('change');

                    quantityInput.on('input', function () {
                        var max = parseInt($(this).attr('max'));
                        if (parseInt($(this).val()) > max) {
                            $(this).val(max);
                        }
                    });
                });
            });

            function updateFormData() {
                const formData = new FormData(document.querySelector('form'));

                document.querySelectorAll('.form-check-input:checked').forEach(function (checkbox) {
                    const clothingId = checkbox.value;
                    const selectElement = document.querySelector(`.size-select[data-clothing-id="${clothingId}"]`);
                    const selectedOption = selectElement.options[selectElement.selectedIndex];
                    const materialSizeId = selectedOption.value;

                    formData.set(`material_size_id[${clothingId}]`, materialSizeId);
                });

                document.querySelectorAll('.material-row .size-select:not(:checked)').forEach(function (select) {
                    const clothingId = select.getAttribute('data-clothing-id');
                    formData.delete(`material_size_id[${clothingId}]`);
                });


            }


            document.querySelector('form').addEventListener('submit', function (e) {
                updateFormData();
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