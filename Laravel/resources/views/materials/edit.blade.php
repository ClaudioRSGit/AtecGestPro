@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Material</h1>

        <form method="post" action="{{ route('materials.update', $material->id) }}">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Material:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $material->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ $material->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Fornecedor:</label>
                        <input type="text" class="form-control" id="supplier" name="supplier" value="{{ $material->supplier }}">
                    </div>
                    <div class="mb-3">
                        <label for="aquisition_date" class="form-label">Data de Aquisição:</label>
                        <input type="date" class="form-control" id="aquisition_date" name="aquisition_date" value="{{ $material->aquisition_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="isInternal" class="form-label">Interno:</label>
                        <select class="form-select" id="isInternal" name="isInternal">
                            <option value="1" {{ $material->isInternal ? 'selected' : '' }}>Sim</option>
                            <option value="0" {{ !$material->isInternal ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="isClothing" class="form-label">É vestuário?</label>
                        <select class="form-select" id="isClothing" name="isClothing">
                            <option value="1" {{ $material->isClothing ? 'selected' : '' }}>Sim</option>
                            <option value="0" {{ !$material->isClothing ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group" id="gender">
                        <label for="gender">Género:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="1" {{ $material->gender === 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="0" {{ $material->gender === 0 ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $material->quantity }}">
                    </div>
                    <div class="form-group" id="size">
                        <label for="size">Tamanho:</label>
                        <select class="form-control" id="size" name="size">
                            <option value="XS" {{ $material->size === 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ $material->size === 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ $material->size === 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ $material->size === 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ $material->size === 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ $material->size === 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="XXXL" {{ $material->size === 'XXXL' ? 'selected' : '' }}>XXXL</option>
                        </select>
                    </div>

                    <div class="form-group" id="role">
                        <label for="role">Função:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="Formador" {{ $material->role === 'Formador' ? 'selected' : '' }}>Formador</option>
                            <option value="Formando" {{ $material->role === 'Formando' ? 'selected' : '' }}>Formando</option>
                            <option value="Técnico" {{ $material->role === 'Técnico' ? 'selected' : '' }}>Técnico</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="actions">Ações:</label>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function toggleFields() {
            var isClothingValue = document.getElementById('isClothing').value;
            var gender = document.getElementById('gender');
            var size = document.getElementById('size');
            var role = document.getElementById('role');

            gender.style.display = isClothingValue == 0 ? 'none' : 'block';
            size.style.display = isClothingValue == 0 ? 'none' : 'block';
            role.style.display = isClothingValue == 0 ? 'none' : 'block';
        }

        document.addEventListener('DOMContentLoaded', toggleFields);

        document.getElementById('isClothing').addEventListener('change', toggleFields);
    </script>
@endsection
