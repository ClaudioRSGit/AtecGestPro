@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar Novo Material</h1>

        <form method="post" action="{{ route('materials.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Material:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="isInternal" class="form-label">Interno:</label>
                <select class="form-select" id="isInternal" name="isInternal">
                    <option value="1" {{ old('isInternal') == 1 ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ old('isInternal') == 0 ? 'selected' : '' }}>Não</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
            </div>

            <button type="submit" class="btn btn-primary">Criar Material</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
