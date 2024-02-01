@extends('master.main')
@section('title', 'Tickets')
@section('content')
    <div class="w-100">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#success-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function() {
                    $('#error-alert').fadeOut('slow');
                }, 3000);
            </script>
        @endif


        <div class="d-flex justify-content-between mb-3">

            <form action="{{ route('tickets.index') }}" method="get" id="ticketSearchForm">
                <div class="input-group pr-2">
                    <div class="search-container">
                        <input type="text" class="form-control" id="ticketSearch" name="ticketSearch"
                            value="{{ request('ticketSearch') }}"
                            placeholder="{{ request('ticketSearch') ? request('ticketSearch') : 'Pesquisar ticket...' }}">
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">
                            Procurar
                        </button>
                    </div>
                </div>

            </form>
            <div class="buttons">
                <form id="filterCategoryForm" action="{{ route('tickets.index') }}" method="GET">
                    <select class="form-control w-auto" id="filterCategory" name="filterCategory"
                        onchange="submitCategoryForm()">
                        <option value="" {{ $filterCategory === '' ? 'selected' : '' }}>Todas as categorias
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (int) $filterCategory === $category->id ? 'selected' : '' }}>{{ $category->description }}
                            </option>
                        @endforeach

                    </select>
                </form>

                <form id="filterStatusForm" action="{{ route('tickets.index') }}" method="GET">
                    <select class="form-control w-auto" id="filterStatus" name="filterStatus" onchange="submitStatusForm()">
                        <option value="" {{ $filterStatus === '' ? 'selected' : '' }}>Todos os estados</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ (int) $filterStatus === $status->id ? 'selected' : '' }}>{{ $status->description }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <form id="filterPriorityForm" action="{{ route('tickets.index') }}" method="GET">
                    <select class="form-control w-auto" id="filterPriority" name="filterPriority"
                        onchange="submitPriorityForm()">
                        <option value="" {{ $filterPriority === '' ? 'selected' : '' }}>Todas as prioridades
                        </option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}"
                                {{ (int) $filterPriority === $priority->id ? 'selected' : '' }}>
                                {{ $priority->description }}</option>
                        @endforeach
                    </select>
                </form>


                <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                    <img src="{{ asset('assets/new.svg') }}"> Novo Ticket
                </a>


            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="all-tickets-tab" data-toggle="tab" href="#allTickets" role="tab" aria-controls="allTickets" aria-selected="true">Todos os tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="waiting-queue-tab" data-toggle="tab" href="#waitingQueue" role="tab" aria-controls="waitingQueue" aria-selected="false">Fila de Espera</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="recycling-tab" data-toggle="tab" href="#recycling" role="tab" aria-controls="recycling" aria-selected="false">Reciclagem</a>
            </li>
        </ul>

        <div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="allTickets" role="tabpanel" aria-labelledby="all-tickets-tab">

                @if (count($tickets) === 0)
                <div>
                    <img src="{{ asset('assets/noTickets.png') }}" class="noTicket">
                </div>

            @else
            <table class="table bg-white rounded-top">
                <thead>
                    <tr>
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
                    <tr class="filler"></tr>
                    @foreach ($tickets as $ticket)
                        <tr class="customTableStyling" id="heading{{ $ticket->id }}"
                            onclick="location.href='{{ route('tickets.show', $ticket->id) }}'">

                            <td>
                                <a class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $ticket->id }}"
                                    aria-expanded="true" aria-controls="collapse{{ $ticket->id }}">
                                    #{{ $ticket->id ? $ticket->id : 'N.A.' }}
                                </a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2"
                                        style="height: 15px; width: 15px; background-color: {{ $ticket->ticketPriority->id == 1 ? 'green' : ($ticket->ticketPriority->id == 2 ? 'green' : ($ticket->ticketPriority->id == 3 ? 'yellow' : ($ticket->ticketPriority->id == 4 ? 'orange' : 'red'))) }}; border-radius: 50%; display: inline-block; opacity: 0.5;"></span>
                                    <p>{{ $ticket->title ? $ticket->title : 'N.A.' }}</p>
                                </div>
                            </td>
                            <td>{{ $ticket->requester->name ? $ticket->requester->name : 'N.A.' }}</td>
                            <td>
                                @foreach ($ticket->users as $user)
                                    {{ $user->name }}
                                @endforeach
                            </td>
                            <td>{{ $ticket->ticketStatus->description ? $ticket->ticketStatus->description : 'N.A.' }}</td>
                            <td>{{ $ticket->created_at ? $ticket->created_at->format('d-m-Y') : 'N.A.' }}</td>
                            <td>{{ $ticket->dueByDate ? \Carbon\Carbon::parse($ticket->dueByDate)->format('d-m-Y') : 'N.A.' }}
                            </td>
                            <td class="editDelete">
                                <div>
                                    <a href="{{ route('tickets.edit', $ticket->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                            viewBox="0 0 512 512">
                                            <path fill="#116fdc"
                                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                        </svg>
                                    </a>
                                </div>
                                <div>
                                    <form method="post" action="{{ route('tickets.destroy', $ticket->id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar?')"
                                            style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                                viewBox="0 0 448 512">
                                                <path fill="#116fdc"
                                                    d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="filler"></tr>
                    @endforeach
                </tbody>
            </table>
                @endif

        </div>

<div class="tab-pane fade" id="waitingQueue" role="tabpanel" aria-labelledby="waiting-queue-tab">
    @if (count($tickets) === 0)
                <div>
                    <img src="{{ asset('assets/noTickets.png') }}" class="noTicket">
                </div>

    @else
    <table class="table bg-white rounded-top">
        <thead>
            <tr>
                <th scope="col">Número</th>
                <th scope="col">Título</th>
                <th scope="col">Utilizador</th>
                <th scope="col">Técnico</th>
                <th scope="col">Estado</th>
                <th scope="col">Data de Abertura</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($waitingQueueTickets as $ticket)
                <tr class="customTableStyling">
                    <td>#{{ $ticket->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="mr-2"
                                style="height: 15px; width: 15px; background-color: {{ $ticket->ticketPriority->id == 1 ? 'green' : ($ticket->ticketPriority->id == 2 ? 'green' : ($ticket->ticketPriority->id == 3 ? 'yellow' : ($ticket->ticketPriority->id == 4 ? 'orange' : 'red'))) }}; border-radius: 50%; display: inline-block; opacity: 0.5;"></span>
                            <p>{{ $ticket->title ? $ticket->title : 'N.A.' }}</p>
                        </div>
                    </td>
                    <td>{{ $ticket->requester->name }}</td>
                    <td>
                        @foreach ($ticket->users as $user)
                            {{ $user->name }}
                        @endforeach
                    </td>
                    <td>{{ $ticket->ticketStatus->description }}</td>
                    <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                    <td class="editDelete">
                        <div>
                            <a href="{{ route('tickets.edit', $ticket->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                    viewBox="0 0 512 512">
                                    <path fill="#116fdc"
                                        d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                </svg>
                            </a>
                        </div>
                        <div>
                            <form method="post" action="{{ route('tickets.destroy', $ticket->id) }}"
                                style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja apagar?')"
                                    style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                        viewBox="0 0 448 512">
                                        <path fill="#116fdc"
                                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr class="filler"></tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>


<div class="tab-pane fade" id="recycling" role="tabpanel" aria-labelledby="recycling-tab">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Número</th>
                <th scope="col">Título</th>
                <th scope="col">Utilizador</th>
                <th scope="col">Técnico</th>
                <th scope="col">Estado</th>
                <th scope="col">Data de Abertura</th>
                <th scope="col">Restaurar</th>
                <th scope="col">Apagar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recycledTickets as $ticket)
                <tr class="customTableStyling">
                    <td>#{{ $ticket->id }}</td>
                    <td class="d-flex align-items-center">
                        <span class="mr-2"
                            style="height: 15px; width: 15px; background-color: {{ $ticket->ticketPriority->id == 1 ? 'green' : ($ticket->ticketPriority->id == 2 ? 'green' : ($ticket->ticketPriority->id == 3 ? 'yellow' : ($ticket->ticketPriority->id == 4 ? 'orange' : 'red'))) }}; border-radius: 50%; display: inline-block; opacity: 0.5;"></span>
                        <p>{{ $ticket->title ? $ticket->title : 'N.A.' }}</p>
                    </td>
                    <td>{{ $ticket->requester->name }}</td>
                    <td>
                        @foreach ($ticket->users as $user)
                            {{ $user->name }}
                        @endforeach
                    </td>
                    <td>{{ $ticket->ticketStatus->description }}</td>
                    <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('tickets.restore', $ticket->id) }}">
                            <img src="{{ asset('assets/restore.svg') }}">
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('tickets.forceDelete', $ticket->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem a certeza que deseja apagar permanentemente?')" style="border: none; background: none; padding: 0;">
                                <img src="{{ asset('assets/permaDelete.svg') }}" alt="Delete">
                            </button>
                        </form>
                    </td>
                </tr>
                <tr class="filler"></tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>
            {{ $tickets->appends(request()->input())->links() }}

        </div>

        <style>
            thead th{
                border-top: none!important;
            }
            .noTicket {
                margin-top: 100px!important;
                width: 20%;
                height: auto;
                margin: 0 auto;
                display: block;
                opacity: 0.5;
            }
        </style>

    <script>
        function submitCategoryForm() {

            document.getElementById("filterCategoryForm").submit();

        }

        function submitStatusForm() {

            document.getElementById("filterStatusForm").submit();

        }

        function submitPriorityForm() {

            document.getElementById("filterPriorityForm").submit();

        }

        window.setTimeout(function() {
            $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>

    <script>
        $(function() {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                localStorage.setItem('lastTab', $(this).attr('href'));
            });

            let lastTab = localStorage.getItem('lastTab');
            if (lastTab) {
                $('[href="' + lastTab + '"]').tab('show');
            }
        });
    </script>

    @endsection
