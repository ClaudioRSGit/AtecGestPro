@extends('master.main')

@section('content')
    <div class="container">
        <h1>Detalhes do Curso</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="code" class="form-label">Nome do Curso:</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $course->code }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição:</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $course->description }}" disabled>
                </div>

                <div class="form-group">
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
