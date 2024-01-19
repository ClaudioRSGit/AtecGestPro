@extends('master.main')

@section('content')

<h1>Alunos importados com sucesso!</h1>
<a href="{{ route('course-classes.index') }}" class="btn btn-primary">Voltar à página de turmas</a>

@endsection
