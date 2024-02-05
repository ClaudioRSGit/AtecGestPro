@extends('master.main')

@section('content')

<div class="container">
    <h1>Alunos importados com sucesso!</h1>
    <a href="{{ route('course-classes.index') }}" class="btn btn-primary">Voltar à página de turmas</a>
</div>

@endsection
