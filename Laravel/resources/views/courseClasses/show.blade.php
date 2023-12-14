@extends('layouts.app')

@section('content')
    <h1>Detalhes da Turma</h1>

    <p>Nome da Turma: {{ $courseClass->name }}</p>
@endsection
