@extends('master.main')

@section('content')

<div class="container w-100 fade-in">
    <h1>{{ $message }}</h1>
    <a href="{{ route('users.index') }}" class="btn btn-primary">Voltar à página de utilizadores</a>
</div>

@endsection
