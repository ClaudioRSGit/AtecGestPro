@extends('master.main')
@section('title', 'Lista de Formações')
@section('content')
    <div class="w-100">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#success-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#error-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif
    <a href="{{ route('trainings.create') }}" class="btn btn-primary mb-3">Nova formação</a>

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
