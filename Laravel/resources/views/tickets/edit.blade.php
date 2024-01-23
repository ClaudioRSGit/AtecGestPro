@extends('master.main')

@section('content')
<div class="container">
    <h1>Ticket #{{ $ticket->id }}</h1>

    <form method="post" action="{{ route('tickets.update', $ticket->id) }}">

        @csrf
        @method('put')

        <div class="row">
            <div class="col-md-9">
                <div class="border bg-light">
                <div class="mb-3">
                    <label for="title" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $ticket->title }}">
                </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <textarea class="form-control" id="description" name="description">{{ $ticket->description }}</textarea>
                    </div>
                </div>
                <div class="mb-2">
                    <p>Criado a {{ $ticket->created_at }}</p>
                </div>
                <div class="mb-3">
                    <label for="attachment" class="form-label">Anexo:</label>
                    <input type="file" class="form-control" id="attachment" name="attachment">
                </div>
                <div class="border bg-light">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comentar:</label>
                        <textarea class="form-control" id="comment" name="comment"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comentários:</label>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">Comentário 1</p>
                                <p class="card-text">Comentário 2</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="status" class="form-label">Estado:</label>
                    <select class="form-control" id="status" name="status">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $ticket->ticketStatus->id == $status->id ? 'selected' : '' }}>
                                {{ $status->description }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="technician" class="form-label">Técnico:</label>
                    <select class="form-control" id="technician" name="technician">
                        <option value="">{{$ticket->requester->name}}</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $ticket->technician_id == $user->id ? 'selected' : '' }}>{{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="priority" class="form-label">Prioridade:</label>
                    <select class="form-control" id="priority" name="priority">
                        @foreach($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ $ticket->priority_id == $priority->id ? 'selected' : '' }}>
                                {{ $priority->description }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Categoria:</label>
                    <select class="form-control" id="category" name="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $ticket->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->description }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Data Limite:</label>
                    <label>{{ $ticket->dueByDate ? $ticket->dueByDate : 'N/A' }}</label>
                    <input type="date" class="form-control" id="dueByDate" name="dueByDate" value="{{ $ticket->dueByDate ? $ticket->dueByDate : '' }}">
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

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
