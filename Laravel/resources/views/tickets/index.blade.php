@extends('master.main')

@section('content')
    <div class="container fade-in w-100">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <h1>Tickets</h1>
            <div onclick="showOptions()" class="form-control btn-primary w-20 dropdown newTicket" style="max-width: 10rem;">
                <div class="d-flex align-items-center w-100 h-100">
                    <i class="fa-solid fa-pen mr-1" style="color: #ffffff;"></i>
                    <p id="open" class="btn text-white">Novo ticket</p>
                </div>
                <div id="options" class="dropdown-menu w-100 h-auto">
                    <button id="openTicket" class="btn dropdown-item" onclick="showQuickTicket()">Ticket rápido</button>
                    <button onclick="location.href='{{ route('tickets.create') }}'" class="btn dropdown-item">Ticket
                        completo
                    </button>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="all-tickets-tab" data-toggle="tab" href="#tickets" role="tab"
                   aria-controls="allTickets" aria-selected="true">Todos os tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="waiting-queue-tab" data-toggle="tab" href="#fila_de_espera" role="tab"
                   aria-controls="waitingQueue" aria-selected="false">Fila de Espera</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="recycling-tab" data-toggle="tab" href="#reciclagem_tickets" role="tab"
                   aria-controls="recycling" aria-selected="false">Reciclagem</a>
            </li>
        </ul>
        <div>
            <div class="tab-content" id="myTabContent">


                <div class="tab-pane fade show active" id="tickets" role="tabpanel"
                     aria-labelledby="all-tickets-tab">
                    <div class="d-flex justify-content-between my-3">

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
                                <select class="form-control w-auto " id="filterCategory" name="filterCategory"
                                        onchange="submitCategoryForm()">
                                    <option value="" {{ $filterCategory === '' ? 'selected' : '' }}>
                                        Todas as categorias
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (int) $filterCategory === $category->id ? 'selected' : '' }}>{{ $category->description }}
                                        </option>
                                    @endforeach

                                </select>
                            </form>
                            <form id="filterStatusForm" action="{{ route('tickets.index') }}" method="GET">
                                <select class="form-control w-auto" id="filterStatus" name="filterStatus"
                                        onchange="submitStatusForm()">
                                    <option value="" {{ $filterStatus === '' ? 'selected' : '' }}>Todos os estados
                                    </option>
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
                                    <option value="" {{ $filterPriority === '' ? 'selected' : '' }}>
                                        Todas as prioridades
                                    </option>
                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}"
                                            {{ (int) $filterPriority === $priority->id ? 'selected' : '' }}>
                                            {{ $priority->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    @if (count($tickets) === 0)
                        <div>
                            <img src="{{ asset('assets/noTickets.png') }}" class="noTicket">
                        </div>
                    @else
                        @php
                            $currentSort = request('sort');
                            $currentDirection = request('direction', 'asc');
                            $newDirection = $currentDirection == 'asc' ? 'desc' : 'asc';
                        @endphp
                        <table class="table bg-white rounded-top ticketsTable">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <a href="{{ route('tickets.index', ['sort' => 'number', 'direction' => $currentSort === 'number' ? $newDirection : 'asc']) }}">
                                        Número
                                        @if ($newDirection === 'asc' && $currentSort === 'number')
                                        <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col">

                                    <a href="{{ route('tickets.index', ['sort' => 'title', 'direction' => $currentSort === 'title' ? $newDirection : 'asc']) }}">
                                        Título
                                        @if ($newDirection === 'asc' && $currentSort === 'title')
                                        <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="mobileHidden">
                                    <a href="{{ route('tickets.index', ['sort' => 'user', 'direction' => $currentSort === 'user' ? $newDirection : 'asc']) }}">
                                        Utilizador
                                        @if ($newDirection === 'desc' && $currentSort === 'user')
                                        <i class="fa-solid fa-arrow-up-z-a" style="color: #116fdc;"></i>
                                        @else
                                        <i class="fa-solid fa-arrow-down-a-z" style="color: #116fdc;"></i>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="mobileHidden">
                                    Técnico

                                </th>
                                <th scope="col" class="mobileHidden">
                                    Categoria
                                </th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="mobileHidden">Data de Abertura</th>
                                <th scope="col" class="mobileHidden">Data de Vencimento</th>
                                <th scope="col">
                                    <div class="centerTd">Ações</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="filler"></tr>
                            @foreach ($tickets as $ticket)
                                <tr class="customTableStyling {{ $ticket->ticketPriority->id == 5 ? 'critical' : '' }}"
                                    id="heading{{ $ticket->id }}">

                                    <td>
                                        <div class="position-relative">
                                            <span>#{{ $ticket ? $ticket->id : 'N.A.' }}</span>
                                            @if($ticket->created_at->diffInDays($now) < 5)
                                                <span
                                                    class="badge badge-success position-absolute top-50 translate-middle-y ml-3 mt-1">Novo!</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="clickable">
                                        <div class="d-flex align-items-center">
                                            <span
                                                class="mr-2 ticket-prio ticket-priority-{{ $ticket->ticketPriority->id }}"></span>
                                            <a href="{{ route('tickets.show', $ticket->id) }}"
                                               class="d-flex align-items-center w-auto h-100">{{ $ticket ? $ticket->title : 'N.A.' }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="clickable mobileHidden">
                                        @showIfNotDeleted($ticket)
                                            @if($ticket->requester->name !== 'Utilizador Padrao')
                                                <a href="{{ route('users.show', $ticket->user_id) }}"
                                                class="d-flex align-items-center w-auto h-100">
                                                {{ $ticket->requester ? $ticket->requester->name : 'N.A.' }}
                                            </a>
                                            @else
                                            {{ $ticket->requester ? $ticket->requester->name : 'N.A.' }}
                                            @endif
                                        @endshowIfNotDeleted
                                    </td>
                                    <td class="clickable mobileHidden">
                                        @foreach ($ticket->users as $user)
                                            @if($user->name !== 'Fila de Espera')
                                            <a href="{{ route('users.show', $user->id) }}"
                                               class="d-flex align-items-center w-auto h-100">
                                               {{ $user ? $user->name : 'N.A.'}}
                                            </a>
                                            @else
                                            {{ $user ? $user->name : 'N.A.'}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="mobileHidden">{{ $ticket->ticketCategory->description }}</td>
                                    <td class="ticket-status-{{ $ticket->ticketStatus->id }}">{{ $ticket->ticketStatus->description ? $ticket->ticketStatus->description : 'N.A.' }}</td>
                                    <td class="mobileHidden">{{ $ticket->created_at ? $ticket->created_at->format('d-m-Y') : 'N.A.' }}</td>
                                    <td class="mobileHidden">{{ $ticket->dueByDate ? \Carbon\Carbon::parse($ticket->dueByDate)->format('d-m-Y') : 'N.A.' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="width: 40%">
                                                <a href="{{ route('tickets.edit', $ticket->id) }}">
                                                    <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                                                </a>
                                            </div>
                                            <div style="width: 40%">
                                                <form method="post" action="{{ route('tickets.destroy', $ticket->id) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="modalBtn"
                                                            data-message="Tem certeza que deseja apagar o ticket {{$ticket->title}}?"
                                                            style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                            <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="filler" style="background-color: #f8fafc"></tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                    {{ $tickets->appends(['tPage' => $tickets->currentPage()])->links() }}
                </div>
                <div class="tab-pane fade" id="fila_de_espera" role="tabpanel" aria-labelledby="waiting-queue-tab">
                    <div class="d-flex justify-content-between my-3">

                        <form action="{{ route('tickets.index') }}" method="get" id="filaSearchForm">
                            <div class="input-group pr-2">
                                <div class="search-container">
                                    <input type="text" class="form-control" id="filaSearch" name="filaSearch"
                                           value="{{ request('filaSearch') }}"
                                           placeholder="{{ request('filaSearch') ? request('filaSearch') : 'Pesquisar ticket...' }}">
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        Procurar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="buttons">
                            <form id="filterFilaCategoryForm" action="{{ route('tickets.index') }}" method="GET">
                                <select class="form-control w-auto" id="filterFilaCategory" name="filterFilaCategory"
                                        onchange="submitFilaCategoryForm()">
                                    <option value="" {{ $filterFilaCategory === '' ? 'selected' : '' }}>
                                        Todas as categorias
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (int) $filterFilaCategory === $category->id ? 'selected' : '' }}>{{ $category->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <form id="filterCategoryFilaForm" action="{{ route('tickets.index') }}" method="GET">
                                <select class="form-control w-auto" id="filterFilaPriority" name="filterFilaPriority"
                                        onchange="submitCategoryFilaForm()">
                                    <option value="" {{ $filterFilaPriority === '' ? 'selected' : '' }}>
                                        Todas as prioridades
                                    </option>
                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}"
                                            {{ (int) $filterFilaPriority === $priority->id ? 'selected' : '' }}>
                                            {{ $priority->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    @if (count($waitingQueueTickets) === 0)
                        <div>
                            <img src="{{ asset('assets/noTickets.png') }}" class="noTicket">

                        </div>
                    @else
                        <table class="table bg-white rounded-top">
                            <thead>
                            <tr>
                                <th scope="col">Número</th>
                                <th scope="col">Título</th>
                                <th scope="col" class="mobileHidden">Utilizador</th>
                                <th scope="col" class="mobileHidden">Técnico</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="mobileHidden">Data de Abertura</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="filler"></tr>
                            @foreach ($waitingQueueTickets as $ticket)
                                <tr class="customTableStyling {{ $ticket->ticketPriority->id == 5 ? 'critical' : '' }}">
                                    <td class="pl-4">#{{ $ticket->id }}</td>
                                    <td class="clickable">
                                        <div class="d-flex align-items-center">
                                            <span
                                                class="mr-2 ticket-prio ticket-priority-{{ $ticket->ticketPriority->id }}"></span>
                                            <a href="{{ route('tickets.show', $ticket->id) }}"
                                               class="d-flex align-items-center w-auto h-100">{{ $ticket->title ? $ticket->title : 'N.A.' }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="clickable mobileHidden">
                                        @showIfNotDeleted($ticket)
                                            @if($ticket->requester->name !== 'Utilizador Padrao')
                                                <a href="{{ route('users.show', $ticket->user_id) }}"
                                                class="d-flex align-items-center w-auto h-100">
                                                {{ $ticket->requester ? $ticket->requester->name : 'N.A.' }}
                                            </a>
                                            @else
                                            {{ $ticket->requester ? $ticket->requester->name : 'N.A.' }}
                                            @endif
                                        @endshowIfNotDeleted
                                    </td>
                                    <td class="clickable mobileHidden">
                                        @foreach ($ticket->users as $user)
                                            @if($user->name !== 'Fila de Espera')
                                            <a href="{{ route('users.show', $user->id) }}"
                                               class="d-flex align-items-center w-auto h-100">
                                               {{ $user ? $user->name : 'N.A.'}}
                                            </a>
                                            @else
                                            {{ $user ? $user->name : 'N.A.'}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="ticket-status-{{ $ticket->ticketStatus->id }}">{{ $ticket->ticketStatus->description }}</td>
                                    <td class="mobileHidden">{{ $ticket->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="w-50">
                                                <a href="{{ route('tickets.edit', $ticket->id) }}">
                                                    <i class="fa-solid fa-pen-to-square fa-lg" style="color: #116fdc;"></i>
                                                </a>
                                            </div>
                                            <div class="w-50">
                                                <form method="post" action="{{ route('tickets.destroy', $ticket->id) }}"
                                                      style="display:inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="modalBtn"
                                                            data-message="Tem certeza que deseja apagar o ticket {{$ticket->title}}?"
                                                            style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                                            <i class="fa-solid fa-trash-can fa-lg" style="color: #116fdc;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="filler"></tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                    {{ $waitingQueueTickets->appends(['wPage' => $waitingQueueTickets->currentPage()])->links() }}
                </div>
                <div class="tab-pane fade" id="reciclagem_tickets" role="tabpanel" aria-labelledby="recycling-tab">
                    <div class="d-flex justify-content-between my-3">

                        <form action="{{ route('tickets.index') }}" method="get" id="recyclingSearchForm">
                            <div class="input-group pr-2">
                                <div class="search-container">
                                    <input type="text" class="form-control" id="recyclingSearch" name="recyclingSearch"
                                           value="{{ request('recyclingSearch') }}"
                                           placeholder="{{ request('recyclingSearch') ? request('recyclingSearch') : 'Pesquisar ticket...' }}">
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        Procurar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="buttons">
                            <form id="filterRecyclingCategoryForm" action="{{ route('tickets.index') }}" method="GET">
                                <select class="form-control w-auto" id="filterRecyclingCategory"
                                        name="filterRecyclingCategory"
                                        onchange="submitRecyclingCategoryForm()">
                                    <option value="" {{ $filterRecyclingCategory === '' ? 'selected' : '' }}>
                                        Todas as categorias
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (int) $filterRecyclingCategory === $category->id ? 'selected' : '' }}>{{ $category->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <form id="filterRecyclingStatusForm" action="{{ route('tickets.index') }}" method="GET">
                                <select class="form-control w-auto" id="filterRecyclingStatus"
                                        name="filterRecyclingStatus"
                                        onchange="submitRecyclingStatusForm()">
                                    <option value="" {{ $filterRecyclingStatus === '' ? 'selected' : '' }}>Todos os
                                        estados
                                    </option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ (int) $filterRecyclingStatus === $status->id ? 'selected' : '' }}>{{ $status->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <form id="filterRecyclingPriorityForm" action="{{ route('tickets.index') }}" method="GET">
                                <select class="form-control w-auto" id="filterRecyclingPriority"
                                        name="filterRecyclingPriority"
                                        onchange="submitRecyclingPriorityForm()">
                                    <option value="" {{ $filterRecyclingPriority === '' ? 'selected' : '' }}>
                                        Todas as prioridades
                                    </option>
                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}"
                                            {{ (int) $filterRecyclingPriority === $priority->id ? 'selected' : '' }}>
                                            {{ $priority->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    @if($recycledTickets->isEmpty())
                        <img src="{{ asset('assets/reciclagem_azul_extra_bold_2_sem fundo.png') }}"
                             alt="Não existem registos" class="bin">
                    @else
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Número</th>
                                <th scope="col">Título</th>
                                <th scope="col" class="mobileHidden">Utilizador</th>
                                <th scope="col" class="mobileHidden">Técnico</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="mobileHidden">Data de Abertura</th>
                                <th scope="col">
                                    <div class="centerTd">Restaurar</div>
                                </th>
                                <th scope="col">
                                    <div class="centerTd">Apagar</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($recycledTickets as $ticket)
                                <tr class="customTableStyling {{ $ticket->ticketPriority->id == 5 ? 'critical' : '' }}">
                                    <td class="pl-4">#{{ $ticket->id }}</td>
                                    <td class="d-flex align-items-center clickable">
                                        <span
                                            class="mr-2 ticket-prio ticket-priority-{{ $ticket->ticketPriority->id }}">
                                        </span>
                                        @showIfNotDeleted($ticket)
                                        <a href="{{ route('tickets.show', $ticket->id) }}"
                                           class="d-flex align-items-center w-auto h-100">{{ $ticket->title ? $ticket->title : 'N.A.' }}</a>
                                        @else
                                        <span
                                            class="d-flex align-items-center w-auto h-100">{{ $ticket->title ? $ticket->title : 'N.A.' }}
                                        </span>
                                        @endshowIfNotDeleted
                                    </td>
                                    <td class="clickable mobileHidden">
                                        {{ $ticket->requester ? $ticket->requester->name : 'N.A.' }}
                                    </td>
                                    <td class="clickable mobileHidden">
                                        @foreach ($ticket->users as $user)
                                            @if($user->name !== 'Fila de Espera')
                                            <a href="{{ route('users.show', $user->id) }}"
                                               class="d-flex align-items-center w-auto h-100">
                                               {{ $user ? $user->name : 'N.A.'}}
                                            </a>
                                            @else
                                            {{ $user ? $user->name : 'N.A.'}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="ticket-status-{{ $ticket->ticketStatus->id }}">{{ $ticket->ticketStatus->description }}</td>
                                    <td class="mobileHidden">{{ $ticket->created_at->format('d-m-Y') }}</td>
                                    <td>

                                        <div class="centerTd">
                                            <form method="POST" action="{{ route('tickets.restore', $ticket->id) }}">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="modalBtn"
                                                        style="border: none; background: none; padding: 0;"
                                                        data-message="Tem certeza que deseja restaurar o ticket {{$ticket->title}}?">
                                                    <img src="{{ asset('assets/restore.svg') }}">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="centerTd">
                                            <form action="{{ route('tickets.forceDelete', $ticket->id) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="modalBtn"
                                                        data-message="Tem certeza que deseja apagar permanentemente o ticket {{$ticket->title}}?"
                                                        style="border: none; background: none; padding: 0;">
                                                    <img src="{{ asset('assets/permaDelete.svg') }}" alt="Delete">
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
                    {{ $recycledTickets->appends(['rPage' => $recycledTickets->currentPage()])->links() }}
                </div>
            </div>
        </div>
    </div>
    {{--    confirmation modal    --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="deleteBtn">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    {{--    confirmation modal    --}}

    @component('tickets.quickTicket', ['priorities' => $priorities, 'categories' => $categories])
    @endcomponent
@endsection
@push('scripts')
<script src="{{ asset('js/tickets/index.js') }}"></script>
<script src="{{ asset('js/intro.js') }}"></script>
@endpush

