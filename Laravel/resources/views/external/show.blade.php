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

        @if($partner_Trainings_User)
            <table class="table">
                <tbody>
                <tr>
                    <th scope="row">Parceiro</th>
                    <td>{{ $partner_Trainings_User->partner->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Morada do Parceiro</th>
                    <td>{{ $partner_Trainings_User->partner->address }}</td>
                </tr>
                <tr>
                    <th scope="row">Técnico</th>
                    <td>{{ $partner_Trainings_User->user->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Formação</th>
                    <td>{{ $partner_Trainings_User->training->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Data de Início</th>
                    <td>{{ $partner_Trainings_User->start_date }}</td>
                </tr>
                <tr>
                    <th scope="row">Data de Fim</th>
                    <td>{{ $partner_Trainings_User->end_date }}</td>
                </tr>

                <tr>
                    <th scope="row">Materiais</th>
                    <td>
                        @if($partner_Trainings_User->Material_Training->isNotEmpty())
                            <ul>
                                @foreach($partner_Trainings_User->Material_Training as $materialTraining)
                                    <li>{{ $materialTraining->material->name }} - Quantidade: {{ $materialTraining->quantity }}</li>
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
                        <a href="{{ route('external.edit', $partner_Trainings_User->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('external.index') }}" class="btn btn-primary">Voltar</a>
                    </td>
                </tr>
                </tbody>
            </table>
        @else
            <p>No data available for this agendamento.</p>
        @endif
    </div>
@endsection
