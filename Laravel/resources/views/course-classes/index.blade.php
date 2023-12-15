@extends('master.main')

@section('content')
    <div class="container">
        <h1>Turmas</h1>

        <a href="{{ route('course-classes.create') }}" class="btn btn-primary">Adicionar Turma</a>

        <div id="accordion">
            @foreach($courseClasses as $courseClass)
                <div class="card">
                    <div class="card-header" id="heading{{ $courseClass->id }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $courseClass->id }}" aria-expanded="false" aria-controls="collapse{{ $courseClass->id }}">
                                {{ $courseClass->description }}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{ $courseClass->id }}" class="collapse" aria-labelledby="heading{{ $courseClass->id }}" data-parent="#accordion">
                        <div class="card-body">
                            @if ($courseClass->students->count() > 0)
                            <ul>
                                    @foreach($courseClass->students as $student)
                                        <li>{{ $student->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Não existem estudantes nesta turma</p>
                            @endif
                        </div>
                    </div>


                </div>
                <a href="{{ route('course-classes.edit', $courseClass->id) }}" class="btn btn-warning">Editar Turma</a>
                    <a href="{{ route('course-classes.show', $courseClass->id) }}" class="btn btn-info">Ver Turma</a>
            @endforeach
        </div>

    </div>
    {{ $courseClasses->links() }}

@endsection
