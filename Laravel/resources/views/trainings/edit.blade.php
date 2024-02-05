@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Training</h1>

        <form method="post" action="{{ route('trainings.update', $training->id) }}" class="w-70">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Nome da formação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $training->name }}">

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description">{{ $training->description }}</textarea>

                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isInternal" class="form-label">Categoria</label>
                <textarea class="form-control" id="category" name="category">{{ $training->category }}</textarea>


                @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="buttons d-flex justify-content-start align-items-center">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>

    </div>
@endsection
