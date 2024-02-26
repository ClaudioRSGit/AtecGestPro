@extends('master.main')

@section('content')

<div class="container w-100 fade-in">
    <form action="{{ route('import-excel.importStudents') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Excel - Importar Alunos</label><br>
            <label for="file" class="btn btn-primary">Selecionar ficheiro</label><br>
            <input type="file" name="file" id="file" class="btn" style="display: none;">
            @error('attachment')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <p>Certifique-se que o arquivo tem menos de 20MB</p>
        </div>
        <button type="submit" name="withStudents" class="btn btn-primary">Importar</button>
        <button type="submit" name="withoutStudents" class="btn btn-secondary">Voltar</button>
    </form>
</div>

@endsection
