<!DOCTYPE html>
<html>
<head>
    <title>Demande de Mentorat</title>
</head>
<body>
    <h1>Demande de Mentorat</h1>
    <p>Vous avez une nouvelle demande de mentorat :</p>
    
    @if (isset($sessionDetails['mentor']['name']))
        <p><strong>Nom:</strong> {{ $sessionDetails['mentor']['name'] }}</p>
    @else
        <p><strong>Nom:</strong> Non spécifié</p>
    @endif

    @if (isset($sessionDetails['mentor']['email']))
        <p><strong>Email:</strong> {{ $sessionDetails['mentor']['email'] }}</p>
    @else
        <p><strong>Email:</strong> Non spécifié</p>
    @endif
    
    <p><strong>Date de la session:</strong> {{ $sessionDetails['date'] }}</p>
</body>
</html>
