@extends('master.main')

@section('content')
    <div class="container">
        <h1>Tickets</h1>
        <div class="d-flex justify-content-between mb-3">
            <form class="form-inline w-50" id="filterForm">
                <div class="form-group search-container mr-3 w-100" style="width: 30%;">
                    <input type="text" id="search" class="form-control w-100" placeholder="Pesquisar Ticket">
                </div>

            </form>
            <div class="buttons">
                <div>
                    <select class="form-control" id="filter">
                        <option value="all">Todos</option>
                        <option value="internal">Interno</option>
                        <option value="clothing">Fardamento</option>
                        <option value="external">Externo</option>
                    </select>
                </div>
                <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                    <img src="{{ asset('assets/new.svg') }}">
                    Novo Ticket
                </a>
            </div>
        </div>
        <div class="accordion" id="ticketsAccordion">
            <table class="table bg-white rounded-top">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th scope="col">Número</th>
                        <th scope="col">Título</th>
                        <th scope="col">Utilizador</th>
                        <th scope="col">Técnico</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Data de Abertura</th>
                        <th scope="col">Data de Vencimento</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr class="filler"></tr>
                <tr class="card-header" id="heading{{ $ticket->id }}">
                    <td><input type="checkbox" id="select-all"></td>
                    <td>
                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $ticket->id }}" aria-expanded="true" aria-controls="collapse{{ $ticket->id }}">
                        {{ $ticket->id ? $ticket->id : 'N.A.' }}
                    </a>
                    </td>
                    <td>{{ $ticket->title ? $ticket->title : 'N.A.' }}</td>
                    <td>{{ $ticket->requester->name ? $ticket->requester->name : 'N.A.' }}</td>
                    <td>
                        @foreach($ticket->users as $user)
                            {{ $user->name }}
                        @endforeach
                    </td>
                    <td>{{ $ticket->ticketStatus->description ? $ticket->ticketStatus->description : 'N.A.' }}</td>
                    <td>{{ $ticket->created_at ? $ticket->created_at->format('d/m/Y H:i:s') : 'N.A.' }}</td>
                    <td>{{ $ticket->dueByDate ? $ticket->dueByDate : 'N.A.' }}</td>
                    <div id="collapse{{ $ticket->id }}" class="collapse" aria-labelledby="heading{{ $ticket->id }}" data-parent="#ticketsAccordion">
                        <div class="card-body">
                            {{ $ticket->description }}
                        </div>
                    </div>
                </tr>
                <tr class="filler"></tr>
                @endforeach
                </tbody>
            </table>
        {{-- {{ $ticekt->links() }} --}}
        </div>
    </div>
@endsection
