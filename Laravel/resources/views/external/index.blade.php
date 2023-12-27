@extends('master.main')

@section('content')
    <div class="container pl-5 pt-4">
        <h1>Formações de mercado</h1>

        <div class="mb-3" id="buttons">
            <button id="btnTrainings" class="btn btn-primary" onclick="showTable('trainingsTable', 'partnersTable')">Gestão de
                Formações</button>
            <button id="btnPartners" class="btn btn-primary ml-3" onclick="showTable('partnersTable', 'trainingsTable')">Gestão
                de Parceiros</button>
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
                        <tr class="filler"></tr>
                        @foreach ($partner_Trainings_Users as $partner_Trainings_User)
                            <tr class="partner_{{ $partner_Trainings_User->partner_id }} customTableStyling" style="display: none;">
                                <td>{{ optional($partner_Trainings_User->partner)->name }}</td>
                                <td>{{ optional($partner_Trainings_User->partner)->address }}</td>
                                <td>{{ optional($partner_Trainings_User->user)->name }}</td>
                                <td>{{ optional($partner_Trainings_User->training)->name ?: 'N.A.' }}</td>
                                <td>{{ $partner_Trainings_User->start_date }}</td>
                                <td class="d-flex">
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
                            <tr class="filler"></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div id="partnersTable" style="display: none;">
            <a href="{{ route('external.createPartner') }}" class="btn btn-primary mb-3">Novo Parceiro</a>

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
                        <tr class="filler"></tr>
                        @foreach ($partners as $partner)
                            <tr class="customTableStyling">
                                <td>{{ $partner->name }}</td>
                                <td>{{ $partner->description }}</td>
                                <td>{{ $partner->address }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="contactDropdown{{ $partner->id }}" data-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="contactDropdown{{ $partner->id }}">
                                            @foreach ($partner->partnerContacts as $contact)
                                                <a class="dropdown-item" href="#">{{ $contact->contact }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm"
                                        onclick="filterTrainingsTable({{ $partner->id }})">View</button>
                                </td>
                                <td>
                                    {{-- <a href="{{ route('external.showPartner', $partner->id) }}"
                                        class="btn btn-info btn-sm">Detalhes</a> --}}
                                    <a href="{{ route('external.editPartner', $partner->id) }}"
                                        class="btn btn-warning btn-sm">Editar</a>

                                    {{-- <form method="post"
                                        action="{{ route('external.destroyPartner', $partner->id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                    </form> --}}
                                </td>
                            </tr>
                            <tr class="filler"></tr>
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

            if (showId === 'trainingsTable') {
                var trainingsTable = document.getElementById(showId);
                var rows = trainingsTable.getElementsByTagName('tr');
                for (var i = 0; i < rows.length; i++) {
                    rows[i].style.display = '';
                }
            }
        }

        function filterTrainingsTable(partnerId) {
            document.getElementById('partnersTable').style.display = 'none';

            var trainingsTable = document.getElementById('trainingsTable');
            trainingsTable.style.display = 'block';

            var rows = trainingsTable.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                rows[i].style.display = 'none';
            }

            var partnerRows = document.getElementsByClassName('partner_' + partnerId);
            for (var x = 0; x < partnerRows.length; x++) {
                partnerRows[x].style.display = '';
            }
        }
    </script>
@endsection
