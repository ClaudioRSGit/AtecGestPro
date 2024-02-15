@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Criar Novo Curso</h1>

        <form class="w-50" method="post" action="{{ route('courses.store') }}" enctype="multipart/form-data" id="courseForm">
            @csrf
            @method('POST')

                    <div class="mb-3">
                        <label for="code" class="form-label">Código do Curso:</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">

                        @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">

                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                    </div>

            <button type="submit" class="btn btn-primary">Criar Curso</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
