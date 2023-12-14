@extends('master.main')

@section('content')
    <div class="container">
        <h1>Criar Nova formação</h1>

        <form method="POST" action="{{ url('trainings') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome da formação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoria:</label>
                <textarea class="form-control" id="category" name="category">{{ old('category') }}</textarea>
            </div>



            <button type="submit" class="btn btn-primary">Criar formação</button>
            <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
