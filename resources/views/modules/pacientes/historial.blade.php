@if(!$agent->isMobile())
<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Médico</th>
            <th>Fecha y hora</th>
            <th>Fecha de fin</th>
            <th>Tratamiento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($consultas as $consulta)
            <tr>
                <td>{{$consulta->id}}</td>
                <td>{{$consulta->paciente->name}}</td>
                <td>{{$consulta->doctor->name}}</td>
                <td>{{$consulta->cita->fecha_hora}}</td>
                <td>{{$consulta->updated_at}}</td>
                <td>{{$consulta->tratamiento?->nombre ?? 'Sin tratamiento'}}</td>
                <td>
                    <a href="{{route('consultas.show', $consulta->id)}}" class="btn btn-primary">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
@foreach($consultas as $consulta)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title"><strong>Consulta #</strong>{{$consulta->id}}</h5>
            <p class="card-text"><strong>Paciente: </strong>{{$consulta->paciente->name}}</p>
            <p class="card-text"><strong>Médico: </strong>{{$consulta->doctor->name}}</p>
            <p class="card-text"><strong>Fecha y hora: </strong>{{$consulta->cita->fecha_hora}}</p>
            <p class="card-text"><strong>Fecha de fin: </strong>{{$consulta->updated_at}}</p>
            <p class="card-text"><strong>Tratamiento: </strong>{{$consulta->tratamiento?->nombre ?? 'Sin tratamiento'}}</p>
        </div>
        <div class="card-footer d-flex justify-content-start gap-3">
            <a href="{{route('consultas.show', $consulta->id)}}" class="btn btn-primary">
                <i class="bi bi-eye"></i>
            </a>
        </div>
    </div>
@endforeach
@endif

