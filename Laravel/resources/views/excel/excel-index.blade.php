@extends('master.main')

@section('content')

<h1>Utilizadores importados com sucesso!</h1>
<a href="{{ route('users.index') }}" class="btn btn-primary">Voltar à página de utilizadores</a>

@endsection
