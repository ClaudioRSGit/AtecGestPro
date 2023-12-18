@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar Curso</h1>

        <form method="post" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('put')

            <div class="row">
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
                        <form method="post" action="{{ route('courses.destroy', $course->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                         <a href="{{ route('courses.show', $course->id) }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="deleteForm" action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>
    </div>

@endsection
