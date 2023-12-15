@extends('master.main')

@section('content')
    <div class="container">
        <h1>Add Student</h1>

        <form method="post" action="{{ route('students.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <button type="submit" class="btn btn-primary">Add Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
