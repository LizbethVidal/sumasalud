@extends('layouts.app')

@section('content')

<div class="px-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('Listado de especialidades') }}
                </div>

                <div class="card-body">
                    <form action="{{route('especialidades.index')}}" method="GET">
                        @csrf
                        <div class="row mb-2">
                            <div class="col">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$request->nombre}}">
                            </div>
                            <div class="col d-flex flex-column justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success" >
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                @if(Auth::user()->hasRole('admin'))
                                    <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($especialidades as $especialidad)
                                <tr>
                                    <td>{{$especialidad->id}}</td>
                                    <td>{{$especialidad->nombre}}</td>
                                    @if(Auth::user()->hasRole('admin'))
                                        <td>
                                            <a href="{{route('especialidades.edit', $especialidad->id)}}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger" onclick="confirmar_delete({{$especialidad->id}})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" title="Ver mas"  data-bs-toggle="collapse" href="#more-info-{{$especialidad->id}}" role="button" aria-expanded="false" aria-controls="more-info-{{$especialidad->id}}">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                                <tr class="collapse" id="more-info-{{$especialidad->id}}">
                                    <td colspan="3">
                                        @if($especialidad->doctores->count() > 0)
                                            <h5>Doctores</h5>
                                            <table class="table table-striped">
                                                <thead class="table-dark">
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($especialidad->doctores as $medico)
                                                        <tr>
                                                            <td>{{$medico->id}}</td>
                                                            <td>{{$medico->name}}</td>
                                                            <td>
                                                                <a href="{{route('medicos.show', $medico->id)}}" class="btn btn-outline-secondary">
                                                                    <i class="bi bi-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <h5>No hay doctores asignados</h5>
                                        @endif
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$especialidades->links()}}
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
    function especialidad_eliminar(id) {
        $.ajax({
            url: '/especialidades/' + id,
            type: 'DELETE',
            data: {
                _token: $('input[name=_token]').val()
            },
            success: function(result) {

            }
        });
    }

    function confirmar_delete(id){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                especialidad_eliminar(id);
                Swal.fire(
                    'Eliminada!',
                    'La especialidad ha sido eliminada.',
                    'success'
                ).then(() => {
                    location.reload();
                })
            }
        })
    }

</script>
@endsection
