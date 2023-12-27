@extends('master.main')

@section('content')
    <div class="container">
        <h1>Criar Novo Parceiro</h1>

        <form method="post" action="{{ route('partners.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
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

                    <div class="mb-3">
                        <label for="actions" class="form-label">Ações:</label>
                        <button type="submit" class="btn btn-primary">Criar Parceiro</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
