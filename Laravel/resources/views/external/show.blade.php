@extends('master.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

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

        .flatpickr {
            width: 308px;
        }

    </style>
    <div class="container w-100">
        <h1>Detalhes do agendamento da formação</h1>

        @if($partner_Training_Users)
            <div class="grid">

                <div class="training">
                    <label scope="row">Formação</label><br>
                    <input class="form-control {{ optional($partner_Training_Users->training)->name ? '' : 'text-danger' }}" value="{{ optional($partner_Training_Users->training)->name ?? 'Esta formação foi eliminada.' }}" disabled>
                </div>
                <div class="partner">
                    <label scope="row">Parceiro</label><br>
                    <input class="form-control {{ optional($partner_Training_Users->partner)->name ? '' : 'text-danger' }}" value="{{ optional($partner_Training_Users->partner)->name ?? 'O parceiro foi eliminado.' }}" disabled>
                </div>
                <div class="technician">
                    <label scope="row">Técnico</label><br>
                    <input class="form-control {{ optional($partner_Training_Users->user)->name ? '' : 'text-danger' }}" value="{{ optional($partner_Training_Users->user)->name ?? 'O técnico foi eliminado' }}" disabled>
                </div>
                <div class="address">
                    <label scope="row">Morada do Parceiro</label><br>
                    <input class="form-control {{ optional($partner_Training_Users->partner)->address ? '' : 'text-danger' }}" value="{{ optional($partner_Training_Users->partner)->address ?? 'O parceiro foi eliminado.' }}" disabled>
                </div>

                <div class="materials d-flex justify-content-center">
                    @php
                        $materialTraining = $partner_Training_Users->materials;
                    @endphp
                    @if($materialTraining->isNotEmpty())
                    <table class="table bg-white">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>

                        <tbody class="customTableStyling">
                            <tr class="filler"></tr>



                                @foreach($materialTraining as $materialTrainings)
                                    <tr>
                                        <td>{{ $materialTrainings->name }}</td>
                                        <td>{{ $materialTrainings->description }}</td>
                                        <td class="pl-5">{{ $materialTrainings->pivot->quantity }}</td>
                                    </tr>
                                    <tr class="filler"></tr>
                                @endforeach
                            @else
                                <h5 class="">Não existem materiais associados a esta formação</h5>
                            @endif
                            </td>
                        </tbody>
                    </table>
                </div>

                <div class="startCalendar">
                    <label for="start_date">Data de Início:</label>
                    <input type="datetime-local" class="form-control flatpickr" id="start_date" name="start_date" value="{{ date('Y-m-d\TH:i:s', strtotime($partner_Training_Users->start_date)) }}" required>
                </div>

                <div class="endCalendar">
                    <label for="end_date">Data de Fim:</label>
                    <input type="text" class="form-control flatpickr" id="end_date" name="end_date" value="{{ date('Y-m-d\TH:i:s', strtotime($partner_Training_Users->end_date)) }}" required>
                </div>

                <div class="btns">
                    <a href="{{ route('external.edit', $partner_Training_Users->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('external.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        @else
            <p>Não existem registos para esta formação</p>
        @endif
    </div>
@endsection

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
        .grid > div{
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
        .materials thead{
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="module" src="{{ asset('js/external/show.js') }}"></script>
@endsection
