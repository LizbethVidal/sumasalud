@extends('layouts.app')

@section('content')
    <div class="px-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            {{ __('Listado de empleados') }}
                        </div>
                        <div class="d-flex gap-3">
                            <a href="{{route('users.create')}}" class="btn btn-success">
                                <i class="bi bi-plus"></i> Nuevo Empleado
                            </a>
                            <a href="{{route('medicos.create')}}" class="btn btn-outline-light">
                                <i class="bi bi-plus"></i> Nuevo Médico
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{route('empleados.index')}}" method="GET">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$request->name}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="dni">DNI</label>
                                    <input type="text" name="dni" id="dni" class="form-control" value="{{$request->dni}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="rol">Rol</label>
                                    <select name="rol" id="rol" class="form-select">
                                        <option value="">Todos</option>
                                        <option value="medico" @if($request->rol == 'medico') selected @endif>Médico</option>
                                        <option value="admin" @if($request->rol == 'admin') selected @endif>Administrativo</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="movil">Teléfono</label>
                                    <input type="text" name="movil" id="movil" class="form-control" value="{{$request->movil}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="email">Correo</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{$request->email}}">
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
                        @if(!$agent->isMobile())
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>ROL</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($empleados as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->dni}}</td>
                                            <td>{{$user->movil}}</td>
                                            <td>{{$user->rol}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if($user->rol == 'medico')
                                                <a href="{{route('medicos.show', $user->id)}}" class="btn btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @else
                                                <a href="{{route('empleados.show', $user->id)}}" class="btn btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @endif
                                                @if($user->rol == 'medico')
                                                <a href="{{route('medicos.edit', $user->id)}}" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="{{route('medicos.calendario', $user->id)}}" class="btn btn-info">
                                                    <i class="bi bi-calendar"></i>
                                                </a>
                                                @else
                                                <a href="{{route('empleados.edit', $user->id)}}" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @endif
                                                <button type="button" class="btn btn-danger" onclick="confirmar_delete({{$user->id}})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            @foreach($empleados as $user)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="d-flex justify-content-center img-thumbnail" style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                                                    <img src="{{ $user->foto ? asset('storage/' . $user->foto) : '/images/default.png' }}" alt="Foto de Perfil" class="" style="object-fit: cover; width: 100%; height: 100%;">
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <h5 class="card-title">{{$user->name}}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">{{$user->rol}}</h6>
                                                <p class="card-text">{{$user->email}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex gap-3">
                                            @if($user->rol == 'medico')
                                                <div>
                                                    <a href="{{route('medicos.show', $user->id)}}" class="btn btn-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div>
                                                    <a href="{{route('empleados.show', $user->id)}}" class="btn btn-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </div>

                                            @endif
                                            @if($user->rol == 'medico')
                                                <div>
                                                    <a href="{{route('medicos.edit', $user->id)}}" class="btn btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{route('medicos.calendario', $user->id)}}" class="btn btn-info">
                                                        <i class="bi bi-calendar"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div>
                                                    <a href="{{route('empleados.edit', $user->id)}}" class="btn btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            <div>
                                                <button type="button" class="btn btn-danger" onclick="confirmar_delete({{$user->id}})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="d-flex justify-content-center">
                            {{$empleados->links()}}
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
        function delete_user(id) {
            $.ajax({
                url: '/empleados/' + id,
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
                    delete_user(id);
                    Swal.fire(
                        'Eliminado!',
                        'El usuario ha sido eliminado.',
                        'success'
                    ).then(() => {
                        location.reload();
                    })
                }
            })
        }

    </script>
@endsection
