@extends('master.main')

@section('content')
    <div class="container  w-100 fade-in">

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function () {
                    $('#success-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function () {
                    $('#error-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4 position-relative">
            <h1>Utilizadores</h1>

            <a href="{{ route('users.create') }}" class="btn btn-primary users-newUserBtn">
                <i class="fa-solid fa-pen mr-1" style="color: #ffffff;"></i>
                Novo Utilizador
            </a>
            <img src="{{ asset('assets/questionMark.png') }}"
                 onclick="event.stopPropagation(); changeUserTab(); triggerUserIntro();" class="questionMarkBtn">
        </div>

        <ul class="nav nav-tabs mb-3" id="userTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#utilizadores">Todos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reciclagem_utilizadores">Reciclagem</a>
            </li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane fade show active" id="utilizadores">
                <div class="d-flex justify-content-between mb-3">

                    <form action="{{ route('users.index') }}" method="GET" class="users-searchBar">
                        <div class="input-group pr-2">
                            <div class="search-container">
                                <input type="text" name="searchName" class="form-control"
                                       placeholder="{{ request('searchName') ? request('searchName') : 'Procurar...' }}">
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary">
                                    Procurar
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="buttons">
                        <button id="importUsersModalBtn" class="btn btn-primary mr-2 " data-toggle="modal"
                                name="importUsersModal"
                                data-target="#importUsersModal">Importar utilizadores
                        </button>

                        <button class="btn btn-danger modalBtn" id="delete-selected"
                                data-message="Tem a certeza que pretende enviar os utilizadores selecionados para a reciclagem?"
                                data-no-selection-message="Selecione pelo menos um utilizador para excluir.">Excluir
                            Selecionados
                        </button>
                        <form action="{{ route('users.index') }}" method="GET" id="roleFilterForm">
                            <div>
                                <select class="form-control" id="roleFilter" name="roleFilter" onchange="submitForm()">
                                    <option value="" {{ request('roleFilter') === '' ? 'selected' : '' }}>Todas as
                                        Funções
                                    </option>
                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->id }}" {{ request('roleFilter') == $role->id ? 'selected' : '' }}>{{ $role->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table usersTable" id="userTable">
                    <thead>
                    <tr>
                        <th scope="col" class="mobileHidden">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>
                            <a href="{{ route('users.index', ['sortColumn' => 'name', 'sortDirection' => $sortColumn === 'name' ?
                ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">
                                Nome
                                @if ($sortDirection === 'desc' && $sortColumn === 'name')
                                    <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('users.index', ['sortColumn' => 'username', 'sortDirection' => $sortColumn === 'username' ?
                ($sortDirection === 'asc' ? 'desc' : 'asc') : 'asc']) }}">
                                Número Interno
                                @if ($sortDirection === 'desc' && $sortColumn === 'username')
                                    <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="mobileHidden">Email</th>
                        <th scope="col">Função</th>
                        <th scope="col" class="mobileHidden">Ativo</th>
                        <th scope="col">
                            <div class="centerTd">Ações</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="filler"></tr>
                    @foreach ($users as $user)
                        <tr class="user-row customTableStyling" data-position="{{ strtolower($user) }}"
                            data-role="{{ $user->role_id }}">
                            <td class="mobileHidden">
                                <input type="checkbox" name="selectedUsers[]"
                                       value="{{ $user->id }}">
                            </td>
                            <td class="clickable users-name">
                                <a href="{{ route('users.show', $user->id) }}"
                                   class="d-flex align-items-center w-auto h-100">{{ $user->name }}</a>
                            </td>
                            <td>{{ $user->username }}</td>
                            <td class="mobileHidden">{{ $user->email }}</td>
                            <td>
                                {{ $user->role->description }}
                            </td>

                            <td class="mobileHidden">{{ $user->isActive == 1 ? 'Sim' : 'Não' }}</td>
                            <td class="editDelete">
                                <div style="width: 40%">
                                    <a href="{{ route('users.edit', $user->id) }}">
                                        <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                                    </a>
                                </div>
                                <div style="width: 40%">
                                    <form method="post" action="{{ route('users.destroy', $user->id) }}"
                                          style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="modalBtn"
                                                data-message="Tem a certeza que pretende enviar o {{ strtolower($user->role->description) }} {{ $user->name }} para a reciclagem?"
                                                style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                            <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="filler" style="background-color: #f8fafc"></tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $users->appends(['uPage' => $users->currentPage()])->links() }}


            </div>
            <div class="tab-pane fade " id="reciclagem_utilizadores">

                @if($deletedUsers->isEmpty())
                    <img src="{{ asset('assets/reciclagem_azul_extra_bold_2_sem fundo.png') }}"
                         alt="Não existem registos" class="bin">
                @else
                    <div class="">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Username</th>
                                <th scope="col" class="mobileHidden">Email</th>
                                <th scope="col">
                                    <div class="centerTd">Restaurar</div>
                                </th>
                                <th scope="col">
                                    <div class="centerTd">Apagar</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="filler"></tr>
                            @foreach($deletedUsers as $deletedUser)
                                <tr class="customTableStyling" data-position="" data-role="" onclick="">
                                    <td>{{ $deletedUser->name }}</td>
                                    <td>{{ $deletedUser->username }}</td>
                                    <td class="mobileHidden">{{ $deletedUser->email }}</td>


                                    <td>
                                        <div class="centerTd">
                                            <form method="post" action="{{ route('users.restore', $deletedUser->id) }}"
                                                  style="display:inline;">
                                                @csrf
                                                <button type="submit" class="modalBtn"
                                                        data-message="Tem a certeza que deseja restaurar o {{strtolower($deletedUser->role->description)}} {{ $deletedUser->name }}?"
                                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <img src="{{ asset('assets/restore.svg') }}">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="centerTd">
                                            <form method="post"
                                                  action="{{ route('users.forceDelete', $deletedUser->id) }}"
                                                  style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="modalBtn"
                                                        data-message="Tem a certeza que deseja apagar permanentemente o {{strtolower($deletedUser->role->description)}} {{ $deletedUser->name }}?"
                                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <img src="{{ asset('assets/permaDelete.svg') }}" alt="Delete">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="filler" style="background-color: #f8fafc"></tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $deletedUsers->appends(['dPage' => $deletedUsers->currentPage()])->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- The Import Users Modal -->
        <div class="modal" id="importUsersModal" tabindex="-1" role="dialog" aria-labelledby="importUsersModal"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Importar utilizadores</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container w-100">
                            <form action="{{ route('import-excel.importUsers') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="">Excel - Importar Utilizadores</label><br>
                                    <label for="file" class="btn btn-primary">Selecionar ficheiro</label>
                                    <input type="file" name="file" id="file" class="btn" style="display: none;"
                                           accept=".xls,.xlsx"> <input type="hidden">
                                    @error('attachment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <p id="fileName"></p>
                                    <p>Certifique-se que o arquivo tem menos de 20MB</p>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Importar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{----}}



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
            const deleteSelectedButton = document.getElementById('delete-selected');
            const userCheckboxes = document.getElementsByName('selectedUsers[]');
            const selectAllCheckbox = document.getElementById('select-all');

            deleteSelectedButton.addEventListener('click', function (event) {
                event.preventDefault();

                let userIds = [];
                userCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        userIds.push(checkbox.value);
                    }
                });

                let message;
                if (userIds.length > 0) {
                    message = this.getAttribute('data-message');
                    deleteBtn.style.display = 'inline-block';
                } else {
                    message = this.getAttribute('data-no-selection-message');
                    deleteBtn.style.display = 'none';
                }
                document.getElementById('modalBody').textContent = message;

                $('#deleteModal').modal('show');

                $('#deleteBtn').click(function () {
                    if (userIds.length > 0) {
                        massDeleteUsers();
                    }
                });
            });

            selectAllCheckbox.addEventListener('change', function () {
                userCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            function massDeleteUsers() {
                let userIds = [];
                userCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        userIds.push(checkbox.value);
                    }
                });

                if (userIds.length > 0) {
                    let form = document.createElement('form');
                    form.action = '{{ route('users.massDelete') }}';
                    form.method = 'post';
                    form.style.display = 'none';

                    let inputToken = document.createElement('input');
                    inputToken.type = 'hidden';
                    inputToken.name = '_token';
                    inputToken.value = '{{ csrf_token() }}';
                    form.appendChild(inputToken);

                    userIds.forEach(userId => {
                        let inputUser = document.createElement('input');
                        inputUser.type = 'hidden';
                        inputUser.name = 'user_ids[]';
                        inputUser.value = userId;
                        form.appendChild(inputUser);
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            }
        });

        document.getElementById('file').addEventListener('change', function () {
            var fileName = this.files[0].name;
            document.getElementById('fileName').textContent = "Nome do ficheiro: " + fileName;
        });

    </script>
@endsection
@push('scripts')
    <script src="{{ asset('js/tickets/index.js') }}"></script>
    <script src="{{ asset('js/userOnboarding/intro.js') }}"></script>
    <script src="{{ asset('js/userOnboarding/userIntro.js') }}"></script>
@endpush
