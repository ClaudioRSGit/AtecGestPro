@extends('master.main')

@section('content')
    <div class="w-100">
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

                <div class=" d-flex">
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


                    <button class="btn btn-danger mb-3 mr-2" id="delete-selected-ptus">Excluir Selecionados</button>


                    <a href="{{ route('external.create') }}" class="btn btn-primary mb-3 ">Nova F. mercado</a>

                </div>

                <table class="table bg-white" id="externalTable">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" id="select-all-ptus">
                            </th>
                            <th scope="col">Parceiro</th>
                            <th scope="col">Morada</th>
                            <th scope="col">Técnico</th>
                            <th scope="col">Formação</th>
                            <th scope="col">Data</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="customTableStyling">
                        <tr class="filler"></tr>
                        @foreach ($partner_Training_Users as $partner_Training_User)
                            <tr class="customTableStyling"
                                onclick="location.href='{{ route('external.show', $partner_Training_User->id) }}'">
                                <td>
                                    <input type="checkbox" class="no-propagate" name="selectedPtus[]"
                                        value="{{ $partner_Training_User->id }}">
                                </td>

                                <td class="{{ optional($partner_Training_User->partner)->name ? '' : 'text-danger' }}">
                                    {{ optional($partner_Training_User->partner)->name ?? 'O Parceiro foi apagado do sistema.' }}
                                </td>
                                <td>{{ optional($partner_Training_User->partner)->address }}</td>
                                <td>{{ optional($partner_Training_User->user)->name }}</td>
                                <td class="{{ optional($partner_Training_User->training)->name ? '' : 'text-danger' }}">
                                    {{ optional($partner_Training_User->training)->name ?: 'A Formação foi apagada do sistema' }}
                                </td>

                                <td>{{ $partner_Training_User->start_date }}</td>
                                <td>

                                    <div class="d-flex justify-content-between mb-3 editDelete">
                                        <div style="width: 40%">
                                            <a href="{{ route('external.edit', $partner_Training_User->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#116fdc"
                                                        d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                                </svg>
                                            </a>
                                        </div>

                                        <div style="width: 40%">
                                            <form method="post"
                                                action="{{ route('external.destroy', $partner_Training_User->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    onclick="return confirm('Tem certeza que deseja excluir?')"
                                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                                        viewBox="0 0 448 512">
                                                        <path fill="#116fdc"
                                                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                                    </svg>
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
                {{ $partner_Training_Users->links()}}
            </div>

            <div class="tab-pane fade" id="partnersTable">
                <div class="d-flex mb-3">
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
                    <button class="btn btn-danger mr-2" id="delete-selected">Excluir Selecionados</button>
                    <a href="{{ route('partners.create') }}" class="btn btn-primary">Novo Parceiro</a>
                </div>
                <table class="table bg-white">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" id="select-all-partners">
                            </th>
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
                            <tr class="customTableStyling"
                                onclick="location.href='{{ route('partners.show', $partner->id) }}'">
                                <td>
                                    <input type="checkbox" class="no-propagate" name="selectedPartners[]"
                                        value="{{ $partner->id }}">
                                </td>
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
                                            @foreach ($partner->contactPartner as $contact)
                                                <a class="dropdown-item" href="#">{{ $contact->contact }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td class="pl-4">


                                    <form action="{{ route('external.index') }}" method="GET" class="viewPartnersForm">
                                        <input type="text" name="ptu" class="form-control" hidden value="{{ $partner->name }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info btn-sm filteredPtus no-propagate">
                                                Ver
                                            </button>
                                        </div>
                                    </form>

                                </td>
                                <td class="editDelete">
                                    <div style="width: 40%">
                                        <a href="{{ route('partners.edit', $partner->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                viewBox="0 0 512 512">
                                                <path fill="#116fdc"
                                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                            </svg>
                                        </a>
                                    </div>

                                    <div style="width: 40%">
                                        <form method="post" action="{{ route('partners.destroy', $partner->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                onclick="return confirm('Tem certeza que deseja excluir?')"
                                                style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                                    viewBox="0 0 448 512">
                                                    <path fill="#116fdc"
                                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="filler"></tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $partners->appends(request()->input())->links() }}

            </div>

            <div class="tab-pane fade" id="trainingsTable">




                <div class="d-flex">
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

                    <button class="btn btn-danger mb-3 mr-2" id="delete-selected-trainings">Excluir Selecionados</button>


                    <a href="{{ route('trainings.create') }}" class="btn btn-primary mb-3">Nova Formação</a>

                </div>

                <table class="table bg-white">
                    <thead>
                        <tr >
                            <th scope="col">
                                <input type="checkbox" id="select-all-trainings">
                            </th>
                            <th scope="col">Nome da formação</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="trainingsTable">
                        <tr class="filler"></tr>
                        @foreach ($trainings as $training)
                            <tr class="customTableStyling"
                                onclick="location.href='{{ route('trainings.show', $training->id) }}'">
                                <td>
                                    <input type="checkbox" class="no-propagate" name="selectedTrainings[]"
                                        value="{{ $training->id }}">
                                </td>
                                <td>{{ $training->name }}</td>
                                <td>{{ $training->description }}</td>
                                <td>{{ $training->category }}</td>
                                <td>
                                    <div class="d-flex justify-content-between mb-3 editDelete">
                                        <div style="width: 40%">
                                            <a href="{{ route('trainings.edit', $training->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                                    viewBox="0 0 512 512">
                                                    <path fill="#116fdc"
                                                        d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                                </svg>
                                            </a>
                                        </div>

                                        <div style="width: 40%">
                                            <form method="post" action="{{ route('trainings.destroy', $training->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    onclick="return confirm('Tem certeza que deseja excluir?')"
                                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                                        viewBox="0 0 448 512">
                                                        <path fill="#116fdc"
                                                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                                    </svg>
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
                {{ $trainings->appends(request()->input())->links() }}
            </div>

        </div>


    </div>

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
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const deleteselectedPtusButton = document.getElementById('delete-selected-ptus');
            const ptuCheckboxes = document.getElementsByName('selectedPtus[]');
            const selectAllPtusCheckbox = document.getElementById('select-all-ptus');

            deleteselectedPtusButton.addEventListener('click', function(event) {
                event.stopPropagation();
                massDeletePtus();
            });

            selectAllPtusCheckbox.addEventListener('change', function() {
                ptuCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllPtusCheckbox.checked;
                });
            });

            ptuCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });

            function massDeletePtus() {
                let ptuIds = [];
                ptuCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        ptuIds.push(checkbox.value);
                    }
                });

                if (ptuIds.length > 0) {
                    if (confirm('Tem certeza que deseja excluir as formações selecionadas?')) {
                        let form = document.createElement('form');
                        form.action = '{{ route('external.massDelete') }}';
                        form.method = 'post';
                        form.style.display = 'none';

                        let inputToken = document.createElement('input');
                        inputToken.type = 'hidden';
                        inputToken.name = '_token';
                        inputToken.value = '{{ csrf_token() }}';
                        form.appendChild(inputToken);

                        ptuIds.forEach(ptuId => {
                            let inputPtu = document.createElement('input');
                            inputPtu.type = 'hidden';
                            inputPtu.name = 'ptu_ids[]';
                            inputPtu.value = ptuId;
                            form.appendChild(inputPtu);
                        });

                        document.body.appendChild(form);
                        form.submit();
                    }
                } else {
                    alert('Selecione pelo menos uma formação para excluir.');
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.no-propagate');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            const deleteSelectedButton = document.getElementById('delete-selected');
            const checkboxes = document.getElementsByName('selectedPartners[]');
            const selectAllCheckbox = document.getElementById('select-all-partners');

            deleteSelectedButton.addEventListener('click', function(event) {
                event.stopPropagation();
                massDelete();
            });

            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });


            function massDelete() {
                let partnerIds = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        partnerIds.push(checkbox.value);
                    }
                });

                if (partnerIds.length > 0) {
                    if (confirm('Tem certeza que deseja excluir os parceiros selecionados?')) {
                        let form = document.createElement('form');
                        form.action = '{{ route('partners.massDelete') }}';
                        form.method = 'post';
                        form.style.display = 'none';

                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = '_token';
                        input.value = '{{ csrf_token() }}';
                        form.appendChild(input);

                        partnerIds.forEach(partnerId => {
                            let inputPartner = document.createElement('input');
                            inputPartner.type = 'hidden';
                            inputPartner.name = 'partner_ids[]';
                            inputPartner.value = partnerId;
                            form.appendChild(inputPartner);
                        });

                        document.body.appendChild(form);
                        form.submit();
                    }
                } else {
                    alert('Selecione pelo menos um parceiro para excluir.');
                }
            }


        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteSelectedTrainingsButton = document.getElementById('delete-selected-trainings');
            const trainingCheckboxes = document.getElementsByName('selectedTrainings[]');
            const selectAllTrainingsCheckbox = document.getElementById('select-all-trainings');

            deleteSelectedTrainingsButton.addEventListener('click', function(event) {
                event.stopPropagation();
                massDeleteTrainings();
            });

            selectAllTrainingsCheckbox.addEventListener('change', function() {
                trainingCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllTrainingsCheckbox.checked;
                });
            });

            trainingCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });

            function massDeleteTrainings() {
                let trainingIds = [];
                trainingCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        trainingIds.push(checkbox.value);
                    }
                });

                if (trainingIds.length > 0) {
                    if (confirm('Tem certeza que deseja excluir as formações selecionadas?')) {
                        let form = document.createElement('form');
                        form.action = '{{ route('trainings.massDelete') }}';
                        form.method = 'post';
                        form.style.display = 'none';

                        let inputToken = document.createElement('input');
                        inputToken.type = 'hidden';
                        inputToken.name = '_token';
                        inputToken.value = '{{ csrf_token() }}';
                        form.appendChild(inputToken);

                        trainingIds.forEach(trainingId => {
                            let inputTraining = document.createElement('input');
                            inputTraining.type = 'hidden';
                            inputTraining.name = 'training_ids[]';
                            inputTraining.value = trainingId;
                            form.appendChild(inputTraining);
                        });

                        document.body.appendChild(form);
                        form.submit();
                    }
                } else {
                    alert('Selecione pelo menos uma formação para excluir.');
                }
            }
        });
    </script>




@endsection
