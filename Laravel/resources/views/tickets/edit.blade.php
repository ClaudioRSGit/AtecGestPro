@extends('master.main')

@section('content')
    <div class="container">
        <h1>Ticket #{{ $ticket->id }}</h1>

        <form method="post" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">

            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="requester" class="form-label">Utilizador:</label>
                        <input type="text" class="form-control" id="requester" name="requester" value="{{ $requester->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $ticket->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ $ticket->description }}</textarea>
                    </div>

                    <div class="mb-2">
                        <p>Criado a {{ $ticket->created_at }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="attachment" class="form-label">Anexo:</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" required>
                        <p>Make sure you upload a file smaller than 20MB</p>
                    </div>

                    @if($ticket->attachment)
                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">Ver Anexo</a>
                    @endif
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado:</label>
                        <select class="form-control" id="status" name="ticket_status_id">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ $ticket->ticketStatus->id == $status->id ? 'selected' : '' }}>
                                    {{ $status->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Prioridade:</label>
                        <select class="form-control" id="priority" name="ticket_priority_id">
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}" {{ $ticket->priority_id == $priority->id ? 'selected' : '' }}>
                                    {{ $priority->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="technician" class="form-label">Técnico:</label>
                        <select class="form-control" id="technician" name="user_id">
                            <option value="">{{$ticket->requester->name}}</option>
                            @foreach($technicians as $technician)
                                <option value="{{ $technician->id }}" {{ $ticket->user_id == $technician->id ? 'selected' : '' }}>{{ $technician->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria:</label>
                        <select class="form-control" id="category" name="ticket_category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Data Limite:</label>
                        <input type="date" class="form-control" id="dueByDate" name="dueByDate" value="{{ $ticket->dueByDate ? $ticket->dueByDate : '' }}">
                    </div>
                    <div class="mb-5">
                        <label>Histórico do Utilizador</label>
                        @foreach($userTickets as $userTicketId)
                        <ul>
                                <li><a href="{{ route('tickets.show', $userTicketId) }}">Ticket #{{ $userTicketId }}</a></li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>

        </form>
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
                @foreach($ticket->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <p class="card-text">
                                    {{ $comment->user->name }}: {{ $comment->description }}
                                </p>
                            </div>
                            <div>
                                <p class="card-text">
                                    {{ $comment->created_at }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
