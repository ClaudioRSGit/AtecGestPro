@extends('master.main')

@section('content')
    <div class="container">

        <form class="mb-3" method="post" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">

            @csrf
            @method('put')

            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex justify-content-between">
                        <div class="w-15">
                            <h2 for="title" class="form-label">Ticket #{{ $ticket->id }} -</h2>
                        </div>
                        <div class="w-85">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $ticket->title }}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="table-responsive">
                            <span class="rounded-circle bg-primary text-white" style="width: 30px; height: 30px; font-size: 13px; margin-right: 5px; display: inline-block; text-align: center; line-height: 30px; z-index: 1000;">
                                <strong>{{ $requester->initials }}</strong>
                            </span>
                            <b>{{ $requester->name }}</b>
                            - {{ $ticket->created_at }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição:</label>
                        <div class="bg-light">

                            <!-- Hidden input field to store Quill HTML content -->
                            <input type="hidden" id="descriptionInput" name="description" value="{{ $ticket->description }}">
                            <!-- Quill editor -->
                            <div id="description" style="height: 200px;">{!! old('description') !!}
                                {!! $ticket->description !!}
                            </div>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2">
                        <p><strong>Criado a </strong>{{ $ticket->created_at }}</p>
                    </div>

                    <label for="attachment" class="form-label">Anexo:</label>
                        <div class="w-100 d-flex justify-content-between">
                            <input type="file" class="form-control w-75" id="attachment" name="attachment">
                            <button type="submit" class="btn btn-primary w-10">Guardar</button>
                            <a href="{{ route('tickets.index') }}" class="btn btn-secondary w-10">Cancelar</a>
                        </div>
                    <p>Certifique-se que o arquivo tem menos de 20MB</p>

                    @if ($ticket->attachment)
                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">Ver Anexo</a>
                    @endif
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado:</label>
                        <select class="form-control" id="status" name="ticket_status_id">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ $status->id == $ticket->ticketStatus->id ? 'selected' : '' }}>
                                    {{ $status->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Prioridade:</label>
                        <select class="form-control" id="priority" name="ticket_priority_id">
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority->id }}"
                                    {{ $priority->id == $ticket->ticketPriority->id ? 'selected' : '' }}>
                                    {{ $priority->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="technician" class="form-label">Técnico:</label>

                        <select class="form-control" id="technician_id" name="technician_id">

                            @foreach ($technicians as $technician)
                                <option value="{{ $technician->id }}"
                                    {{ $ticketTechnician->user_id == $technician->id ? 'selected' : '' }}>
                                    {{ $technician->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria:</label>
                        <select class="form-control" id="category" name="ticket_category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $ticket->ticketCategory->id ? 'selected' : '' }}>
                                    {{ $category->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Histórico do Utilizador:</label>
                        <ul>
                            @foreach ($userTickets as $userTicketId)
                                <li><a href="{{ route('tickets.show', $userTicketId) }}">Ticket #{{ $userTicketId }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </form>

            <div class="mb-3">
                <label for="comments" class="form-label">Insira uma nota ou comentário:</label>
                <form action="{{ route('comments.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                    <div class="mb-3">
                        <textarea class="form-control" id="new-comment" name="comment" required></textarea>
                        <div class="d-flex justify-content-between" style="gap: 10px;">
                            <button type="submit" class="btn btn-primary mt-2 flex-grow-1">Enviar Comentário</button>
                            <a type="button" href="{{ url()->previous() }}" class="btn btn-secondary mt-2 flex-grow-1">Voltar</a>
                        </div>
                    </div>
                </form>

                <div class="mb-3">
                    <h3 for="comments" class="form-label">Comentários:</h3>

                    @if ($ticket->comments->isNotEmpty())
                        @foreach ($ticket->comments as $comment)
                            <div class="card mb-2 bg-light mx-4">
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
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#description', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                var htmlContent = quill.root.innerHTML;
                document.getElementById('descriptionInput').value = htmlContent;
            });
        });
    </script>
@endsection

<style>
    .col-md-9 {
        padding-left: 0 !important;
    }
</style>
