@extends('master.main')

@section('content')
    <div class="container">
        <h1>Criar Novo Vestuário</h1>

        <form method="post" action="{{ route('clothing-assignment.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Vestuário:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="supplier" class="form-label">Fornecedor:</label>
                        <input type="text" class="form-control" id="supplier" name="supplier" value="{{ old('supplier') }}">
                    </div>

                    <div class="mb-3">
                        <label for="aquisition_date" class="form-label">Data de Aquisição:</label>
                        <input type="date" class="form-control" id="aquisition_date" name="aquisition_date" value="{{ old('aquisition_date') }}">
                    </div>

                    <div class="mb-3">
                        <label for="isInternal" class="form-label">Interno:</label>
                        <select class="form-select" id="isInternal" name="isInternal">
                            <option value="1" {{ old('isInternal') == 1 ? 'selected' : '' }}>Sim</option>
                            <option value="0" {{ old('isInternal') == 0 ? 'selected' : '' }}>Não</option>
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
                    <div class="mb-3">
                        <label for="gender" class="form-label">Género:</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="0" {{ old('gender') == 0 ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
                    </div>

                    <div class="mb-3">
                        <label for="size" class="form-label">Tamanho:</label>
                        <select class="form-select" id="size" name="size">
                            <option value="XS" {{ old('size') == 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ old('size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="XXXL" {{ old('size') == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Função:</label>
                        <select class="form-select" id="role" name="role">
                            <option value="Formador" {{ old('role') == 'Formador' ? 'selected' : '' }}>Formador</option>
                            <option value="Formando" {{ old('role') == 'Formando' ? 'selected' : '' }}>Formando</option>
                            <option value="Técnico" {{ old('role') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="actions" class="form-label">Ações:</label>
                        <button type="submit" class="btn btn-primary">Criar Vestuário</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
