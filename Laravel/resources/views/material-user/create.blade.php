@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/material-user.css') }}">
@endsection

@section('content')
    <div class="container w-100 fade-in materialUserCreateContent">


        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="m-0">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="row">

            <div class="col-8 w-100 d-flex justify-content-between materialUserCreateTitle">
                <h3>Atribuir Vestuário: </h3>
                <div class="d-flex mt-2 ">
                    <h4 class="ml-1 font-weight-bold"> {{ ucfirst($student->role->name) }} {{ $student->name }} </h4>
                </div>
            </div>
            <div class="col-4 mobileHidden">
                <h3 class="mt-1">Materiais atribuídos</h3>
            </div>
        </div>
        <hr>
        <form action="{{ route('material-user.store') }}" method="post">
            @csrf
            <div class="row materialUserCreateContentTables">
                <div class="col-8 w-100" style="height: 25rem">


                    <input type="hidden" name="user_id" value="{{ $student->id }}">
                    <div class="materials">
                        <table class="table rounded-top">
                            <thead style="background-color: transparent;">
                            <tr>
                                <th scope="col" class="h-100">
                                    <input type="checkbox" id="select-all" class="h-100">
                                </th>
                                <th scope="col">Material</th>
                                <th scope="col" class="mobileHidden">Género</th>
                                <th scope="col" style="text-align: center;">Tamanho</th>
                                <th scope="col" style="text-align: center;">Quantidade</th>
                                <th class="mobileHidden" scope="col" style="text-align: center;">Data de Entrega</th>
                            </tr>
                            </thead>
                            <tbody class="customTableStyling">
                            @if ($clothes->isEmpty())
                                <tr>
                                    <td colspan="5">Não existem fardas disponíveis para {{ ucfirst($course) }}</td>
                                </tr>
                            @else
                            <tr class="filler"></tr>
                                @foreach ($clothes as $clothingItem)
                                    @php
                                        $totalStock = $clothingItem->sizes->sum('pivot.stock');
                                        $disabled = $totalStock > 0 ? '' : 'disabled';
                                    @endphp
                                    <tr class="material-row customTableStyling">
                                        <td>
                                            <div class="form-check d-flex justify-content-center align-items-center">
                                                <input class="form-check-input"
                                                       name="selectedClothing[{{ $clothingItem->id }}]"
                                                       type="checkbox" value="{{ $clothingItem->id }}"
                                                       data-size-select="#filter{{ $loop->index }}"
                                                       id="flexCheckDefault{{ $loop->index }}" {{ $disabled }}>
                                            </div>
                                        </td>
                                        <td class="mobileOverflow">
                                            <a href="{{ route('materials.show', $clothingItem->id) }}">{{ isset($clothingItem->name) ? $clothingItem->name : 'N.A.' }}</a>
                                        </td>
                                        <td class="mobileHidden">
                                            <a href="{{ route('materials.show', $clothingItem->id) }}">
                                                {{ isset($clothingItem->gender) ? ($clothingItem->gender == 1 ? 'Masculino' : 'Feminino') : 'N.A.' }}
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" name="material_size_id[]"
                                                   class="material-size-id-input"
                                                   value="" {{ $disabled }}>
                                            <select class="form-control size-select" id="filter{{ $loop->index }}"
                                                    name="material_size_id[{{ $clothingItem->id }}]"
                                                    data-clothing-id="{{ $clothingItem->id }}" {{ $disabled }}>

                                                @php
                                                    $hasStock = false;
                                                @endphp
                                                @if($clothingItem->sizes->isEmpty())
                                                    <p>Não existe vestuario em stock</p>
                                                @else
                                                @foreach($clothingItem->sizes as $size)
                                                    @if($size->pivot->stock > 0)
                                                        @php
                                                            $hasStock = true;
                                                        @endphp
                                                        <option value="{{ $size->id }}"
                                                                data-stock="{{ $size->pivot->stock }}">
                                                            {{ $size->size }} ({{ $size->pivot->stock }})
                                                        </option>
                                                    @else
                                                        <option disabled>{{ $size->size }} (Não existe stock)</option>
                                                    @endif
                                                @endforeach
                                                @endif

                                                @if(!$hasStock)
                                                    <option disabled selected>Não existe nenhum tamanho com stock
                                                    </option>
                                                @endif

                                            </select>
                                        </td>
                                        <td class="pl-4">
                                            <input type="number" class="form-control quantity-input"
                                                   id="quantity{{ $loop->index }}"
                                                   name="quantity[{{ $clothingItem->id }}]" value="1" min="1"
                                                   style="width: 60px; text-align: center;" {{ $disabled }}>
                                        </td>
                                        <td class="mobileHidden position-relative">
                                            <input type="date" class="form-control w-90 delivery_date"
                                                   name="delivery_date[{{ $clothingItem->id }}]"
                                                   value="{{ date('Y-m-d') }}" {{ $disabled }}>
                                            <span class="warning-icon position-absolute"
                                                  style="display: none; right: 0;">
                                        <i class="fa fa-info-circle" data-toggle="tooltip"
                                           title="Atenção! A data selecionada é anterior à data de hoje"></i>
                                    </span>
                                        </td>
                                    </tr>

                                    <tr class="filler"></tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>


                </div>

                <div class="col-4 mb-3 pl-3 shadow bg-transparent materialsAssigned">

                    <table class="table bg-white">
                        <thead>
                        <tr>
                            <th>Material</th>
                            <th>Tamanho</th>
                            <th>Quantidade</th>
                        </tr>
                        </thead>
                        <tbody class="customTableStyling">

                            @if(!$assignedClothes->isEmpty())
                                @foreach($assignedClothes as $item)
                                    <tr class="filler"></tr>
                                    <tr>
                                        @if($item->material && $item->material->name)
                                            <td style="text-align: left;">{{ $item->material->name ?? 'N.A.'}}</td>
                                            <td style="text-align: left;">{{ $item->size->size ?? 'N.A.' }}</td>
                                            <td style="text-align: left;">{{ $item->quantity ?? 'N.A.' }} uni</td>
                                        @else
                                            <td colspan="3">Material apagado do sistema</td>
                                        @endif
                                    </tr>
                                    <tr class="filler"></tr>
                                @endforeach
                            @else
                                <tr><td colspan="3">Nenhuma farda entregue ao utilizador</td></tr>
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="row mt-3 materialUserSubmit">
                <div class="col-5">
                            <textarea placeholder="Notas (Exemplo: Aluno tem cacifo x): ..." class="form-control" name="additionalNotes"
                                      id="textarea" aria-label="With textarea"></textarea>
                </div>
                <div class="col-3 d-flex delivery" style="max-width: 75% !important;">
                    <label for="delivered" style="margin: auto;" class=" ">Entrega Completa</label>
                    <input type="hidden" name="delivered_all" value="0">
                    <input type="checkbox" class="form-control" id="delivered" name="delivered_all" value="1"
                           style="width: 15px;text-align: left;margin: auto "
                            {{ old('delivered_all', $student->materialUsers()->where('delivered_all', 1)->exists()) ? 'checked' : '' }}>
                </div>

                <div class="col-4 d-flex justify-content-end" style="margin: auto">
                    <button class="btn btn-primary mr-3" type="submit">

                        Guardar
                    </button>
                    <button class="btn btn-danger" type="button"
                        onclick="window.location.href='{{ route('material-user.index') }}'">

                        Fechar
                    </button>
                </div>
            </div>
        </form>


    </div>



    <script>


        setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2000);
    </script>

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


            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                        'input[name="selectedClothing[]"]:checked').length;
                });
            });


            $(document).ready(function () {
                $('form').on('keydown', function (e) {
                    if (e.keyCode == 13) {
                        e.preventDefault();
                        return false;
                    }
                });
            });
        });

        document.querySelectorAll('.delivery_date').forEach(function (inputField) {
            inputField.addEventListener('change', function () {
                let inputDate = new Date(this.value);
                let today = new Date();
                today.setHours(0, 0, 0, 0);

                let parentDiv = this.parentNode.querySelector('.warning-icon');

                if (inputDate < today) {
                    parentDiv.style.display = 'inline';
                } else {
                    parentDiv.style.display = 'none';
                }
            });
        });

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
