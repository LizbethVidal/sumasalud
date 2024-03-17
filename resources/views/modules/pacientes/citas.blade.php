@if(!$agent->isMobile())
<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Fecha y hora</th>
                <th scope="col">Estado</th>
                <th scope="col">Paciente</th>
                <th scope="col">Médico</th>
                <th scope="col">Motivo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
                @if($cita->estado == 'ESPERA')
                    <tr class="table-success">
                @elseif($cita->estado == 'ATENDIDA')
                    <tr class="table-warning">
                @elseif($cita->estado == 'CANCELADA')
                    <tr class="table-danger">
                @else
                    <tr class="table-info">
                @endif
                @if($cita->estado == 'ESPERA')
                <td>
                    @if(empty($cita->enlace))
                        <span class="badge bg-warning text-dark">Pendiente cita por videollamada</span>
                    @else
                        <a href="{{$cita->enlace}}" class="badge bg-success" target="_blank">
                            <i class="bi bi-camera-video"></i> Acceder a la videollamada
                        </a>
                    @endif
                </td>
                @else
                <td>{{$cita->fechaCita()}}</td>
                @endif
                <td>
                    <div class="d-flex flex-column">
                        @switch($cita->estado)
                            @case('ATENDIDA')
                                <button type="button" class="btn btn-warning">Atendida</span>
                                @break
                            @case('CANCELADA')
                                <button type="button" class="btn btn-danger">Cancelada</span>
                                @break
                            @case('CONFIRMADA')
                                <button type="button" class="btn btn-info">Confirmada</span>
                                @break
                            @case('ESPERA')
                                <button type="button" class="btn btn-success">En espera</span>
                                @break
                        @endswitch
                    </div>
                </td>
                <td>{{$cita->paciente->name}}</td>
                <td>{{$cita->doctor->name}}</td>
                <td>{{$cita->motivo}}</td>
                <td>
                    <a href="{{route('citas.show', $cita->id)}}" class="btn btn-primary">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
@foreach($citas as $cita)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title"><strong>Cita #</strong>{{$cita->id}}</h5>
            <p class="card-text"><strong>Fecha y hora: </strong>{{$cita->fechaCita()}}</p>
            <p class="card-text"><strong>Paciente: </strong>{{$cita->paciente->name}}</p>
            <p class="card-text"><strong>Médico: </strong>{{$cita->doctor->name}}</p>
            <p class="card-text"><strong>Motivo: </strong>{{$cita->motivo}}</p>

            <div class="d-flex flex-column mb-2">
                @switch($cita->estado)
                    @case('ATENDIDA')
                        <button type="button" class="btn btn-warning">Atendida</span>
                        @break
                    @case('CANCELADA')
                        <button type="button" class="btn btn-danger">Cancelada</span>
                        @break
                    @case('CONFIRMADA')
                        <button type="button" class="btn btn-info">Confirmada</span>
                        @break
                    @case('ESPERA')
                        <button type="button" class="btn btn-success">En espera</span>
                        @break
                @endswitch
            </div>
        </div>
        <div class="card-footer d-flex justify-content-start gap-3">
            <a href="{{route('citas.show', $cita->id)}}" class="btn btn-primary">
                <i class="bi bi-eye"></i>
            </a>
        </div>
    </div>
@endforeach
@endif
