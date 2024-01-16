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
                <!-- Left column with the form inputs and displayed information -->

                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $material->description }}" disabled>
                </div>

                <div class="form-group">
                    <label for="supplier">Fornecedor:</label>
                    <input type="text" class="form-control" id="supplier" name="supplier"
                           value="{{ !empty($material->supplier) ? $material->supplier : 'Não disponível' }}" disabled>
                </div>


                <div class="form-group">
                    <label for="acquisition_date">Data de Aquisição:</label>
                    <input type="text" class="form-control" id="acquisition_date" name="acquisition_date" value="{{ !empty($material->acquisition_date) ? $material->acquisition_date : 'Não disponível' }}" disabled>

                </div>


                <div class="form-group">
                    <label for="isInternal">Material interno?</label>
                    <select class="form-control" id="isInternal" name="isInternal" disabled>
                        <option value="1" {{ $material->isInternal ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ !$material->isInternal ? 'selected' : '' }}>Não</option>
                    </select>
                </div>

                @if($material->isClothing)
                <div class="form-group">
                    <label for="isClothing">É vestuário?</label>
                    <select class="form-control" id="isClothing" name="isClothing" disabled>
                        <option value="1" {{ $material->isClothing ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ !$material->isClothing ? 'selected' : '' }}>Não</option>
                    </select>
                </div>
                @endif
            </div>

            <div class="col-md-6">
                <!-- Right column with the remaining form inputs -->

                <div class="form-group">
                    <label for="quantity">Quantidade:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $material->quantity }}" disabled>
                </div>

                @if($material->isClothing)
                    <!-- Show these fields only if it's clothing -->
                    <div class="form-group">
                        <label for="gender">Género:</label>
                        <select class="form-control" id="gender" name="gender" disabled>
                            <option value="1" {{ $material->gender === 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="0" {{ $material->gender === 0 ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>

                    <div class="d-flex flex-column">
                        <label for="size">Tamanhos:</label>

                        @foreach($sizes as $size)
                            <div class="row">
                                <div class="col-md-5 col-12 mb-2">
                                    <p class="mb-0">Tamanho: {{ $size->size }}</p>
                                </div>
                                <div class="col-md-5 col-12 mb-2">
                                    <p class="mb-0">Stock: {{ $size->pivot->stock }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>



<div class="row">

    <div class="col-md-5 col-12 mb-2">
        <h5 class="mt-3">Cursos:</h5>
        @foreach($courses as $course)
            <p class="mb-0">Curso: {{ $course->code }}</p>
        @endforeach
    </div>

</div>
                @endif

                <div class="form-group">
                    <label for="actions">Ações:</label>
                    <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <script>
          window.setTimeout(function() {
                $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 2000);
    </script>
@endsection
