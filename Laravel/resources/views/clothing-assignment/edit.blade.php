@extends('master.main')

@section('content')
    <div class="container pl-5 pt-4">
        <h1>Editar Vestuário</h1>

        <form method="post" action="{{ route('clothing-assignment.update', $clothes->id) }}">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Vestuário:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $clothes->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ $clothes->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Fornecedor:</label>
                        <input type="text" class="form-control" id="supplier" name="supplier" value="{{ $clothes->supplier }}">
                    </div>
                    <div class="mb-3">
                        <label for="aquisition_date" class="form-label">Data de Aquisição:</label>
                        <input type="date" class="form-control" id="aquisition_date" name="aquisition_date" value="{{ $clothes->aquisition_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="isInternal" class="form-label">Interno:</label>
                        <select class="form-select" id="isInternal" name="isInternal">
                            <option value="1" {{ $clothes->isInternal ? 'selected' : '' }}>Sim</option>
                            <option value="0" {{ !$clothes->isInternal ? 'selected' : '' }}>Não</option>
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
                            <option value="1" {{ $clothes->gender === 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="0" {{ $clothes->gender === 0 ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $clothes->quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="size">Tamanho:</label>
                        <select class="form-control" id="size" name="size">
                            <option value="XS" {{ $clothes->size === 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ $clothes->size === 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ $clothes->size === 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ $clothes->size === 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ $clothes->size === 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ $clothes->size === 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="XXXL" {{ $clothes->size === 'XXXL' ? 'selected' : '' }}>XXXL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role">Função:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="Formador" {{ $clothes->role === 'Formador' ? 'selected' : '' }}>Formador</option>
                            <option value="Formando" {{ $clothes->role === 'Formando' ? 'selected' : '' }}>Formando</option>
                            <option value="Técnico" {{ $clothes->role === 'Técnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="actions">Ações:</label>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </div>
                </div>

                </div>

            </div>



        </form>
    </div>
@endsection
