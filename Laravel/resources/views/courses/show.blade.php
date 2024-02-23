@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <h1>Detalhes do Curso</h1>

        <div class="w-100 d-flex justify-content-between">
            <div class="w-50">
                <div class="mb-3">
                    <label for="code" class="form-label">Nome do Curso:</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $course->code }}"
                        disabled>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição:</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ $course->description }}" disabled>
                </div>

                <div class="form-group">
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>

            <div class="w-25 mr-10">
                @if($courseClasses->isEmpty())
                    <p class="pl-2 pb-2 font-weight-bold text-danger" style="text-align: center">Não existem
                        turmas neste curso</p>
                @else
                    <label for="students">Turmas com este curso:</label>
                    <div class="form-group border">
                        <ul class="mt-2">
                            @foreach($courseClasses as $courseClass)
                                <li>{{ $courseClass->description }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/courses/show.js') }}"></script>
@endpush

