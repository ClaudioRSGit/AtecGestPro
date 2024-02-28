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
        <h1>Editar Material</h1>


        <form method="post" action="{{ route('materials.update', $material->id) }}">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-6 mb-3">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Material:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $material->name }}">

                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description"
                                  name="description">{{ $material->description }}</textarea>

                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="supplier" class="form-label">Fornecedor:</label>
                        <input type="text" class="form-control" id="supplier" name="supplier"
                               value="{{ $material->suplier }}">

                        @error('supplier')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="acquisition_date" class="form-label">Data de Aquisição:</label>
                        <input type="datetime-local" class="form-control flatpickr" id="acquisition_date"
                               name="acquisition_date"
                               value="{{ !empty($material->acquisition_date) ? \Carbon\Carbon::parse($material->acquisition_date)->format('Y-m-d\TH:i:s') : '' }}"
                               required>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="row grid mb-3">
                        <div class="mx-3 gender mb-3" id="gender">
                            <label for="gender" class="form-label">Género:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="1" {{ $material->gender == 1 ? 'selected' : '' }}>Masculino</option>
                                <option value="0" {{ $material->gender == 0 ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>

                        <div class="mx-3 qty mb-3" id="quantity">
                            <label for="quantity" class="form-label">Quantidade:</label>
                            <input type="number" class="form-control text-left" id="quantity" name="quantity"
                                   value="{{ $material->quantity }}">
                        </div>

                        <div class="mx-3 internal mb-3">
                            <label for="isInternal">Material interno?</label>
                            <select class="form-control" id="isInternal" name="isInternal">
                                <option value="1" {{ $material->isInternal ? 'selected' : '' }}>Sim</option>
                                <option value="0" {{ !$material->isInternal ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>
                        <div class="mx-3 clothing mb-3" id="clothingToggle">
                            <label for="isClothing" class="form-label">É vestuário?</label>
                            <select class="form-control" id="isClothing" name="isClothing" onchange="toggleFields()">
                                <option value="1" {{ $material->isClothing ? 'selected' : '' }}>Sim</option>
                                <option value="0" {{ !$material->isClothing ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>
                    </div>

                    <div id="warningMessage" class="mb-3" style="display: none; text-align: center; margin-top: 10px; color: red;">
                        Nota: Não é possível adicionar vestuário externo.
                    </div>

                    <div id="hide">
                        <div class="d-flex sizesQuantitiesCourses">
                            <div class="flex-column sizesQuantities">
                                <div class="mb-3">
                                    <p class="form-label font-weight-bold">Tamanho e stock: </p>
                                </div>
                                <div class="mb-3 mr-4 scrollable-column mr-5" id="size">
                                    <div class="d-flex flex-column">
                                        @foreach ($sizesAll as $sizeAll)
                                            <div class="d-flex justify-content-between align-items-center mb-2 px-4">
                                                <div class="form-check">
                                                    <input onchange="toggleFieldsQuantity()"
                                                           class="form-check-input size-checkbox" type="checkbox"
                                                           name="sizes[]" value="{{ $sizeAll->id }}"
                                                        {{ in_array($sizeAll->id, $material->sizes->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="size{{ $sizeAll->id }}">
                                                        {{ $sizeAll->size }}
                                                    </label>
                                                </div>

                                                <input type="number" name="stocks[{{ $sizeAll->id }}]"
                                                       value="{{ old('stocks.' . $sizeAll->id, $material->sizes->where('id', $sizeAll->id)->first()->pivot->stock ?? 0) }}"
                                                       class="form-control w-25 mx-5 quantity-input" min="0"
                                                    {{ in_array($sizeAll->id, $material->sizes->pluck('id')->toArray()) ? '' : 'disabled' }}>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>


                            <div class="flex-column">
                                <div class="mb-3">
                                    <p class="form-label font-weight-bold">Cursos:</p>
                                </div>
                                <div class="mb-3 pl-5" id="role">
                                    <div class="d-flex flex-column scrollable-column">
                                        @foreach ($coursesAll as $courseAll)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="courses[]"
                                                       value="{{ $courseAll->id }}"
                                                    {{ in_array($courseAll->id, $material->courses->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="course{{ $courseAll->id }}">
                                                    {{ $courseAll->code }}
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
                    <button type="submit" class="btn btn-primary">Guardar Material</button>
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
            let quantity = document.getElementById('quantity');
            let hide = document.getElementById('hide');

            let isInternalValue = $("#isInternal").val();

            if (isInternalElement.value == 0 || isInternalValue == 0) {
                isClothingElement.value = 0;
                warningMessage.style.display = 'block';
                $("#clothingToggle").hide();
            } else {
                warningMessage.style.display = 'none';
                $("#clothingToggle").show();
            }

            if (isClothingElement.value == 1) {
                isInternalElement.value = 1;
            }

            gender.style.display = (isInternalElement.value == 1 && isClothingElement.value == 1) ? 'block' : 'none';
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
        flatpickr(".flatpickr", {
            inline: true,
            altInput: true,
            altFormat: "F j, Y H:i",
            dateFormat: "Y-m-d\TH:i:s",
            // maxDate: "today",
            locale: "pt"
        });
    </script>
@endsection
