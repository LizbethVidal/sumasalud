@component('mail::message')
# Nueva cita

Se ha creado una nueva cita para el paciente {{ $cita->paciente->name}}.

@component('mail::panel')
    @if($cita->estado == 'ESPERA')
        **Estado:** Pendiente de disponibilidad del médico <br>
    @else
        **Estado:** Confirmada </br>
        **Fecha:** {{ $cita->fecha_hora }}<br>
    @endif
    **Doctor:** {{ $cita->doctor->name }} - {{ $cita->doctor->especialidad->nombre }}<br>
@endcomponent

@component('mail::panel')
    @if($cita->estado == 'ESPERA')
        Desde la administración se le notificará cuando la cita sea confirmada y en caso de ser online se le enviará el enlace para la videollamada.
    @else
        Recuerde que si no puede asistir a la cita, debe cancelarla con al menos 24 horas de antelación.
    @endif
@endcomponent

@component('mail::button', ['url' => route('citas.show', $cita->id)])

Ver cita

@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
