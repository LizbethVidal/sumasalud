@component('mail::message')

# Hola {{ $user->name }},
## Tu cuenta ha sido creada con éxito.
### Tu usuario es: {{ $user->email }}

Gracias,<br>
{{ config('app.name') }}
@endcomponent
ª
