@extends('master.main')

@section('content')

<div class="container w-100 fade-in">
    <h1>{{ $message }}</h1>

    <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Função</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr class="filler"></tr>
                @foreach($importedUsers as $user)
                <tr class="user-row customTableStyling" data-position="{{ strtolower($user) }}"
                data-role="{{ $user->role_id }}">
                    <td class="clickable">
                        <a href="{{ route('users.show', $user->id) }}" class="d-flex align-items-center w-auto h-100">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->description }}</td>
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
                                <button type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir?')"
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

        {{--                    modal confirmação turma sem alunos encontrados no excel--}}
        <div id="confirmModalExcel" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Não foram encontrados alunos. Pretende criar a turma sem alunos?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="confirmButton">Sim</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    </div>
                </div>
            </div>
        </div>
        {{----}}
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-primary">Voltar à página de utilizadores</a>
</div>


<script>
    //modal confirmação de turma sem alunos
    window.onload = function () {
        var emptyStudents = @json($emptyStudents);

        if (emptyStudents) {
            $('#confirmModalExcel').modal('show');
        }

        $('#confirmButton').click(function(e) {
            e.preventDefault();
            $('#createCourseClassForm').submit();
        });
    };
</script>

@endsection
