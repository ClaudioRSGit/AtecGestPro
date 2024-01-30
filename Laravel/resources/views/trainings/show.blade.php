@extends('master.main')

@section('content')
    <div class="container">
        <h1>Detalhes da formação</h1>

        <div class="w-50 mb-3">
            <div>
                <label>ID:</label>
                <input class="form-control" value="{{ $training->id }}" disabled>
            </div>

            <div>
                <label>Nome da formação:</label>
                <input class="form-control" value="{{ $training->name }}" disabled>
            </div>

            <div>
                <label>Descrição:</label>
                <input class="form-control" value="{{ $training->description }}" disabled>
            </div>

            <div>
                <label>Categoria:</label>
                <input class="form-control" value="{{ $training->isInternal ? 'Sim' : 'Não' }}" disabled>
            </div>


        </div>
        <div>
            <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-primary">Editar</a>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
@endsection
