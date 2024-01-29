@extends('master.main')

@section('content')
    <div>

        <h1>Historico de Tickets</h1>
        <div>


            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Utilizador</th>
                </tr>
                </thead>

                <tbody>
                @foreach($tickets as $ticket)
                    <tr style="cursor: pointer;" onclick="window.location='{{ route('ticket-histories.show', $ticket->id) }}';">
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->requester->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
@endsection
