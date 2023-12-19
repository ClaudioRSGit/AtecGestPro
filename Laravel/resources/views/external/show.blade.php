@extends('master.main')

@section('content')
    <div class="container">
        <h1>Detalhes do agendamento</h1>

        @if($partner_Trainings_Users)
            <table class="table">
                <tbody>
                <tr>
                    <th scope="row">Parceiro</th>
                    <td>{{ $partner_Trainings_Users->partner->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Morada do Parceiro</th>
                    <td>{{ $partner_Trainings_Users->partner->address }}</td>
                </tr>
                <tr>
                    <th scope="row">Técnico</th>
                    <td>{{ $partner_Trainings_Users->user->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Formação</th>
                    <td>{{ $partner_Trainings_Users->training->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Data de Início</th>
                    <td>{{ $partner_Trainings_Users->start_date }}</td>
                </tr>
                <tr>
                    <th scope="row">Data de Fim</th>
                    <td>{{ $partner_Trainings_Users->end_date }}</td>
                </tr>

                <tr>
                    <th scope="row">Ações:</th>
                    <td>
                        <a href="{{ route('trainings.edit', $partner_Trainings_Users->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('trainings.index') }}" class="btn btn-primary">Voltar</a>
                    </td>
                </tr>
                </tbody>
            </table>
        @else
            <p>No data available for this agendamento.</p>
        @endif
    </div>
@endsection
