<!DOCTYPE html>
<html>
<head>
    <title>Demande de Mentorat</title>
</head>
<body>
    <h1>Nouvelle demande de mentorat</h1>
    <p>Bonjour {{ $mentor->name ?? 'Cher mentor' }},</p>
    <p>{{ $mentee->name ?? 'Un utilisateur' }} vous a demandé d'être son mentor.</p>
    
</body>
</html>
