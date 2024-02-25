@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <style>
        .flatpickr {
            width: 308px;
        }
    </style>
    <div class="container w-100 fade-in">
        <h1>Criar Novo Material</h1>

        <form method="post" action="{{ route('materials.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Material:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}">

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="supplier" class="form-label">Fornecedor:</label>
                        <input type="text" class="form-control" id="supplier" name="supplier"
                            value="{{ old('supplier') }}">

                        @error('supplier')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="acquisition_date" class="form-label">Data de Aquisição:</label>
                        <input type="datetime-local" class="form-control flatpickr" id="acquisition_date"
                            name="acquisition_date" required placeholder="Selecione a data de início">
                    </div>



                </div>
                <div class="col-md-6">
                    <div class="row grid mb-3">
                        <div class="mx-3 gender mb-3" id="gender">
                            <label for="gender" class="form-label">Género:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Masculino</option>
                                <option value="0" {{ old('gender') == 0 ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>
                        <div class="mx-3 qty mb-3" id="quantity">
                            <label for="quantity" class="form-label">Quantidade:</label>

                            <input type="number" class="form-control" id="quantity" name="quantity" value="1"
                                min="1" style="text-align: left;">
                        </div>
                        <div class="mx-3 internal mb-3">
                            <label for="isInternal" class="form-label">Material interno?</label>
                            <select class="form-control" id="isInternal" name="isInternal" onchange="toggleFields()">
                                <option value="1" {{ old('isInternal') == 1 ? 'selected' : '' }}>Sim</option>
                                <option value="0" {{ old('isInternal') == 0 ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>
                        <div class="mx-3 clothing mb-3" id="clothingToggle">
                            <label for="isClothing" class="form-label">É vestuário?</label>
                            <select class="form-control" id="isClothing" name="isClothing" onchange="toggleFields()">
                                <option value="1" {{ old('isClothing') == 1 ? 'selected' : '' }}>Sim</option>
                                <option value="0" {{ old('isClothing') == 0 ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>
                    </div>
                    <div id="warningMessage" style="display: none; text-align: center; margin-top: 10px; color: red;">
                        Nota: Não é possível adicionar vestuário externo.
                    </div>



                    <div id="hide">
                        <div class="d-flex flex-row">
                            <div class="flex-column">
                                <div class="mb-3">
                                    <p class="form-label font-weight-bold">Tamanho e stock: </p>
                                </div>
                                <div class="mb-3 mr-4 scrollable-column mr-5" id="size">
                                    <div class="d-flex flex-column">
                                        @foreach ($sizes as $size)
                                            <div class="d-flex justify-content-between align-items-center mb-2 px-5">
                                                <div class="form-check">
                                                    <input onchange="toggleFieldsQuantity()"
                                                        class="form-check-input size-checkbox" type="checkbox"
                                                        name="sizes[]" value="{{ $size->id }}"
                                                        {{ in_array($size->id, old('sizes', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="size{{ $size->id }}">
                                                        {{ $size->size }}
                                                    </label>
                                                </div>

                                                <input type="number" name="stocks[{{ $size->id }}]"
                                                    value="{{ old('stocks.' . $size->id, 0) }}"
                                                    class="form-control w-25 mx-5 quantity-input" min="0"
                                                    {{ in_array($size->id, old('sizes', [])) ? '' : 'disabled' }}>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="flex-column">
                                <div class="mb-3">
                                    <p class="form-label font-weight-bold">Cursos:</p>
                                </div>
                                <div class="mb-3" id="role">
                                    <div class="d-flex flex-column scrollable-column">
                                        @foreach ($courses as $course)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="courses[]"
                                                    value="{{ $course->id }}"
                                                    {{ in_array($course->id, old('courses', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="course{{ $course->id }}">
                                                    {{ $course->code }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Criar Material</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <style>
        .form-control[readonly] {
            opacity: 0 !important;
            height: 0;
            padding: 0;
        }

        .scrollable-column {
            max-height: 300px;
            overflow-y: auto;
        }

        .gender {
            grid-area: gender;
        }

        .qty {
            grid-area: quantity;
        }

        .internal {
            grid-area: internal;
        }

        .clothing {
            grid-area: clothing;
        }

        .grid {
            display: grid;
            grid-template-areas:
                'internal quantity'
                'clothing gender';
        }
    </style>

    <script>
        function toggleFieldsQuantity() {

            const sizeCheckboxes = document.querySelectorAll('.size-checkbox');
            const quantityInputs = document.querySelectorAll('.quantity-input');


            sizeCheckboxes.forEach((checkbox, index) => {
                quantityInputs[index].disabled = !checkbox.checked;
            });

        }
    </script>


    <script>
        function toggleFields() {
            let isInternalElement = document.getElementById('isInternal');
            let isClothingElement = document.getElementById('isClothing');
            let gender = document.getElementById('gender');
            // let size = document.getElementById('size');
            // let role = document.getElementById('role');
            let quantity = document.getElementById('quantity');
            // let labels = document.getElementById('labels');
            let hide = document.getElementById('hide');

            if (isInternalElement.value == 0) {
                isClothingElement.value = 0;
                warningMessage.style.display = 'block';
            } else {
                warningMessage.style.display = 'none';
            }

            if (isClothingElement.value == 1) {
                isInternalElement.value = 1;
            }

            gender.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'block' : 'none';
            // size.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'block' : 'none';
            // role.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'block' : 'none';
            // labels.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'block' : 'none';
            quantity.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'none' : 'block';
            hide.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', toggleFields);

        document.getElementById('isInternal').addEventListener('change', toggleFields);
        document.getElementById('isClothing').addEventListener('change', toggleFields);
    </script>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
    <script>
        jQuery(function() {
            flatpickr("#acquisition_date", {
                inline: true,
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                minDate: "today",
                locale: "pt"


            });
        });
    </script>

    <script>
        function toggleFields() {
            var isInternalValue = $("#isInternal").val();

            if (isInternalValue == 0) {
                $("#clothingToggle").hide();
            } else {
                $("#clothingToggle").show();
            }
        }

        $(document).ready(function() {
            toggleFields();
        });
    </script>
@endsection
