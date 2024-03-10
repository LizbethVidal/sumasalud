@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <h5 class="card-header">Calendario del médico {{$user->name}}</h5>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new Calendar(calendarEl, {
                plugins: [listPlugin, bootstrap5Plugin, dayGridPlugin],
                initialView: 'dayGridMonth',
                locale: 'es',
                eventDisplay: 'block',
                businessHours: true,
                firstDay: 1, // Start the calendar on Monday (0 for Sunday, 1 for Monday, and so on)
                events: [
                    @foreach($citas as $cita)
                    {
                        title: '{{$cita->paciente->name}}',
                        start: '{{$cita->fecha_hora}}',
                        description: '{{$cita->observaciones}}',
                        backgroundColor: '{{$cita->estado == 'CONFIRMADA' ? '#28a745' : '#ffc107'}}'
                    },
                    @endforeach
                ],
            });
            calendar.render();
        });
    </script>
@endsection

