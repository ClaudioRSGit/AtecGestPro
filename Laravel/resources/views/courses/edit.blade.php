@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">
        <h1>Editar Curso</h1>

        <form method="post" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('put')

            <div class="courseInfo">
                <div>
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
