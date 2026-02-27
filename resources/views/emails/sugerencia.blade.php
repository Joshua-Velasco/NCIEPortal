<!DOCTYPE html>
<html>
<head>
    <title>Sugerencia Recibida</title>
</head>
<body>
    <h2>Nueva sugerencia recibida</h2>
    
    <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
    <p><strong>Correo:</strong> {{ $data['email'] }}</p>
    <p><strong>Motivo:</strong> {{ $data['subject'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $data['message'] }}</p>
    
    <p>Fecha: {{ now()->format('d/m/Y H:i') }}</p>
</body>
</html>