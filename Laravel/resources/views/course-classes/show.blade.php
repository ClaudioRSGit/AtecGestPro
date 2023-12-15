@extends('master.main')

@section('content')
    <div class="container">
        <h1>{{ $courseClass->description }}</h1>
        <h2>Students:</h2>
        <ul>
            @foreach($students as $student)
                <li>{{ $student->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
