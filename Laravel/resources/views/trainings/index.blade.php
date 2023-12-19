@extends('master.main')

@section('content')
    <div class="container pl-5 pt-4">
        <h1>Lista de Trainings</h1>

    <a href="{{ route('trainings.create') }}" class="btn btn-primary mb-3">Novo Training</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome da formação</th>
                <th scope="col">Descrição</th>
                <th scope="col">Categoria</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trainings as $training)
                <tr>
                    <th scope="row">{{ $training->id }}</th>
                    <td>{{ $training->name }}</td>
                    <td>{{ $training->description }}</td>
                    <td>{{ $training->category }}</td>
                    <td>
                        <a href="{{ route('trainings.show', $training->id) }}" class="btn btn-info">Detalhes</a>
                        <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning">Editar</a>
                        <form method="post" action="{{ route('trainings.destroy', $training->id) }}" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $trainings->links() }}
    </div>
@endsection
