@extends('master.main')
@section('title', 'Historico do Ticket' )
@section('content')
    <div>
        <h1>Ticket: {{ $ticket->id }}</h1>

        <div>
            @foreach($ticketHistories as $history)

                <h5>{{$history->action->description}} - {{$history->created_at}}</h5>

                <p>{!! nl2br(str_replace('.', ".\n", e($history->ticket_info))) !!}</p>
            @endforeach
        </div>
    </div>
@endsection
