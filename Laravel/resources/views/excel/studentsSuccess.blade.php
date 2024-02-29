@extends('master.main')

@section('content')

<div class="container w-100 fade-in">
    <h3>{{ $message }}</h3>

    <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th scope="col">Username</th>
                    <th scope="col">Função</th>
                    <th scope="col" >Email</th>
                    <th scope="col" class="ml-7" style="text-align: center !important;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr class="filler"></tr>
                @foreach($importedStudents as $student)
                <tr class="customTableStyling" data-position="{{ strtolower($student) }}"
                data-role="{{ $student->role_id }}">
                    <td class="clickable">
                        <a href="{{ route('users.show', $student->id) }}" class="d-flex align-items-center w-auto h-100">{{ $student->name }}</a>
                    </td>
                    <td>{{ $student->username }}</td>
                    <td class="mobileHidden">{{ $student->email }}</td>
                    <td>{{ $student->role->description }}</td>
                    <td class="editDelete">
                        <div style="width: 40%">
                            <a href="{{ route('users.edit', $student->id) }}">
                                <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                            </a>
                        </div>
                        <div style="width: 40%">
                            <form method="post" action="{{ route('users.destroy', $student->id) }}"
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
    </div>

    <a href="{{ route('course-classes.index') }}" class="btn btn-primary">Voltar à página de turmas</a>

    {{--modal confirmação turma sem alunos encontrados no excel--}}
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
                    <p>Não foram encontrados alunos. Ou os alunos já existem na base de dados.<br>
                        Pretende criar a turma sem alunos?</p>
                </div>
                <form method="post" action="{{ route('course-classes.store') }}">
                    @csrf
                    <input type="hidden" name="description" value="{{ $description }}">
                    <input type="hidden" name="course_id" value="{{ $course_id }}">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="confirmButton">Sim</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('course-classes.index') }}'">Não</button>                </div>
                </form>
            </div>
        </div>
    </div>
    {{----}}
</div>



<script>
    //modal confirmação de turma sem alunos
    window.onload = function () {
        var emptyStudents = @json($emptyStudents);

        if (emptyStudents) {
            $('#confirmModalExcel').modal('show');
        }


    };


</script>

@endsection
