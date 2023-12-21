@extends('master.main')

@section('content')
    <div class="container">
        <h1>Editar formação</h1>
        <form method="post" action="{{ route('external.update', $partner_Trainings_Users->id) }}">

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
                        <option value="{{ $user->id }}" {{ $user->id == $partner_Trainings_Users->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
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
            <a href="{{ route('external.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </form>
    </div>
@endsection
