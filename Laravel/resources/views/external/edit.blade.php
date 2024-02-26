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

    <div class="container  w-100 fade-in">

        @error('start_date')
        <div class="alert alert-danger success-alert">{{ $message }}</div>
        @enderror

        @error('end_date')
        <div class="alert alert-danger success-alert">{{ $message }}</div>
        @enderror

        <h1>Editar formação</h1>

        <form method="post" action="{{ route('external.update', $partner_Training_Users->id) }}">
            @csrf
            @method('put')

            <div class="grid">

                <div class="training">
                    <label for="training_id">Formação:</label>
                    <select class="form-control" id="training_id" name="training_id" required>
                        @foreach($trainings as $training)
                            <option
                                value="{{ $training->id }}" {{ $training->id == $partner_Training_Users->training_id ? 'selected' : '' }}>
                                {{ $training->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="partner">
                    <label for="partner_id">Parceiro:</label>
                    <select class="form-control" id="partner_id" name="partner_id" required>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}"
                                    {{ $partner->id == $partner_Training_Users->partner_id ? 'selected' : '' }} data-address="{{ $partner->address }}">
                                {{ $partner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="technician">
                    <label for="user_id">Técnico:</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        @foreach($users as $user)
                            @if($user->role_id == 4 )
                                <option
                                    value="{{ $user->id }}" {{ $user->id == $partner_Training_Users->user_id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="address">
                    <label for="">Morada:</label>
                    <input type="text" class="form-control" id="address" name="address" disabled>
                </div>

                <div class="startCalendar">
                    <label for="start_date">Data de Início:</label>
                    <input type="datetime-local" class="form-control flatpickr" id="start_date" name="start_date"
                           value="{{ date('Y-m-d\TH:i:s', strtotime($partner_Training_Users->start_date)) }}" required>
                </div>

                <div class="endCalendar">
                    <label for="end_date">Data de Fim:</label>
                    <input type="text" class="form-control flatpickr" id="end_date" name="end_date"
                           value="{{ date('Y-m-d\TH:i:s', strtotime($partner_Training_Users->end_date)) }}" required>
                </div>

                <div class="materials">
                    @if ($materials->isEmpty())
                        <img src="{{ asset('assets/tool.png') }}"
                             alt="Não existem materiais" class="bin" draggable="false">
                    @else
                        <table class="table bg-white">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Selecionar</th>
                            </tr>
                            </thead>
                            <tbody class="customTableStyling">
                            <tr class="filler"></tr>
                            @foreach($partner_Training_Users->materials as $material)
                                <tr>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->description }}</td>
                                    <td class="pl-4">
                                        <input type="number" name="material_quantities[{{ $material->id }}]"
                                               value="{{ $material->pivot->quantity ?? 1 }}" min="0"
                                               max="{{ $material->quantity + $material->pivot->quantity }}">
                                    </td>
                                    <td class="pl-5">
                                        <input type="checkbox" name="materials[{{ $material->id }}]"
                                               value="{{ $material->id }}" {{ $material->pivot->quantity > 0 ? 'checked' : '' }} >
                                    </td>
                                </tr>
                                <tr class="filler"></tr>
                            @endforeach

                            @foreach($materials as $material)
                                @unless($partner_Training_Users->materials->contains($material))
                                    <tr>
                                        <td>{{ $material->name }}</td>
                                        <td>{{ $material->description }}</td>
                                        <td class="pl-4">
                                            <input type="number" name="material_quantities[{{ $material->id }}]"
                                                   value="0" min="0" max="{{ $material->quantity }}"
                                                   @if($material->quantity == 0) disabled @endif >
                                        </td>
                                        <td class="pl-5">
                                            <input type="checkbox" name="materials[{{ $material->id }}]"
                                                   value="{{ $material->id }}"
                                                   @if($material->quantity == 0) disabled @endif>
                                        </td>
                                    </tr>
                                    <tr class="filler"></tr>
                                @endunless
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <div class="btns">
                    <button type="submit" class="btn btn-primary">Atualizar formação</button>
                    <a href="{{ route('external.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <style>
        .form-control[readonly] {
            opacity: 0 !important;
            height: 0;
            padding: 0;
        }

        .grid {
            display: grid;
            grid-template-areas:
                'training partner startCalendar'
                'technician address startCalendar'
                'materials materials endCalendar'
                'materials materials endCalendar'
                'buttons . .';
            place-items: center;
            grid-gap: 1rem;
        }

        .grid > div {
            width: 100%;
        }

        .partner {
            grid-area: partner;
        }

        .training {
            grid-area: training;
        }

        .technician {
            grid-area: technician;
        }

        .address {
            grid-area: address;
        }

        .materials {
            grid-area: materials;
            align-self: start;
            display: flex;
            max-height: 20rem;
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


        .startCalendar {
            grid-area: startCalendar;
        }

        .startCalendar input {
            margin: auto;
        }

        .endCalendar {
            grid-area: endCalendar;
        }

        .btns {
            grid-area: buttons;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
    <script>
        jQuery(function () {
            flatpickr("#start_date, #end_date", {
                inline: true,
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                minDate: "today",
                locale: "pt"
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var partnerDropdown = document.getElementById('partner_id');
            var addressField = document.getElementById('address');

            function setAddress() {
                var selectedOption = partnerDropdown.options[partnerDropdown.selectedIndex];
                addressField.value = selectedOption.getAttribute('data-address');
            }

            setAddress();

            partnerDropdown.addEventListener('change', setAddress);
        });

        window.setTimeout(function () {
            $(".success-alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 2500);
    </script>
@endsection
