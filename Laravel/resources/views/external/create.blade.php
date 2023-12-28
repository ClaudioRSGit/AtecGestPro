@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">


@endsection

@section('content')
    <style>
        .flatpickr {
          width:   308px;
        }
    </style>


    <div class="container">
        <h1>Agendar formação de mercado</h1>
        <form method="POST" action="{{ url('external') }}">
            @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 py-3">

                        <label for="partner_id">Parceiro:</label>
                        <select class="form-control" id="partner_id" name="partner_id" required>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 py-3">
                        <label for="training_id">Formação:</label>
                        <select class="form-control" id="training_id" name="training_id" required>
                            @foreach($trainings as $training)
                                <option value="{{ $training->id }}">{{ $training->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 py-3">
                        <label for="user_id">Técnico:</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            @foreach($users as $user)
                                @foreach($role_users as $role_user)
                                    @if($role_user->role_id == 4 && $role_user->user_id == $user->id)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 py-3">
                        col4
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="border: 2px solid #fff8b3" >
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Stock</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($materials as $material)
                                <tr>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->description }}</td>
                                    <td>{{ $material->quantity }}</td>
                                    <td><input type="checkbox" name="materials[]" value="{{ $material->id }}"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pt-5">
                <input type="datetime-local" class="form-control flatpickr" id="start_date" name="start_date" required placeholder="Selecione a data de início">
                <br>


            <div class="row mb-3">

                <input type="datetime-local" class="form-control flatpickr" id="end_date" name="end_date" required placeholder="Selecione a data de fim">

                <div class="col-8 mb-3" style="border: #1b1e21 ">

                </div>


                <div class="form-group col-4 d-flex flex-column justify-content-between align-items-end">

                    <div class="test1 d-flex flex-column">
                        <label>Data Início</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="test2 d-flex flex-column">
                        <label class="mt-3">Data Fim</label>
                        <input type="datetime-local" class="form-control " id="end_date" name="end_date" required>
                    </div>


                </div>
            </div>
            <button type="submit" class="btn btn-primary">Agendar formação</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary ">Voltar</a>
        </div>
        </form>
    </div>

    <style>
        .form-control[readonly] {
            opacity: 0;
            height: 0;
            padding: 0;
        }
    </style>




@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        jQuery(function () {
            flatpickr("#start_date, #end_date", {
                inline: true,
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                minDate: "today",


            });
        });
    </script>
@endsection
