@extends('master.main')
@section('title', 'Editar Curso')


@section('content')
    <div class="container">
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
        <form method="post" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('put')

            <div class="w-50">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Código do Curso:</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $course->code }}">

                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ $course->description }}">

                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                         <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

@endsection
