@extends('master.main')

@section('content')

    <style>
        .container {
            font-family: 'Manrope', sans-serif;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 1%;
            right: 0%;
            bottom: 0%;
            left: 50%;
            position: fixed;
            background-image: radial-gradient(circle, rgba(17, 111, 220, 0.1), rgba(120, 143, 228, 0.2), rgba(173, 177, 237, 0.1), rgba(217, 215, 246, 0), rgba(255, 255, 255, 0.1));
            z-index: -1;
        }


    </style>
    <div class="container pl-4">
        <h1>Detalhes do agendamento da formação</h1>

        @if($partner_Training_Users)
            <table class="table">
                <tbody>
                <tr>
                    <th scope="row">Parceiro</th>
                    <td class="{{ optional($partner_Training_Users->partner)->name ? '' : 'text-danger' }}">
                        {{ optional($partner_Training_Users->partner)->name ?? 'O parceiro foi eliminado.' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">Morada do Parceiro</th>
                    <td class="{{ optional($partner_Training_Users->partner)->address ? '' : 'text-danger' }}">
                        {{ optional($partner_Training_Users->partner)->address ?? 'O parceiro foi eliminado.' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">Técnico</th>
                    <td class="{{ optional($partner_Training_Users->user)->name ? '' : 'text-danger' }}">
                        {{ optional($partner_Training_Users->user)->name ?? 'O técnico foi eliminado' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">Formação</th>
                    <td class="{{ optional($partner_Training_Users->training)->name ? '' : 'text-danger' }}">
                        {{ optional($partner_Training_Users->training)->name ?? 'This training record has been deleted.' }}
                    </td>
                </tr>

                <tr>
                    <th scope="row">Data de Início</th>
                    <td>{{ $partner_Training_Users->start_date }}</td>
                </tr>
                <tr>
                    <th scope="row">Data de Fim</th>
                    <td>{{ $partner_Training_Users->end_date }}</td>
                </tr>

                <tr>
                    <th scope="row">Materiais</th>
                    <td>
                        @php
                            $materialTraining = $partner_Training_Users->Material_Training()->whereHas('material')->get();
                        @endphp

                        @if($materialTraining->isNotEmpty())
                            <ul>
                                @foreach($materialTraining as $materialTrainings)
                                    <li>{{ $materialTrainings->material->name }} - Quantidade: {{ $materialTrainings->quantity }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Não existem materiais associados a esta formação</p>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th scope="row">Ações:</th>
                    <td>
                        <a href="{{ route('external.edit', $partner_Training_Users->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('external.index') }}" class="btn btn-primary">Voltar</a>
                    </td>
                </tr>
                </tbody>
            </table>
        @else
            <p>Não existem registos para esta formação</p>
        @endif
    </div>
@endsection
