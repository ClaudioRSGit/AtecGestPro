@extends('master.main')

@section('content')
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
