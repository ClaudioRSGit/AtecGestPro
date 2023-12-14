@extends('layouts.app')

@section('content')
    <h1>Editar Turma</h1>

    <form method="post" action="{{ route('classes.update', $courseClass->id) }}">
        @csrf
        @method('put')
        <button type="submit">Salvar Alterações</button>
    </form>
@endsection
