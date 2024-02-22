@extends('master.main')

@section('content')
    <div class="container  w-100 fade-in">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#success-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#error-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif


        <h1>Formações de mercado</h1>

        <ul class="nav nav-tabs mb-3" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#externalTable">Gestão de F. Mercado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#partnersTable">Gestão de Parceiros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#trainingsTable">Gestão de Formação</a>
            </li>
        </ul>


        <div class="tab-content">

            <div class="tab-pane fade show active" id="externalTable">

                <div class="d-flex justify-content-between mb-3">
                    <form action="{{ route('external.index') }}" method="GET">
                        <div class="input-group pr-2">
                            <div class="search-container">
                                <input type="text" name="ptu" class="form-control" placeholder="{{ request('ptu') ? request('ptu') : 'Procurar...' }}">
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary">
                                    Procurar
                                </button>
                            </div>
                        </div>
                    </form>


                    <div class="buttons">
                        <a href="{{ route('external.create') }}" class="btn btn-primary">Nova F. mercado</a>
                    </div>

                </div>

                <table class="table bg-white" id="externalTable">
                    <thead>
                        <tr>

                            <th scope="col">Parceiro</th>
                            <th scope="col">Morada</th>
                            <th scope="col">Técnico</th>
                            <th scope="col">Formação</th>
                            <th scope="col">Data</th>
                            <th scope="col"><div class="centerTd">Ações</div></th>
                        </tr>
                    </thead>
                    <tbody class="customTableStyling">
                        <tr class="filler"></tr>
                        @foreach ($partner_Training_Users as $partner_Training_User)
                            <tr class="customTableStyling">


                                <td class="clickable">
                                    <a href="{{ route('external.show', $partner_Training_User->id) }}" class="d-flex align-items-center w-auto h-100">
                                        @if(optional($partner_Training_User->partner)->name)
                                            {{ optional($partner_Training_User->partner)->name }}
                                        @else
                                            <span class="text-danger">O parceiro foi apagado do sistema.</span>
                                        @endif
                                    </a>
                                </td>

                                <td class="{{ optional($partner_Training_User->partner)->address ? '' : 'text-danger' }}">
                                    {{ optional($partner_Training_User->partner)->address ?? 'O parceiro foi apagado do sistema.' }}
                                </td>

                                <td class="{{ optional($partner_Training_User->user)->name ? '' : 'text-danger' }}">
                                    {{ optional($partner_Training_User->user)->name ?? 'O utilizador foi apagado do sistema' }}
                                </td>
                                <td class="{{ optional($partner_Training_User->training)->name ? '' : 'text-danger' }}">
                                    {{ optional($partner_Training_User->training)->name ?: 'A Formação foi apagada do sistema' }}
                                </td>

                                <td>{{ \Carbon\Carbon::parse($partner_Training_User->start_date)->format('Y-m-d') }}</td>
                                <td>

                                    <div class="d-flex justify-content-between editDelete">
                                        <div style="width: 40%">
                                            <a href="{{ route('external.edit', $partner_Training_User->id) }}">
                                                <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                                            </a>
                                        </div>

                                        <div style="width: 40%">
                                            <form method="post" action="{{ route('external.destroy', $partner_Training_User->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="modalBtn"
                                                    data-message="Tem a certeza que deseja apagar a formação externa do dia {{ \Carbon\Carbon::parse($partner_Training_User->start_date)->format('Y-m-d') }}?"
                                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="filler"></tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $partner_Training_Users->appends(['ptuPage' => $partner_Training_Users->currentPage()])->links() }}            </div>

            <div class="tab-pane fade" id="partnersTable">
                <div class="d-flex justify-content-between mb-3">
                    <form action="{{ route('external.index') }}" method="GET">
                        <div class="input-group pr-2">
                            <div class="search-container">
                                <input type="text" name="p" class="form-control" placeholder="{{ request('p') ? request('p') : 'Procurar...' }}">
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary">
                                    Procurar
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="buttons">
                        <a href="{{ route('partners.create') }}" class="btn btn-primary">Novo Parceiro</a>
                    </div>
                </div>
                <table class="table bg-white">
                    <thead>
                        <tr>

                            <th scope="col">Parceiro</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Morada</th>
                            <th scope="col">Contactos</th>
                            <th scope="col">Formações</th>
                            <th scope="col"><div class="centerTd">Ações</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="filler"></tr>
                        @foreach ($partners as $partner)
                            <tr class="customTableStyling">

                                <td class="clickable">
                                    <a href="{{ route('partners.show', $partner->id) }}" class="d-flex align-items-center h-100">{{ $partner->name }}</a>
                                </td>
                                <td>{{ $partner->description }}</td>
                                <td>{{ $partner->address }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="contactDropdown{{ $partner->id }}" data-toggle="dropdown">
                                            <i class="fa-regular fa-eye fa-lg" style="color: #fff;"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="contactDropdown{{ $partner->id }}">
                                            @if (count($partner->contactPartner) > 0)
                                                @foreach ($partner->contactPartner as $contact)
                                                    <p class="dropdown-item">{{ $contact->contact }}</p>
                                                @endforeach
                                            @else
                                                <p class="dropdown-item">Nenhum contacto associado</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="pl-4">


                                    <form action="{{ route('external.index') }}" method="GET" class="viewPartnersForm">
                                        <input type="text" name="ptu" class="form-control" hidden value="{{ $partner->name }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info btn-sm filteredPtus">
                                                Ver
                                            </button>
                                        </div>
                                    </form>

                                </td>
                                <td class="editDelete">
                                    <div style="width: 40%">
                                        <a href="{{ route('partners.edit', $partner->id) }}">
                                            <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                                        </a>
                                    </div>

                                    <div style="width: 40%">
                                        <form method="post" action="{{ route('partners.destroy', $partner->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="modalBtn"
                                                data-message="Tem a certeza que deseja apagar o parceiro {{ $partner->name }}?"
                                                style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="filler"></tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $partners->appends(['pPage' => $partners->currentPage()])->links() }}

            </div>

            <div class="tab-pane fade" id="trainingsTable">




                <div class="d-flex justify-content-between mb-3">
                    <form action="{{ route('external.index') }}" method="GET">
                        <div class="input-group pr-2">
                            <div class="search-container">
                                <input type="text" name="t" class="form-control" placeholder="{{ request('t') ? request('t') : 'Procurar...' }}">
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary">
                                    Procurar
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="buttons">
                        <a href="{{ route('trainings.create') }}" class="btn btn-primary">Nova Formação</a>
                    </div>

                </div>

                <table class="table bg-white">
                    <thead>
                        <tr >

                            <th scope="col">Nome da formação</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Categoria</th>
                            <th scope="col"><div class="centerTd">Ações</div></th>
                        </tr>
                    </thead>
                    <tbody id="trainingsTable">
                        <tr class="filler"></tr>
                        @foreach ($trainings as $training)
                            <tr class="customTableStyling">

                                <td class="clickable">
                                    <a href="{{ route('trainings.show', $training->id) }}" class="d-flex align-items-center w-auto h-100">{{ $training->name }}</a>
                                </td>
                                <td>{{ $training->description }}</td>
                                <td>{{ $training->category }}</td>
                                <td>
                                    <div class="d-flex justify-content-between editDelete">
                                        <div style="width: 40%">
                                            <a href="{{ route('trainings.edit', $training->id) }}">
                                                <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                                            </a>
                                        </div>

                                        <div style="width: 40%">
                                            <form method="post" action="{{ route('trainings.destroy', $training->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="modalBtn"
                                                    data-message="Tem a certeza que deseja apagar a formação {{ $training->name }}?"
                                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="filler"></tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $trainings->appends(['tPage' => $trainings->currentPage()])->links() }}            </div>

        </div>

            {{--    confirmation modal    --}}
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirmar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modalBody">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="deleteBtn">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--    confirmation modal    --}}


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deleteButtons = document.querySelectorAll('button[class="modalBtn"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    let message = button.getAttribute('data-message');
                    document.getElementById('modalBody').textContent = message;

                    $('#deleteModal').modal('show');

                    $('#deleteBtn').click(function () {
                        button.closest('form').submit();
                    });
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.viewPartnersForm').on('submit', function(e) {
                e.preventDefault();
                window.location.hash = 'externalTable';
                this.submit();
            });
        });
    </script>

    <script>
        //gravar tab ativa
        $(document).ready(function () {
            function determineContext() {
                return 'pagination';
            }



            function getFragment() {
                return window.location.hash.substring(1);
            }

            function setFragment(fragment) {
                history.pushState(null, null, '#' + fragment);
            }

            function setActiveTab(tabId) {
                $(`#myTabs a[href="#${tabId}"]`).tab('show');
            }

            const activeTabInfo = localStorage.getItem('activeTabInfo');

            if (activeTabInfo) {
                const { tabId, context } = JSON.parse(activeTabInfo);
                setActiveTab(tabId);
                setFragment(tabId);
            }

            $('#myTabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                const tabId = $(e.target).attr('href').substring(1);
                const context = determineContext();

                const activeTabInfo = JSON.stringify({ tabId, context });
                localStorage.setItem('activeTabInfo', activeTabInfo);

                setFragment(tabId);


            });

            window.addEventListener('hashchange', function () {
                const fragment = getFragment();
                setActiveTab(fragment);
            });
        });
    </script>




@endsection
