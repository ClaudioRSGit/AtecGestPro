@extends('master.main')

@section('content')

<div class="container">
    <form action="{{ route('import-excel.importStudents') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Excel - Importar Alunos</label><br>
            <input type="file" name="file" id="file" class="btn" text="Escolher ficheiro">
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>
    </form>
</div>

@endsection
