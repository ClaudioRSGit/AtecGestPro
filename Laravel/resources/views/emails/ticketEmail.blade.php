<!DOCTYPE html>
<html>
<head>
    <title>Mail from Laravel</title>
</head>
<body>
    <h1>Olá {{ $ticket->requester->name }},</h1>
    <p>O ticket #{{$ticket->id}}, com o título {{ $ticket->title }} foi criado com sucesso.</p>
    <p>Descrição</p>
    <p>{{ $ticket->description }}</p>

    <p>Pode consultar o seu ticket na App Atec Gest Pro</p>
    <p>Atenciosamente</p>
    <p>Equipa Atec Gest Pro</p>
</body>
</html>
