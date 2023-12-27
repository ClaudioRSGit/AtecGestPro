@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Parceiro</h1>
        <form method="post" action="{{ route('external.updatePartner', $partner->id) }}">

            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Parceiro:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Morada:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>


            <button type="submit" class="btn btn-primary">Atualizar Parceiro</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </form>
    </div>
@endsection
