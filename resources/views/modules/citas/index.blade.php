@extends('layouts.app')

@section('content')
<div class="px-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ __('Citas') }}
                    </div>
                    <div>
                        <a href="{{route('citas.busqueda')}}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Crear Cita
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('citas.index')}}" method="GET">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{$request->name}}">
                            </div>
                            <div class="col-md-2">
                                <label for="dni">DNI</label>
                                <input type="text" name="dni" id="dni" class="form-control" value="{{$request->dni}}">
                            </div>
                            <div class="col-md-2">
                                <label for="movil">Teléfono</label>
                                <input type="text" name="movil" id="movil" class="form-control"
                                    value="{{$request->movil}}">
                            </div>
                            <div class="col-md-2">
                                <label for="email">Correo</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{$request->email}}">
                            </div>
                            <div class="col-md-2">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control"
                                    value="{{$request->fecha}}">
                            </div>
                            <div class="col d-flex flex-column justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

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
                                        <span class="badge bg-warning text-dark">Pendiente cita por videollamada</span>
                                    </td>
                                    @else
                                    <td>{{$cita->fechaCita()}}</td>
                                    @endif
                                    <td>
                                        {{-- <select name="estado" @if($cita->estado == 'ATENDIDA' || $cita->estado ==
                                            'CANCELADA') disabled @endif id="estado" class="form-control"
                                            onchange="cambiarEstado({{$cita->id}}, this.value)">
                                            @if($cita->estado != 'ESPERA')
                                                <option value="CONFIRMADA"
                                                    {{$cita->estado == 'CONFIRMADA' ? 'selected' : ''}}>Confirmada</option>
                                            @endif
                                            <option value="ATENDIDA" {{$cita->estado == 'ATENDIDA' ? 'selected' : ''}}>
                                                Atendida</option>
                                            <option value="CANCELADA"
                                                {{$cita->estado == 'CANCELADA' ? 'selected' : ''}}>Cancelada</option>
                                            @if($cita->estado == 'ESPERA')
                                                <option value="ESPERA" selected>En espera</option>
                                            @endif
                                        </select> --}}
                                        <div class="d-flex flex-column">
                                            @switch($cita->estado)
                                                @case('ATENDIDA')
                                                    <button type="button" class="btn btn-warning">Atendida</span>
                                                    @break
                                                @case('CANCELADA')
                                                    <button type="button" class="btn btn-danger">Cancelada</span>
                                                    @break
                                                @case('CONFIRMADA')
                                                    <button type="button" class="btn btn-info" onclick="cambiarEstado({{$cita->id}})">Confirmada</span>
                                                    @break
                                                @case('ESPERA')
                                                    <button type="button" class="btn btn-success" onclick="cambiarEstado({{$cita->id}})">En espera</span>
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
                                        @if($cita->estado != 'ATENDIDA' && $cita->estado != 'CANCELADA')
                                        <a href="{{route('citas.edit', $cita->id)}}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{route('citas.destroy', $cita->id)}}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex d-md-block justify-content-center">
                        {{$citas->links()}}
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{route('home')}}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function cambiarEstado(id, estado = false) {
        Swal.fire({
            title: '¿Como desea finalizar la cita?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Atender cita',
            cancelButtonText: 'Cancelar cita',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/citas/' + id,
                    method: 'POST',
                    data: {
                        _token: "{{csrf_token()}}",
                        _method: 'PUT',
                        estado: 'ATENDIDA'
                    },
                    success: function (response) {
                        Swal.fire(
                            'Cambiado!',
                            'El estado de la cita ha sido cambiado.',
                            'success'
                        )

                        setTimeout(() => {
                            location.reload()
                        }, 1000)
                    },
                    error: function (error) {
                        Swal.fire(
                            'Error!',
                            'Ha ocurrido un error.',
                            'error'
                        )
                    }
                })
            }else if(result.dismiss === Swal.DismissReason.cancel){
                $.ajax({
                    url: '/citas/' + id,
                    method: 'POST',
                    data: {
                        _token: "{{csrf_token()}}",
                        _method: 'PUT',
                        estado: 'CANCELADA'
                    },
                    success: function (response) {
                        Swal.fire(
                            'Cambiado!',
                            'El estado de la cita ha sido cambiado.',
                            'success'
                        )

                        setTimeout(() => {
                            location.reload()
                        }, 1000)
                    },
                    error: function (error) {
                        Swal.fire(
                            'Error!',
                            'Ha ocurrido un error.',
                            'error'
                        )
                    }
                })
            }
        })
    }

</script>
@endsection
