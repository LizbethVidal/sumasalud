@component('mail::message')

# Cita actualizada

@if($cita->estado == 'ATENDIDA')
Se ha finalizado la cita del paciente {{ $cita->paciente->name}}.
@elseif($cita->estado == 'CANCELADA')
Se ha cancelado la cita del paciente {{ $cita->paciente->name}}.
@endif


@component('mail::panel')
**Fecha:** {{ $cita->fecha_hora }}<br>
**Doctor:** {{ $cita->doctor->name }} - {{ $cita->doctor->especialidad->nombre }}<br>
@endcomponent

@component('mail::panel')
    @if($cita->estado == 'ATENDIDA')
        Gracias por confiar en nosotros.
    @elseif($cita->estado == 'CANCELADA')
        Si desea puede solicitar una nueva cita.
    @endif
@endcomponent


Gracias,<br>
{{ config('app.name') }}

@endcomponent
