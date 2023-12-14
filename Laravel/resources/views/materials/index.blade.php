@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Materiais</h1>

    <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Novo Material</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
                <tr>
                    <th scope="row">{{ $material->id }}</th>
                    <td>{{ $material->name }}</td>
                    <td>{{ $material->description }}</td>
                    <td>
                        <a href="{{ route('materials.show', $material->id) }}" class="btn btn-info">Detalhes</a>
                        <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning">Editar</a>
                        <form method="post" action="{{ route('materials.destroy', $material->id) }}" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
