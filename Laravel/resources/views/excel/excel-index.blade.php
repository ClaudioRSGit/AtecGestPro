@extends('master.main')

@section('content')

<div class="container">
    <h1>Utilizadores importados com sucesso!</h1>
    <a href="{{ route('users.index') }}" class="btn btn-primary">Voltar à página de utilizadores</a>
</div>

@endsection
