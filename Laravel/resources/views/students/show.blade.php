@extends('master.main')

@section('content')
    <div class="container">
        <h1>Student Details</h1>

        <p>Name: {{ $student->name }}</p>

        <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
