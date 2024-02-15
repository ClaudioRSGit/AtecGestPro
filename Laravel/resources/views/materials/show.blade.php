@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">
        <h1>Detalhes do Material</h1>
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row mb-3">

            <div class="col-md-6">

                <div class="mb-3">
                    <label for="name" class="form-label">Nome do Material:</label>
                    <input disabled type="text" class="form-control" id="name" name="name" value="{{ $material->name }}">
                </div>

                <div class="mb-3">
                    <label  for="description" class="form-label">Descrição:</label>
                    <textarea disabled class="form-control" id="description"
                              name="description">{{ $material->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="supplier" class="form-label">Fornecedor:</label>
                    <input disabled type="text" class="form-control" id="supplier" name="supplier"
                           value="{{ $material->suplier }}">
                </div>



                <div class="form-group">
                    <label for="acquisition_date">Data de Aquisição:</label>
                    <input disabled type="date" class="form-control" id="acquisition_date"
                           name="acquisition_date" value="{{ !empty($material->acquisition_date) ? \Carbon\Carbon::parse($material->acquisition_date)->format('Y-m-d') : 'Não disponível' }}" >

                </div>

                <div class="row grid mb-3">
                    <div class="gender mb-3" id="gender">
                        @if ($material->gender !== null)
                            <label for="gender">Género:</label>
                            <input disabled type="text" class="form-control" name="gender" placeholder="{{ $material->gender == 1 ? 'Masculino' : 'Feminino' }}">
                        @endif
                    </div>
                    @if($material->isClothing == 0)
                        <div class="qty mb-3" id="quantity">
                            <label for="quantity">Quantidade:</label>
                            <input disabled type="number" class="form-control text-left" id="quantity" name="quantity" value="{{ $material->quantity }}">
                        </div>
                    @endif
                    <div class="internal mb-3">
                        <label for="isInternal">Material interno?</label>
                        <input disabled type="text" class="form-control" id="isInternal" name="isInternal" placeholder="{{ $material->isInternal == 1 ? 'Sim' : 'Não' }}">
                    </div>
                    <div class="clothing mb-3">
                        <label for="isClothing">É vestuário?</label>
                        <input disabled type="text" class="form-control" class="" name="isClothing" placeholder="{{ $material->isClothing == 1 ? 'Sim' : 'Não' }}">

                    </div>
                </div>


            </div>
            <div class="col-md-6">
                @if($material->isClothing==1 && !$material->sizes->isEmpty())



                    <div class="d-flex flex-row">
                        <div class="flex-column">
                            <div class="mb-3">
                                <p class="form-label font-weight-bold">Tamanho e stock: </p>
                            </div>
                            <div class="mb-3 mr-4 scrollable-column mr-5" id="size">
                                <div class="d-flex flex-column">
                                    @foreach($sizesAll as $sizeAll)
                                    @if(in_array($sizeAll->id, $material->sizes->pluck('id')->toArray()))
                                    <div class="d-flex justify-content-between align-items-center mb-2 px-5">
                                        <div class="form-check">
                                            <input disabled onchange="toggleFieldsQuantity()" class="form-check-input size-checkbox" type="checkbox" name="sizes[]"
                                            value="{{ $sizeAll->id }}" checked>
                                            <label class="form-check-label" for="size{{ $sizeAll->id }}">
                                                {{ $sizeAll->size }}
                                            </label>
                                        </div>

                                        <input disabled type="number" name="stocks[{{ $sizeAll->id }}]" value="{{ old('stocks.' . $sizeAll->id, $material->sizes->where('id', $sizeAll->id)->first()->pivot->stock ?? 0) }}"
                                        class="form-control w-25 mx-5 quantity-input" min="0">
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex-column">
                            <div class="mb-3">
                                <p class="form-label font-weight-bold">Cursos:</p>
                            </div>
                            <div class="mb-3 ml-4" id="role">
                                <div class="d-flex flex-column scrollable-column">
                                    @foreach($coursesAll as $courseAll)
                                        @if(in_array($courseAll->id, $material->courses->pluck('id')->toArray()))
                                            <div class="form-check">
                                                <input disabled class="form-check-input" type="checkbox" name="courses[]"
                                                       value="{{ $courseAll->id }}" checked>
                                                <label class="form-check-label" for="course{{ $courseAll->id }}">
                                                    {{ $courseAll->code }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    @elseif ($material->isClothing==1 && $material->sizes->isEmpty())

                    <div class="m-3">
                        <h1>Não existe stock disponivel</h1>
                    </div>

                @endif

            </div>
        </div>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary">Voltar</a>    </div>

    <style>


        .scrollable-column {
            max-height: 300px;
            overflow-y: auto;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        .gender{
            grid-area: gender;
        }
        .qty{
            grid-area: quantity;
        }
        .internal{
            grid-area: internal;
        }
        .clothing{
            grid-area: clothing;
        }

        .grid{
            display: grid;
            grid-template-areas:
                'internal clothing'
                'gender quantity';
            gap: 0 1rem;
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
        setTimeout(function() {
                $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 2000);
    </script>

@endsection
