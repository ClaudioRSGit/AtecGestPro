@extends('master.main')
@section('title', 'Detalhes da formação')
@section('content')
    <div class="w-100">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#success-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#error-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif
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
