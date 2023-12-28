@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <style>
        .flatpickr {
            width: 308px;
        }
    </style>

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
                <input type="text" class="form-control flatpickr" id="start_date" name="start_date" value="{{ date('Y-m-d\TH:i:s', strtotime($partner_Trainings_Users->start_date)) }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">Data de Fim:</label>
                <input type="text" class="form-control flatpickr" id="end_date" name="end_date" value="{{ date('Y-m-d\TH:i:s', strtotime($partner_Trainings_Users->end_date)) }}" required>
            </div>

            <div class="form-group">
                <h3>Materiais</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Select</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($materials as $material)
                        <tr>
                            <td>{{ $material->name }}</td>
                            <td>{{ $material->description }}</td>
                            <td>
                                <input type="number" name="material_quantities[{{ $material->id }}]" value="{{ $material->quantity }}" min="1">
                            </td>
                            <td>
                                <input type="checkbox" name="materials[]" value="{{ $material->id }}" {{ in_array($material->id, $selectedMaterials) ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar formação</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr(".flatpickr", {
            enableTime: true,
            altInput: true,
            altFormat: "F j, Y H:i",
            dateFormat: "Y-m-d\TH:i:s",
            minDate: "today",
        });
    </script>
@endsection
