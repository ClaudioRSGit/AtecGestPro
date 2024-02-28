@extends('master.main')

@section('content')

    <div class="container w-100 fade-in materialUserEditContent">
        <div>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif


            <div class="row">
                <div class="col-8 d-flex justify-content-between materialUserCreateTitle">
                    <h3>Editar entregas </h3>
                    <p class="mt-2 ml-2 font-weight-bold"> - {{ ucfirst($user->role->name) }} : {{ $user->name }} </p>

                    {{--                    <p class="">- {{$user->name}}</p>--}}
                </div>
                <div class="col-4 mobileHidden">
                    <h3>Editar notas</h3>
                </div>


            </div>
            <hr>
            <div class="row materialUserEditContent">


                <div class="col-7 materials px-3 shadow  " >
                    <table class="table bg-white ">
                        <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" id="select-all">
                            <th scope="col">Material</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col" class="mobileHidden">Data de entrega</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>

                        <tbody class="customTableStyling">
                        @if($materialUsers->isEmpty())
                            <tr>
                                <td colspan="6">Não existem entregas associadas a este utilizador</td>
                            </tr>
                        @else
                            @foreach($materialUsers as $entrega)
                                <tr class="material-edit-row">
                                    <td>
                                        <input type="checkbox" name="selectedMaterials[]" value="{{$entrega->id}}">
                                    </td>

                                    <td>
                                        {{$entrega->material->name}}
                                    </td>
                                    <td>
                                        {{$entrega->size->size}}
                                    </td>
                                    <td>
                                        {{$entrega->quantity}}
                                    </td>
                                    <td class="mobileHidden">
                                        {{$entrega->delivery_date}}
                                    </td>
                                    <td class="pl-4">
                                        <form action="{{ route('material-user.destroy', $entrega->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    data-message="Tem a certeza que deseja excluir a entrega de {{$entrega->material->name}}? O stock não vai ser atualizado!"
                                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <tr class="filler"></tr>

                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @php
                        $delivered = 0;
                    @endphp
                    @foreach($materialUsers as $deliveredAll)
                        @if($deliveredAll->delivered_all == 1)
                            @php
                                $delivered = 1;
                            @endphp

                        @endif
                    @endforeach
                    <div class="row card w-100 mb-2  align-items-center p-2 {{ $delivered == 1 ? 'bg-success' : 'bg-info' }}" style="margin-top: auto;">

                        @if($delivered == 0)
                            <p class="font-weight-bold text-uppercase">Entrega parcial</p>
                        @else
                            <p class="font-weight-bold text-uppercase">Entrega completa</p>
                        @endif
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-4" style="height: 28rem;">

                    <div class="p-3 shadow mb-3 notes" style="height: 28rem; overflow-y: auto;">



                        <div class=" p-2 mb-4" >
                            @if($user->notes)
                                <p>{!! nl2br(e($user->notes)) !!}</p>
                            @else
                                <p class="pb-5">Não existe nenhuma nota</p>
                            @endif
                        </div>

                    </div>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNoteModal">
                        Adicionar nota
                    </button>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editNoteModal">
                        Editar nota
                    </button>


                </div>



            </div>

            <div class="row mt-3 materialUserSubmit">
                <div class="col-7 pr-0">
                    <div>

                        <div class="row">
                            <div class="col-6 ">
                                <a href="{{ route('material-user.index') }}" class="btn btn-secondary mr-2 mb-3">Voltar</a>
                                <button id="delete-selected" class="btn btn-danger mb-3">Excluir selecionados</button>
                            </div>
                            <div class="col-6 align-content-end text-right pr-0">
                                <form id="allDelivered" action="{{ route('material-user.addDeliveredAll') }}" method="POST"
                                      style="display:inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <button type="submit" form="allDelivered" class="btn btn-primary mb-3" data-message="Deseja marcar a entrega de fardamento como entregue na totalidade?">Finalizar entrega</button>
                                </form>
                                <form id="partialDelivered" action="{{ route('material-user.addDeliveredPartial') }}" method="POST"
                                      style="display:inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <button type="submit" form="partialDelivered" class="btn btn-primary mb-3" data-message="Deseja marcar a entrega de fardamento como entregue parcialmente?">Entrega parcial</button>
                                </form>
                            </div>
                        </div>




                    </div>

                </div>
                <div class="col-1"></div>
                <div class="col-4">


                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNoteModal">
                        Adicionar nota
                    </button>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editNoteModal">
                        Editar nota
                    </button>


                    <div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog"
                         aria-labelledby="editNoteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editNoteModalLabel">Editar notas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('material-user.edit', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="note">Nota</label>
                                            <textarea class="form-control" id="note" name="note"
                                                      rows="5">{{$user->notes}}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar
                                        </button>
                                        <button type="submit" class="btn btn-primary" data-message="Tem a certeza que pretende atualizar a(s) nota(s)?">Gravar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog"
                         aria-labelledby="addNoteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addNoteModalLabel">Adicionar nota</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('material-user.addNote') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="note">Nota</label>
                                            <textarea class="form-control" id="note" name="note" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar
                                        </button>
                                        <button type="submit" class="btn btn-primary" data-message="Tem a certeza que pretende guardar a nota?">Gravar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>


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
            let deleteButtons = document.querySelectorAll('button[type="submit"]');

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


    <style>
        .materials {
            align-self: start;
            height: 28rem;
            overflow: scroll;
        }

        .materials::-webkit-scrollbar {
            display: none;
        }

        .materials thead {
            position: sticky;
            top: 0;
            z-index: 1;
            opacity: 1;
            background-color: #f8fafc;
        }
    </style>

    <script>


        setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2000);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');

            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                        'input[name="selectedMaterials[]"]:checked').length;
                });
            });
        });

        const deleteSelectedButton = document.getElementById('delete-selected');

        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                        'input[name="selectedMaterials[]"]:checked').length;
                });
            });
        });

        deleteSelectedButton.addEventListener('click', function () {
            const selectedMaterials = Array.from(document.querySelectorAll(
                'input[name="selectedMaterials[]"]:checked'))
                .map(checkbox => checkbox.value);
            if (selectedMaterials.length > 0) {
                let message = 'Tem certeza que deseja excluir os materiais selecionados? O stock não vai ser atualizado!';
                document.getElementById('modalBody').textContent = message;
                $('#deleteModal').modal('show');
                document.getElementById('deleteBtn').style.display = 'block';

                document.getElementById('deleteBtn').addEventListener('click', function () {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('material-user.massDelete') }}';
                    form.style.display = 'none';
                    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                    selectedMaterials.forEach(materialId => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'material_ids[]';
                        input.value = materialId;
                        form.appendChild(input);
                    });
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);
                    document.body.appendChild(form);
                    form.submit();
                });
            } else {
                let message = 'Selecione pelo menos um material para excluir!';
                document.getElementById('modalBody').textContent = message;
                $('#deleteModal').modal('show');
                document.getElementById('deleteBtn').style.display = 'none';
            }
        });

    </script>

@endsection
