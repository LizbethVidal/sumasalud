@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <h1 class="text-center">Crear Cita</h1>
                <hr>
            </div>

            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('citas.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="paciente_id">Paciente</label>
                                    <input type="text" name="nombre_paciente" id="nombre_paciente" class="form-control" value="{{$paciente->name}}" readonly>
                                    <input type="hidden" name="paciente_id" id="paciente_id" class="form-control @if($errors->has('paciente_id')) is-invalid @endif" required value="{{$paciente->id}}">
                                </div>
                                <div class="col-6">
                                    <label for="medico">Médico</label>
                                    <select name="medico" id="medico" class="form-control @if($errors->has('medico')) is-invalid @endif" required>
                                        <option value="">Seleccione un médico</option>
                                        @foreach($medicos as $medico)
                                            <option value="{{$medico->id}}">{{$medico->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('medico'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('medico')}}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <label for="fecha_hora">Fecha y hora</label>
                                    <input type="text" name="fecha_hora" id="fecha_hora" class="form-control @if($errors->has('fecha_hora')) is-invalid @endif" required value="{{old('fecha_hora')}}">
                                    @if($errors->has('fecha_hora'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('fecha_hora')}}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="motivo">Motivo</label>
                                    <textarea name="motivo" id="motivo" class="form-control @if($errors->has('motivo')) is-invalid @endif" required>{{old('motivo')}}</textarea>
                                    @if($errors->has('motivo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('motivo')}}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Crear Cita</button>
                                    <a href="{{ route('citas.index') }}" class="btn btn-secondary">Volver</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        $(document).ready(function(){

            $('#medico').select2({
                theme: 'bootstrap-5'
            });

            flatpickr('#fecha_hora',{
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                disable: [
                    function(date) {
                        // Disable weekends
                        return (date.getDay() === 0 || date.getDay() === 6);
                    }
                ],
                time_24hr: true,
                minTime: "08:00",
                maxTime: "19:00",
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                        longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    },
                }
            });

        });
    </script>
@endsection
