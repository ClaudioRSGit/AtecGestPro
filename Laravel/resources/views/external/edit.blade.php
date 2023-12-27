@extends('master.main')

@section('content')

    <style>
        .container {
            font-family: 'Manrope', sans-serif;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 1%;
            right: 0%;
            bottom: 0%;
            left: 50%;
            position: fixed;
            background-image: radial-gradient(circle, rgba(17, 111, 220, 0.1), rgba(120, 143, 228, 0.2), rgba(173, 177, 237, 0.1), rgba(217, 215, 246, 0), rgba(255, 255, 255, 0.1));
            z-index: -1;
        }


    </style>


    <div class="container">
        <h1>Editar formação</h1>
        <form method="post" action="{{ route('external.update', $partner_Trainings_Users->id) }}">

{{--           @dd($partner_Trainings_Users)--}}
            @csrf
            @method('put')

            <div class="form-group">
                <label for="partner_id">Parceiro:</label>
                <select class="form-control" id="partner_id" name="partner_id" required>
                    @foreach($partners as $partner)
                        <option value="{{ $partner->id }}" {{ $partner->id == $partner_Trainings_Users->partner_id ? 'selected' : '' }}>
                            {{ $partner->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="training_id">Formação:</label>
                <select class="form-control" id="training_id" name="training_id" required>
                    @foreach($trainings as $training)
                        <option value="{{ $training->id }}" {{ $training->id == $partner_Trainings_Users->training_id ? 'selected' : '' }}>
                            {{ $training->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">Técnico:</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach($users as $user)
                        @foreach($role_users as $role_user)
                            @if($role_user->role_id == 4 && $role_user->user_id == $user->id)
                            <option value="{{ $user->id }}" {{ $user->id == $partner_Trainings_Users->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <label for="start_date">Data de Início:</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ date('Y-m-d\TH:i:s', strtotime($partner_Trainings_Users->start_date)) }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">Data de Fim:</label>
                <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ date('Y-m-d\TH:i:s', strtotime($partner_Trainings_Users->end_date)) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Parceiro</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary ">Voltar</a>
        </form>
    </div>
@endsection
