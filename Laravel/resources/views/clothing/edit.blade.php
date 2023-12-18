@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Vestuário</h1> clothing

        <form method="post" action="{{ route('clothing.update', $clothing->id) }}">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Vestuário:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $clothing->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ $clothing->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Fornecedor:</label>
                        <input type="text" class="form-control" id="supplier" name="supplier" value="{{ $clothing->supplier }}">
                    </div>
                    <div class="mb-3">
                        <label for="aquisition_date" class="form-label">Data de Aquisição:</label>
                        <input type="date" class="form-control" id="aquisition_date" name="aquisition_date" value="{{ $clothing->aquisition_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="isInternal" class="form-label">Interno:</label>
                        <select class="form-select" id="isInternal" name="isInternal">
                            <option value="1" {{ $clothing->isInternal ? 'selected' : '' }}>Sim</option>
                            <option value="0" {{ !$clothing->isInternal ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="isClothing" class="form-label">É vestuário?</label>
                        <select class="form-select" id="isClothing" name="isClothing">
                            <option value="1" selected>Sim</option>
                        </select>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender">Género:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="1" {{ $clothing->gender === 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="0" {{ $clothing->gender === 0 ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $clothing->quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="size">Tamanho:</label>
                        <select class="form-control" id="size" name="size">
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
                        <select class="form-control" id="role" name="role">
                            <option value="Formador" {{ $clothing->role === 'Formador' ? 'selected' : '' }}>Formador</option>
                            <option value="Formando" {{ $clothing->role === 'Formando' ? 'selected' : '' }}>Formando</option>
                            <option value="Técnico" {{ $clothing->role === 'Técnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="actions">Ações:</label>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="{{ route('clothing.show', $clothing->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </div>
                </div>

                </div>

            </div>



        </form>
    </div>
@endsection
