@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">
        <h1>Lista de Formações</h1>

        <a href="{{ route('trainings.create') }}" class="btn btn-primary mb-3">Nova formação</a>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome da formação</th>
                <th scope="col">Descrição</th>
                <th scope="col">Categoria</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trainings as $training)
                <tr>
                    <th scope="row">{{ $training->id }}</th>
                    <td>{{ $training->name }}</td>
                    <td>{{ $training->description }}</td>
                    <td>{{ $training->category }}</td>
                    <td>
                        <a href="{{ route('trainings.show', $training->id) }}" class="btn btn-info">Detalhes</a>
                        <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-warning">Editar</a>
                        <form method="post" action="{{ route('trainings.destroy', $training->id) }}"
                              style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $trainings->links() }}
        {{--    confirmation modal    --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Tem a certeza que deseja excluir?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="deleteBtn">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        {{--    confirmation modal    --}}

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deleteButtons = document.querySelectorAll('button[type="submit"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); // prevent form submission
                    $('#deleteModal').modal('show'); // show the modal

                    // handle the confirm button click event
                    $('#deleteBtn').click(function () {
                        button.closest('form').submit(); // submit the form
                    });
                });
            });
        });
    </script>
@endsection
