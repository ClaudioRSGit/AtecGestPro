@extends('master.main')
@section('title', 'Detalhes do curso')

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


        <div>
            <div class="w-50">
                <div class="mb-3">
                    <label for="code" class="form-label">Nome do Curso:</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $course->code }}"
                        disabled>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição:</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ $course->description }}" disabled>
                </div>

                <div class="form-group">
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

    <script>
         setTimeout(function() {
            $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
@endsection
