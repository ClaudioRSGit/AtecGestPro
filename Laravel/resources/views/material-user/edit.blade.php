@extends('master.main')

@section('content')

    <div class="container w-100 fade-in">
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
            <br>

            <div class="row">
                <div class="col-8 d-flex">
                    <h3>Editar entregas </h3>
                    <p class="mt-2 ml-2">- {{$user->name}}</p>
                </div>
                <div class="col-4">
                    <h3>Editar notas</h3>
                </div>


            </div>
            <hr>
            <div class="row">


                <div class="col-7  p-3 shadow-lg  " style="height: 400px; overflow-y: auto; position: relative;">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" id="select-all">
                            <th scope="col">Materiais entregues</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Data de entrega</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($materialUsers->isEmpty())
                            <tr>
                                <td colspan="6">Não existem entregas associadas a este utilizador</td>
                            </tr>
                        @else
                            @foreach($materialUsers as $entrega)
                                <tr>
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
                                    <td>
                                        {{$entrega->delivery_date}}
                                    </td>
                                    <td>
                                        <form action="{{ route('material-user.destroy', $entrega->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Tem certeza que deseja excluir? O stock não vai ser atualizado!')"
                                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                                     viewBox="0 0 448 512">
                                                    <path fill="#116fdc"
                                                          d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

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
                <div class="col-4 p-3 shadow-lg" style="height: 400px; overflow-y: auto;">



                    <div class=" p-2 mb-4" >
                        @if($user->notes)
                            <p>{!! nl2br(e($user->notes)) !!}</p>
                        @else
                            <p class="pb-5">Não existe nenhuma nota</p>
                        @endif
                    </div>




                </div>
            </div>

            <div class="row mt-2">
                <div class="col-7 pr-0">
                    <div>

                        <div class="row">
                            <div class="col-6 ">
                                <a href="{{ route('material-user.index') }}" class="btn btn-secondary mr-2">Voltar</a>
                              <button id="delete-selected" class="btn btn-danger" >Excluir selecionados</button>
                            </div>
                            <div class="col-6 align-content-end text-right pr-0">
                                <form id="allDelivered" action="{{ route('material-user.addDeliveredAll') }}" method="POST"
                                      style="display:inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <button type="submit" form="allDelivered" class="btn btn-primary">Finalizar entrega</button>
                                </form>
                                <form id="partialDelivered" action="{{ route('material-user.addDeliveredPartial') }}" method="POST"
                                      style="display:inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <button type="submit" form="partialDelivered" class="btn btn-primary ">Entrega parcial</button>
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
                                        <button type="submit" class="btn btn-primary">Gravar</button>
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
                                        <button type="submit" class="btn btn-primary">Gravar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>


        </div>
    </div>


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
            if (selectedMaterials.length > 0 && confirm(
                'Tem certeza que deseja excluir os materiais selecionados? O stock não vai ser atualizado!')) {
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
            }
        });


    </script>

@endsection
