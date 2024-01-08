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
        <div>
            <table class="table bg-white rounded-top">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th scope="col">Número</th>
                        <th scope="col">Título</th>
                        <th scope="col">Utilizador</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Data de Abertura</th>
                        <th scope="col">Data de Vencimento</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="filler"></tr>
                    @foreach($tickets as $ticket)
                        <tr class="ticket-row customTableStyling">
                            <td><input type="checkbox" class="no-propagate" name="selectedtickets[]" value="{{ $ticket->id }}"></td>
                            <td>#{{ isset($ticket->id) ? $ticket->id : 'N.A.' }}</td>
                            <td>{{ isset($ticket->title) ? $ticket->title : 'N.A.' }}</td>
                            <td>{{ isset($ticket->user->name) ? $ticket->user->name : 'N.A.' }}</td>
                            <td>{{ isset($ticket->ticketStatus->description) ? $ticket->ticketStatus->description : 'N.A.' }}</td>
                            <td>{{ isset($ticket->created_at) ? $ticket->created_at->format('d/m/Y H:i:s') : 'N.A.' }}</td>
                            <td>{{ $ticket->dueByDate ? $ticket->dueByDate : 'N.A.' }}</td>
                            <td class="editDelete" style="padding: 0.25rem">
                                <div style="width: 40%;">
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#116fdc" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                    </a>
                                </div>
                                <div style="width: 40%">
                                    <form method="post" action="{{ route('tickets.destroy', $ticket->id) }}" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#116fdc" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                                            </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="filler"></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- {{ $ticekt->links() }} --}}
    </div>
@endsection
