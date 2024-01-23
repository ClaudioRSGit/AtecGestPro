@extends('master.main')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="mb-4">Utilizadores</h1>

        <div class="d-flex justify-content-between mb-3">

            <form action="{{ route('users.index') }}" method="GET">
                <div class="input-group pr-2">
                    <input type="text" name="searchName" class="form-control"
                           placeholder="{{ request('searchName') ? request('searchName') : 'Procurar...' }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">
                            Procurar
                        </button>
                    </div>
                </div>
            </form>

            <div class="buttons">
                <button class="btn btn-danger" id="delete-selected">Excluir Selecionados</button>
                <form action="{{ route('users.index') }}" method="GET" id="roleFilterForm">
                    <div>
                        <select class="form-control" id="roleFilter" name="roleFilter" onchange="submitForm()">
                            <option value="" {{ request('roleFilter') === '' ? 'selected' : '' }}>Todas as Funções</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ request('roleFilter') == $role->id ? 'selected' : '' }}>{{ $role->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <img src="{{ asset('assets/new.svg') }}">
                    Novo Utilizador
                </a>
            </div>
        </div>

        <table class="table" id="userTable">
            <thead>
            <tr>
                <th scope="col">
                    <input type="checkbox" id="select-all">
                </th>
                <th scope="col">Nome</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Função</th>
                <th scope="col">Ativo</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr class="filler"></tr>
            @foreach ($users as $user)
                <tr class="user-row customTableStyling" data-position="{{ strtolower($user) }}"
                    data-role="{{ $user->role_id }}" onclick="location.href='{{ route('users.show', $user->id) }}'">
                    <td>
                        <input type="checkbox" class="no-propagate" name="selectedUsers[]" value="{{ $user->id }}">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{ $user->role->description }}
                    </td>

                    <td>{{ $user->isActive == 1 ? 'Sim' : 'Não' }}</td>
                    <td class="editDelete">
                        <div style="width: 40%">
                            <a href="{{ route('users.edit', $user->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                    <path fill="#116fdc"
                                          d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                </svg>
                            </a>
                        </div>
                        <div style="width: 40%">
                            <form method="post" action="{{ route('users.destroy', $user->id) }}"
                                  style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')"
                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                         viewBox="0 0 512 512">
                                        <path fill="#116fdc"
                                              d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr class="filler" style="background-color: #f8fafc"></tr>
            @endforeach
            </tbody>
        </table>
            {{ $users->appends(request()->input())->links() }}

        <div class="container">
            <form action="{{ route('import-excel.importUsers') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Excel - Importar Utilizadores</label><br>
                    <input type="file" name="file" id="file" class="btn" text="Escolher ficheiro">
                </div>
                <button type="submit" class="btn btn-primary">Importar</button>
            </form>
        </div>
    </div>


    <script>
        //logica filtro
        function submitForm() {
            let roleFilterValue = document.getElementById("roleFilter").value;

            document.getElementById("roleFilterForm").submit();
        }
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const deleteSelectedButton = document.getElementById('delete-selected');
            const userCheckboxes = document.getElementsByName('selectedUsers[]');
            const selectAllCheckbox = document.getElementById('select-all');

            deleteSelectedButton.addEventListener('click', function (event) {
                event.stopPropagation();
                massDeleteUsers();
            });

            selectAllCheckbox.addEventListener('change', function () {
                userCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            userCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function (event) {
                    event.stopPropagation();
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
                    if (confirm('Tem certeza que deseja excluir os utilizadores selecionados?')) {
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
                } else {
                    alert('Selecione pelo menos um utilizador para excluir.');
                }
            }
        });

    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // var checkboxes = document.querySelectorAll('.no-propagate');

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            });
        });


        window.setTimeout(function () {
            $("#success-alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2000);
    </script>
@endsection
