<!DOCTYPE html>
<html>
<head>
    <title>Nueva Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Nueva Cita</h1>

    <p>Estimado(a) {{ $cita->paciente->name }},</p>

    <p>Se ha programado una nueva cita para usted. Aquí están los detalles:</p>

    <ul>
        <li>Fecha: {{ $cita->fecha_hora }}</li>
        <li>Médico: {{ $cita->doctor->name }}</li>
        <li>Especialidad: {{ $cita->doctor->especialidad->nombre }}</li>
        <li>Motivo: {{ $cita->motivo }}</li>

    </ul>

    <p>Si necesita cambiar la cita, por favor contáctenos lo antes posible.</p>

    <p>Gracias,</p>
    <p>El equipo de Suma Salud</p>
</body>
</html>
