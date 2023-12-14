@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Material</h1>

        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">ID:</th>
                    <td>{{ $material->id }}</td>
                </tr>
                <tr>
                    <th scope="row">Nome do Material:</th>
                    <td>{{ $material->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição:</th>
                    <td>{{ $material->description }}</td>
                </tr>
                <tr>
                    <th scope="row">Interno:</th>
                    <td>{{ $material->isInternal ? 'Sim' : 'Não' }}</td>
                </tr>

                <tr>
                    <th scope="row">Ações:</th>
                    <td>
                        <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('materials.index') }}" class="btn btn-primary">Voltar</a>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
