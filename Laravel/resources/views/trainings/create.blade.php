@extends('master.main')
@section('title', 'Criar Formação')
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
        <form method="POST" action="{{ url('trainings') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome da formação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>

                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoria:</label>
                <textarea class="form-control" id="category" name="category">{{ old('category') }}</textarea>

                @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>



            <button type="submit" class="btn btn-primary">Criar formação</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
