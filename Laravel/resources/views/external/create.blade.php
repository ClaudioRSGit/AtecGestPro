@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')


    <div class="container">
        <h1>Agendar formação de mercado</h1>
        <form method="POST" action="{{ url('external') }}">
            @csrf
            <div class="row">


                <div class="form-group col-4">
                    <label for="partner_id">Parceiro:</label>
                    <select class="form-control" id="partner_id" name="partner_id" required>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-4">
                    <label for="training_id">Formação:</label>
                    <select class="form-control" id="training_id" name="training_id" required>
                        @foreach($trainings as $training)
                            <option value="{{ $training->id }}">{{ $training->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-4">
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
            </div>


            <div class="row">


                <div class="col-8" style="border: #1b1e21 ">

                </div>


                <div class="form-group col-4">



                    <input type="datetime-local" class="form-control " id="start_date" name="start_date" required placeholder="Selecione a data de início">
                    <br>



                    <input type="datetime-local" class="form-control " id="end_date" name="end_date" required placeholder="Selecione a data de fim">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Criar Parceiro</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary ">Voltar</a>




        </form>

    </div>




@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        jQuery(function () {
            flatpickr("#start_date, #end_date", {
                inline: true,
                altInput: true,
                altFormat: "F j, Y",
            });
        });
    </script>
@endsection
