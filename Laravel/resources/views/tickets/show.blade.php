@extends('master.main')

@section('content')
<div class="container">
    <h1>Ticket #{{ $ticket->id }}</h1>

    <div class="row">
        <div class="col-md-9">
            <div class="mb-3">
                <label for="title" class="form-label">Título:</label>
                <input type="text" class="form-control" id="title" value="{{ $ticket->title }}" disabled>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" id="description" disabled>{{ $ticket->description }}</textarea>
            </div>

            <div class="mb-2">
                <p>Criado em: {{ $ticket->created_at }}</p>
            </div>

            <div class="mb-3">
                <label for="attachment" class="form-label">Anexo:</label>
                <input type="text" class="form-control" id="attachment" value="{{ $ticket->attachment }}" disabled style="border-radius: 5px;">
                @if($ticket->attachment)
                    <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">Ver Anexo</a>
                @endif
            </div>

            <div class="mb-3">
                <form action="{{ route('comments.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                    <div class="mb-3">
                        <label for="new-comment" class="form-label">Adicionar Comentário:</label>
                        <textarea class="form-control" id="new-comment" name="comment" required></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Enviar Comentário</button>
                    </div>
                </form>

                <div class="mb-3">
                    <label for="comments" class="form-label">Comentários:</label>
                    @if ($ticket->comments->isNotEmpty())
                        @foreach($ticket->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-body d-flex justify-content-between">
                                    <div>
                                        <label class="card-text font-weight-bold">
                                            {{ $comment->user->name }}:
                                        </label>
                                        {{ $comment->description }}
                                    </div>
                                    <div>
                                        <p class="card-text">
                                            {{ $comment->created_at }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <p>Não existem comentários para este ticket.</p>
                    @endif
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
                <input type="text" class="form-control" value="{{ $ticket->ticketCategory->description ?? 'N/A' }}" disabled>
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
