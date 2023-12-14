@extends('layouts.app')

@section('content')
    <h1>Lista de Turmas</h1>

    <ul>
        @foreach($courseClasses as $courseClass)
            <li>
                <a href="{{ route('classes.show', $courseClass->id) }}">{{ $courseClass->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
