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
                    <textarea class="form-control" id="description" name="description" rows="3" disabled>{{ $material->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="supplier">Fornecedor:</label>
                    <input type="text" class="form-control" id="supplier" name="supplier" value="{{ $material->supplier }}" disabled>
                </div>

                <div class="form-group">
                    <label for="aquisition_date">Data de Aquisição:</label>
                    <input type="date" class="form-control" id="aquisition_date" name="aquisition_date" value="{{ $material->aquisition_date }}" disabled>
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

                    <div class="form-group">
                        <label for="size">Tamanho:</label>
                        <select class="form-control" id="size" name="size" disabled>
                            <option value="XS" {{ $material->size === 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ $material->size === 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ $material->size === 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ $material->size === 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ $material->size === 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ $material->size === 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="XXXL" {{ $material->size === 'XXXL' ? 'selected' : '' }}>XXXL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role">Função:</label>
                        <select class="form-control" id="role" name="role" disabled>
                            <option value="Formador" {{ $material->role === 'Formador' ? 'selected' : '' }}>Formador</option>
                            <option value="Formando" {{ $material->role === 'Formando' ? 'selected' : '' }}>Formando</option>
                            <option value="Técnico" {{ $material->role === 'Técnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
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
        setTimeout(function() {
                $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 2000);
    </script>
@endsection
