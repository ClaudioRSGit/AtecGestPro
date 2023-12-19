@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Vestuário</h1> clothing

        <form method="post" action="{{ route('clothing-assignment.update', $clothing_assignment->id) }}">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Vestuário:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $clothing_assignment->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ $clothing_assignment->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Fornecedor:</label>
                        <input type="text" class="form-control" id="supplier" name="supplier" value="{{ $clothing_assignment->supplier }}">
                    </div>
                    <div class="mb-3">
                        <label for="aquisition_date" class="form-label">Data de Aquisição:</label>
                        <input type="date" class="form-control" id="aquisition_date" name="aquisition_date" value="{{ $clothing_assignment->aquisition_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="isInternal" class="form-label">Interno:</label>
                        <select class="form-select" id="isInternal" name="isInternal">
                            <option value="1" {{ $clothing_assignment->isInternal ? 'selected' : '' }}>Sim</option>
                            <option value="0" {{ !$clothing_assignment->isInternal ? 'selected' : '' }}>Não</option>
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
                            <option value="1" {{ $clothing_assignment->gender === 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="0" {{ $clothing_assignment->gender === 0 ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $clothing_assignment->quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="size">Tamanho:</label>
                        <select class="form-control" id="size" name="size">
                            <option value="XS" {{ $clothing_assignment->size === 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ $clothing_assignment->size === 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ $clothing_assignment->size === 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ $clothing_assignment->size === 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ $clothing_assignment->size === 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ $clothing_assignment->size === 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="XXXL" {{ $clothing_assignment->size === 'XXXL' ? 'selected' : '' }}>XXXL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role">Função:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="Formador" {{ $clothing_assignment->role === 'Formador' ? 'selected' : '' }}>Formador</option>
                            <option value="Formando" {{ $clothing_assignment->role === 'Formando' ? 'selected' : '' }}>Formando</option>
                            <option value="Técnico" {{ $clothing_assignment->role === 'Técnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="actions">Ações:</label>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="{{ route('clothing-assignment.show', $clothing_assignment->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </div>
                </div>

                </div>

            </div>



        </form>
    </div>
@endsection
