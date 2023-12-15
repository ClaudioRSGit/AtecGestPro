@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Student</h1>

        <form method="post" action="{{ route('students.update', $student->id) }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
