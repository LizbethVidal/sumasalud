@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h1 class="text-center">Medicos de {{$user->name}}</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Nueva asignación</h5>
                <div class="card-body d-flex gap-3 flex-column">
                    <form action="{{route('pacientes.asignar_medico', $user->id)}}" method="POST">
                        <input type="hidden" name="paciente_id" value="{{$user->id}}">
                        @csrf
                        <div class="form-group">
                            <label for="especialidad">Especialidad</label>
                            <select class="form-control" id="especialidad">
                                <option value="">Seleccione una especialidad</option>
                                @foreach($especialidades as $especialidad)
                                    <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="doctor_id">Médico</label>
                            <select class="form-control" id="doctor_id" name="doctor_id">
                                <option value="">Seleccione un médico</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-primary btn-block" type="submit">Asignar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                @foreach($medicos as $medico)
                    <div class="col-md-4 mb-2">
                        <div class="card">
                            <h5 class="card-header">{{$medico->especialidad->nombre}}</h5>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p> {{$medico->name}}</p>
                                    </div>
                                    <div>
                                        <form action="{{route('pacientes.desasignar_medico', ['paciente' => $user->id, 'doctor' => $medico->id])}}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit">Desasignar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


</div>

<script type="module">
    $(document).ready(function(){
        $('#especialidad').change(function(){
            var especialidad_id = $(this).val();
            $.ajax({
                url: "{{route('medicos.get_medicos')}}",
                type: 'GET',
                data: {especialidad_id: especialidad_id},
                success: function(response){
                    var medicos = response.medicos;
                    var html = '';
                    medicos.forEach(medico => {
                        html += `<option value="${medico.id}">${medico.name}</option>`;
                    });
                    $('#doctor_id').html(html);
                }
            });
        });
    });
</script>
@endsection
