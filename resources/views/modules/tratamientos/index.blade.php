@extends('layouts.app')

@section('content')

<div class="px-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('Listado de tratamientos') }}
                </div>

                <div class="card-body">
                    <form action="{{route('tratamientos.index')}}" method="GET">
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tratamientos as $tratamiento)
                                <tr>
                                    <td>{{$tratamiento->id}}</td>
                                    <td>{{$tratamiento->nombre}}</td>
                                    <td>
                                        <a href="{{route('tratamientos.show', $tratamiento->id)}}" class="btn btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{route('tratamientos.edit', $tratamiento->id)}}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger" onclick="confirmar_delete({{$tratamiento->id}})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    function tratamiento_eliminar(id) {
        $.ajax({
            url: '/tratamientos/' + id,
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
                tratamiento_eliminar(id);
                Swal.fire(
                    'Eliminada!',
                    'La tratamiento ha sido eliminada.',
                    'success'
                ).then(() => {
                    location.reload();
                })
            }
        })
    }

</script>
@endsection
