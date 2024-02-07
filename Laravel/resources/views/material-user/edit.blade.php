@extends('master.main')

@section('content')
    <div class="container">
        <div class="table-responsive">

            <div class="d-flex">
                <h1>Lista de materiais entregues a {{ $user->name }}</h1>
            </div>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        <th scope="col">Materiais entregues</th>
                        <th scope="col">Tamanho</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Data de entrega</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materialUsers as $entrega)
                        <tr>
                            <td>
                                <input type="checkbox" name="selectedMaterials[]" value="{{ $entrega->id }}">
                            </td>

                            <td>
                                {{ $entrega->material->name }}
                            </td>
                            <td>
                                {{ $entrega->size->size }}
                            </td>
                            <td>
                                {{ $entrega->quantity }}
                            </td>
                            <td>
                                {{ $entrega->delivery_date }}
                            </td>
                            <td>
                                <form action="{{ route('material-user.destroy', $entrega->id) }}" method="POST">
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
                    @endforeach
                </tbody>
            </table>
            <br>
            <div>
                <a href="{{ route('material-user.index') }}" class="btn btn-secondary mx-2">Cancelar</a>
                <button id="delete-selected" class="btn btn-danger">Excluir selecionados</button>
            </div>

        </div>
    </div>

    <script type="module" src="{{ asset('js/material-user/edit.js') }}"></script>
@endsection
