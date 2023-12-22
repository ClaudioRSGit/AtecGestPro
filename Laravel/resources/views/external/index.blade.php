@extends('master.main')

@section('content')
    <div class="container pl-5 pt-4">
        <h1>Formações Externas</h1>

        <div class="mb-3" id="buttons">
            <button id="btnTrainings" class="btn btn-primary" onclick="showTable('trainingsTable', 'partnersTable')">Gestão de Formações</button>
            <button id="btnPartners" class="btn btn-primary ml-3" onclick="showTable('partnersTable', 'trainingsTable')">Gestão de Parceiros</button>
        </div>

        <div id="trainingsTable">
            <a href="{{ route('external.create') }}" class="btn btn-primary mb-3">Nova Formação</a>

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
                        @foreach ($partner_Trainings_Users as $partner_Trainings_User)
                            <tr>
                                <td>{{ optional($partner_Trainings_User->partner)->name }}</td>
                                <td>{{ optional($partner_Trainings_User->partner)->address }}</td>
                                <td>{{ optional($partner_Trainings_User->user)->name }}</td>
                                <td>{{ optional($partner_Trainings_User->training)->name ?: 'N.A.' }}</td>
                                <td>{{ $partner_Trainings_User->start_date }}</td>
                                <td>
                                    <a href="{{ route('external.show', $partner_Trainings_User->id) }}"
                                        class="btn btn-info btn-sm">Detalhes</a>
                                    <a href="{{ route('external.edit', $partner_Trainings_User->id) }}"
                                        class="btn btn-warning btn-sm">Editar</a>

                                    <form method="post"
                                        action="{{ route('external.destroy', $partner_Trainings_User->id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div id="partnersTable" style="display: none;">
            <a href="{{ route('external.create') }}" class="btn btn-primary mb-3">Novo Parceiro</a>

            <div>
                <table class="table bg-white">
                    <thead>
                        <tr>
                            <th scope="col">Parceiro</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Morada</th>
                            <th scope="col">Contactos</th>
                            <th scope="col">Formações</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $partner)
                            <tr>
                                <td>{{ $partner->name }}</td>
                                <td>{{ $partner->description }}</td>
                                <td>{{ $partner->address }}</td>
                                <td>{{ $partner->contacts }}</td>
                                <td><button>View</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showTable('trainingsTable', 'partnersTable');
        });

        function showTable(showId, hideId) {
            document.getElementById(showId).style.display = 'block';
            document.getElementById(hideId).style.display = 'none';
        }
    </script>

@endsection
