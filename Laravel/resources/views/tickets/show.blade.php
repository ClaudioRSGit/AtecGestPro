@extends('master.main')

@section('content')
    <div class="w-100">
        <h1>Ticket #{{ $ticket->id }}</h1>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ticket-details-tab" data-toggle="tab" href="#ticket-details" role="tab"
                   aria-controls="ticket-details" aria-selected="true">Ticket Details</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ticket-history-tab" data-toggle="tab" href="#ticket-history" role="tab"
                   aria-controls="ticket-history" aria-selected="false">Ticket History</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="ticket-details" role="tabpanel"
                 aria-labelledby="ticket-details-tab">

                <div class="row my-2">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label for="requester" class="form-label">Utilizador:</label>
                            <input type="text" class="form-control" id="requester" name="requester"
                                   value="{{ $requester->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Título:</label>
                            <input type="text" class="form-control" id="title" value="{{ $ticket->title }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição:</label>
                            <textarea class="form-control" id="description"
                                      disabled>{{ $ticket->description }}</textarea>
                        </div>

                        <div class="mb-2">
                            <p>Criado em: {{ $ticket->created_at }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="attachment" class="form-label">Anexo:</label>
                            <input type="text" class="form-control" id="attachment" value="{{ $ticket->attachment }}"
                                   disabled style="border-radius: 5px;">
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
                            <input type="text" class="form-control"
                                   value="{{ $ticket->ticketStatus->description ?? 'N/A' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="technician" class="form-label">Técnico:</label>
                            <input type="text" class="form-control" value="{{ $technician->name ?? 'N/A' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Prioridade:</label>
                            <input type="text" class="form-control"
                                   value="{{ $ticket->ticketPriority->description ?? 'N/A' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Categoria:</label>
                            <input type="text" class="form-control"
                                   value="{{ $ticket->ticketCategory->description ?? 'N/A' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label>Data Limite:</label>
                            <input type="text" class="form-control" value="{{ $ticket->dueByDate ?? 'N/A' }}" disabled>
                        </div>

                        <div class="mb-5" id="histTickets">
                            <label>Histórico do Utilizador:</label>
                            <ul>
                                @foreach($userTickets as $userTicketId)
                                    <li><a href="{{ route('tickets.show', $userTicketId) }}">Ticket
                                            #{{ $userTicketId }}</a></li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="mb-5">
                            <div class="mb-5">
                                <label>Histórico do Ticket:</label>
                                <a href="{{ route('ticket-histories.show', $ticket->id) }}">Ver Histórico</a>
                            </div>
                        </div>
                    </div>
                </div>x\
            </div>


                <div class="tab-pane fade" id="ticket-history" role="tabpanel" aria-labelledby="ticket-history-tab">
                    <div class="my-2">
                        <div class="card bg-primary">

                            <div class="card-body ">
                                @foreach($ticketHistories as $history)
                                    <div class="card mb-3 shadow-lg">
                                        <div class="card-header d-flex justify-content-center align-items-center">
                                            <h5 class="mb-0">{{$history->action->description}}</h5>
                                        </div>
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <p class="card-title">{{$history->created_at}}</p>
                                        </div>
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <p>{!! nl2br(str_replace('.', ".\n", e($history->ticket_info))) !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </div>


    <style>
        #histTickets {
            box-shadow: 1px 2px 1px 2px rgb(230, 229, 229);
            margin: 15px;
            border: 1px solid #141313;
            /* background-color: rgba(203, 234, 248, 0.3); */
            overflow-y: auto;
            overflow-x: auto;
            height: 55px;
        }

    </style>
@endsection
