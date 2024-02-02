<!DOCTYPE html>
<html>
<head>
    <title>Atec Gest Pro</title>
</head>
<body>
    <h1>Olá {{ $ticket->requester->name }},</h1>
    <p>O ticket #{{$ticket->id}}, com o título {{ $ticket->title }} foi criado com sucesso.</p>

    <p>Pode consultar o seu ticket em localhost:8000/tickets/{{$ticket->id}}</p>
    <br><p>Atenciosamente</p>
    <p>Equipa Técnica</p>
</body>
</html>
