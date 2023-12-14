@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Material</h1>

        <form method="post" action="{{ route('materials.update', $material->id) }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Material:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $material->name }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" id="description" name="description">{{ $material->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="isInternal" class="form-label">Interno:</label>
                <select class="form-select" id="isInternal" name="isInternal">
                    <option value="1" {{ $material->isInternal ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ !$material->isInternal ? 'selected' : '' }}>Não</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $material->quantity }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>

        <a href="{{ route('materials.show', $material->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
@endsection
