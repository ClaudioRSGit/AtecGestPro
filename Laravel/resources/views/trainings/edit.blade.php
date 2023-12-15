@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Training</h1>

        <form method="post" action="{{ route('trainings.update', $training->id) }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Nome da formação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $training->name }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description">{{ $training->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="isInternal" class="form-label">Categoria</label>
                <textarea class="form-control" id="category" name="category">{{ $training->category }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>

        <a href="{{ route('trainings.show', $training->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
@endsection
