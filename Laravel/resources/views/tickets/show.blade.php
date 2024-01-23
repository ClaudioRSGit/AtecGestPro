@extends('master.main')

@section('content')
<div class="container">
    <h1>Ticket #{{ $ticket->id }}</h1>

    <div class="row">
        <div class="col-md-9">
            <div class="border bg-light">
                <div class="mb-3">
                    <label for="title" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $ticket->title }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="description" name="description" disabled>{{ $ticket->description }}</textarea>
                </div>
            </div>
            <div class="mb-2">
                <p>Criado em: {{ $ticket->created_at }}</p>
            </div>
            <div class="mb-3">
                <label for="attachment" class="form-label">Anexo:</label>
                <input type="text" class="form-control" id="attachment" name="attachment" value="{{ $ticket->attachment }}" disabled>
            </div>
            <div class="border bg-light">
                <div class="mb-3">
                    <label for="comment" class="form-label">Comentários:</label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label for="status" class="form-label">Estado:</label>
                <input type="text" class="form-control" value="{{ $ticket->ticketStatus->description ?? 'N/A' }}" disabled>
            </div>
            <div class="mb-3">
                <label for="technician" class="form-label">Técnico:</label>
                <input type="text" class="form-control" value="{{ $ticket->requester->name ?? 'N/A' }}" disabled>
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Prioridade:</label>
                <input type="text" class="form-control" value="{{ $ticket->ticketPriority->description ?? 'N/A' }}" disabled>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Categoria:</label>
                    <select class="form-control" id="category" name="category" disabled>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->description }}
                            </option>
                        @endforeach
                    </select>
            </div>
            <div class="mb-3">
                <label>Data Limite:</label>
                <input type="text" class="form-control" value="{{ $ticket->dueByDate ?? 'N/A' }}" disabled>
            </div>
            <div class="mb-5">
                <label>Histórico do Utilizador:</label>
                <ul>
                    @foreach($userTickets as $userTicketId)
                        <li><a href="{{ route('tickets.show', $userTicketId) }}">Ticket #{{ $userTicketId }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
