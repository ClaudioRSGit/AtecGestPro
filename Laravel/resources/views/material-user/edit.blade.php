@extends('master.main')

@section('content')

    <div class="container w-100 fade-in">
        <div>

            <div class="mb-3">
                <h1>Lista de materiais entregues a {{$user->name}}</h1>
            </div>
            @if(!$materialUsers->isEmpty())
            <table class="table">
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
                <tr class="filler"></tr>
                    @foreach($materialUsers as $entrega)
                        <tr class="customTableStyling">
                            <td>
                                <input type="checkbox" name="selectedMaterials[]" value="{{$entrega->id}}">
                            </td>

                            <td class="clickable">
                                <a href="{{ route('materials.show', $entrega->material->id) }}" class="d-flex align-items-center w-auto h-100">{{$entrega->material->name}}</a>
                            </td>
                            <td class="pl-4">
                                {{$entrega->size->size}}
                            </td>
                            <td class="pl-5">
                                {{$entrega->quantity}}
                            </td>
                            <td>
                                {{$entrega->delivery_date}}
                            </td>
                            <td>
                                <form action="{{ route('material-user.destroy', $entrega->id) }}" method="POST" class="pl-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')"
                                            style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                            viewBox="0 0 448 512">
                                            <path fill="#116fdc"
                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr class="filler"></tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h5>Nenhum material associado a este utilizador.</h5>
            @endif
            <br>
            <div>
                @if(!$materialUsers->isEmpty())
                    <button id="delete-selected" class="btn btn-danger">Excluir selecionados</button>
                @endif
                <a href="{{ route('material-user.index') }}" class="btn btn-secondary mx-2">Cancelar</a>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');

            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                        'input[name="selectedMaterials[]"]:checked').length;
                });
            });
        });

        const deleteSelectedButton = document.getElementById('delete-selected');

        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="selectedMaterials[]"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll(
                        'input[name="selectedMaterials[]"]:checked').length;
                });
            });
        });

        deleteSelectedButton.addEventListener('click', function() {
            const selectedMaterials = Array.from(document.querySelectorAll(
                'input[name="selectedMaterials[]"]:checked'))
                .map(checkbox => checkbox.value);
            if (selectedMaterials.length > 0 && confirm(
                'Tem certeza que deseja excluir os materiais selecionados?')) {
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
