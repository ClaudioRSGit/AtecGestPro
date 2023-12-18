@extends('master.main')

@section('content')
    <div class="container">
        <h1>Detalhes do Vestuário</h1>

        <div class="row">
            <div class="col-md-6">


                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" disabled>{{ $clothing->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="supplier">Fornecedor:</label>
                    <input type="text" class="form-control" id="supplier" name="supplier" value="{{ $clothing->supplier }}" disabled>
                </div>

                <div class="form-group">
                    <label for="aquisition_date">Data de Aquisição:</label>
                    <input type="date" class="form-control" id="aquisition_date" name="aquisition_date" value="{{ $clothing->aquisition_date }}" disabled>
                </div>

                <div class="form-group">
                    <label for="isInternal">Material interno?</label>
                    <select class="form-control" id="isInternal" name="isInternal" disabled>
                        <option value="1" {{ $clothing->isInternal ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ !$clothing->isInternal ? 'selected' : '' }}>Não</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="isClothing">É vestuário?</label>
                    <select class="form-control" id="isClothing" name="isClothing" disabled>
                        <option value="1" selected>Sim</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Right column with the remaining form inputs -->

                <div class="form-group">
                    <label for="quantity">Quantidade:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $clothing->quantity }}" disabled>
                </div>


                    <div class="form-group">
                        <label for="gender">Género:</label>
                        <select class="form-control" id="gender" name="gender" disabled>
                            <option value="1" {{ $clothing->gender === 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="0" {{ $clothing->gender === 0 ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="size">Tamanho:</label>
                        <select class="form-control" id="size" name="size" disabled>
                            <option value="XS" {{ $clothing->size === 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ $clothing->size === 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ $clothing->size === 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ $clothing->size === 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ $clothing->size === 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ $clothing->size === 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="XXXL" {{ $clothing->size === 'XXXL' ? 'selected' : '' }}>XXXL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role">Função:</label>
                        <select class="form-control" id="role" name="role" disabled>
                            <option value="Formador" {{ $clothing->role === 'Formador' ? 'selected' : '' }}>Formador</option>
                            <option value="Formando" {{ $clothing->role === 'Formando' ? 'selected' : '' }}>Formando</option>
                            <option value="Técnico" {{ $clothing->role === 'Técnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
                    </div>


                <div class="form-group">
                    <label for="actions">Ações:</label>
                    <a href="{{ route('clothing.edit', $clothing->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('clothing.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
