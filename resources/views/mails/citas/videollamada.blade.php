@component('mail::message')

# Hola {{ $cita->paciente->name }},

## Tu cita con tu médico {{$cita->doctor->name}} ha sido agendada para dentro de 1 hora.

### La cita será por videollamada, para acceder a la videollamada, haz clic en el siguiente botón:

@component('mail::button', ['url' => $cita->enlace])
Acceder a la videollamada
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
