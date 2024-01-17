@extends('master.main')

@section('content')
    <div class="container">
        <h1>Detalhes do Material</h1>
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">

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
                           name="acquisition_date" value="{{ !empty($material->acquisition_date) ? $material->acquisition_date : 'Não disponível' }}" >

                </div>

                @if($material->isClothing == 0)
                    <div class="mb-3" id="quantity">
                        <label for="quantity">Quantidade:</label>
                        <input disabled type="number" class="form-control" id="quantity" name="quantity" value="{{ $material->quantity }}">
                    </div>
                @endif

            </div>
            <div class="col-md-6">
                <div class="row d-flex">
                    <div class="mx-3">
                        <label for="isInternal">Material interno?</label>
                        <input disabled type="text" id="isInternal" name="isInternal" placeholder="{{ $material->isInternal == 1 ? 'Sim' : 'Não' }}">
                    </div>
                    <div class="mx-3">
                        <label for="isClothing">É vestuário?</label>
                        <input disabled type="text" class="" name="isClothing" placeholder="{{ $material->isClothing == 1 ? 'Sim' : 'Não' }}">

                    </div>
                    <div class="mx-3 " id="gender">
                        <label for="gender">Género:</label>
                        <input disabled type="text" name="gender" placeholder="{{ $material->gender == 1 ? 'Masculino' : 'Femenino' }}">

                    </div>
                </div>

                @if($material->isClothing==1)



                    <div class="d-flex flex-row" id="labels">

                        <div class="col-8">
                            <div class="mb-3">
                                <p class="form-label font-weight-bold">Tamanho e stock: </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-3">
                                <p class="form-label font-weight-bold">Cursos:</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="flex-column me-4 scrollable-column mr-5">
                            <div class="mb-3" id="size">
                                <div class="d-flex flex-column">
                                    @foreach($sizesAll as $sizeAll)
                                        @if(in_array($sizeAll->id, $material->sizes->pluck('id')->toArray()))
                                            <div class="d-flex align-items-center mb-2">
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
                            <div class="mb-3" id="role">
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


                @endif

                <div class="m-3">


                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <style>


        .scrollable-column {
            max-height: 300px;
            overflow-y: auto;
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
