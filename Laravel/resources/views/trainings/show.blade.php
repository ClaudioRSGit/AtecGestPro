@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes da formação</h1>

        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">ID:</th>
                    <td>{{ $training->id }}</td>
                </tr>
                <tr>
                    <th scope="row">Nome da formação:</th>
                    <td>{{ $training->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição:</th>
                    <td>{{ $training->description }}</td>
                </tr>
                <tr>
                    <th scope="row">Categoria:</th>
                    <td>{{ $training->isInternal ? 'Sim' : 'Não' }}</td>
                </tr>

                <tr>
                    <th scope="row">Ações:</th>
                    <td>
                        <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('trainings.index') }}" class="btn btn-primary">Voltar</a>
                    </td>
            </tbody>
        </table>
    </div>
@endsection
