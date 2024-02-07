@extends('master.main')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <h1>Detalhes do Curso</h1>

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

    <script type="module" src="{{ asset('js/courses/show.js') }}"></script>
@endsection
