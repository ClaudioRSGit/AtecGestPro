@extends('master.main')

@section('content')
    <div>
        <h1>Historico de Ticket: {{ $ticket->id }}</h1>

        <div>
            @foreach($ticketHistories as $history)

                <h5>{{$history->action->description}} - {{$history->created_at}}</h5>

                <p>{!! nl2br(str_replace('.', ".\n", e($history->ticket_info))) !!}</p>
            @endforeach
        </div>
    </div>
@endsection
