@extends('layouts.app')

@section('content')
    <h1>Criar Nova Turma</h1>

    <form method="post" action="{{ route('classes.store') }}">
        @csrf
        <button type="submit">Criar Turma</button>
    </form>
@endsection
