@extends('master.main')

@section('content')
    <div class="container pl-5 pt-4">
        <h1>Lista de formações de mercado</h1>

        <a href="{{ route('external.create') }}" class="btn btn-primary mb-3">Novo agendamento</a>

        <div>
            <table class="table bg-white">
                <thead>
                <tr>
                    <th scope="col">Parceiro</th>
                    <th scope="col">Morada</th>
                    <th scope="col">Técnico</th>
                    <th scope="col">Formação</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($partner_Trainings_Users as $partner_Trainings_User)
                    <tr>
                        <td>{{ optional($partner_Trainings_User->partner)->name }}</td>
                        <td>{{ optional($partner_Trainings_User->partner)->address }}</td>
                        <td>{{ optional($partner_Trainings_User->user)->name }}</td>
                        <td>{{ optional($partner_Trainings_User->training)->name ?: 'N.A.' }}</td>
                        <td>{{ $partner_Trainings_User->start_date }}</td>
                        <td>
                            <a href="{{ route('external.show', $partner_Trainings_User->id) }}" class="btn btn-info btn-sm">Detalhes</a>
                            <a href="{{ route('external.edit', $partner_Trainings_User->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form method="post" action="{{ route('external.destroy', $partner_Trainings_User->id) }}" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $partner_Trainings_Users->links() }}
    </div>
@endsection


