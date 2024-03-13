@extends('layouts.app')

@section('content')
    <div class="px-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            {{ __('Listado de pacientes') }}
                        </div>
                        <div>
                            <a href="{{route('pacientes.create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus-fill"></i> Crear Paciente
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{route('pacientes.index')}}" method="GET">
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
                                    <label for="movil">Teléfono</label>
                                    <input type="text" name="movil" id="movil" class="form-control" value="{{$request->movil}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="email">Correo</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{$request->email}}">
                                </div>

                                <div class="col d-flex flex-column justify-content-end mt-3 mt-md-0">
                                    <div>
                                        <button type="submit" class="btn btn-success" >
                                            Buscar
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        @if($agent->isMobile())
                            <div class="row">
                                @foreach($pacientes as $user)
                                    <div class="col-12">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('storage/users/default.png') }}" alt="Foto de Perfil" class="img-thumbnail" style="max-width: 100px;">
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h5 class="card-title">{{$user->name}}</h5>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="card-text">{{$user->dni}}</p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="card-text">{{$user->movil}}</p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="card-text">{{$user->email}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div>
                                                    <a href="{{route('pacientes.show', $user->id)}}" class="btn btn-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    @if(Auth::user()->hasRole('admin'))
                                                        <a href="{{route('pacientes.edit', $user->id)}}" class="btn btn-warning">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger" onclick="confirmar_delete({{$user->id}})">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                    <button type="button" class="btn btn-outline-secondary" title="Ver mas"  data-bs-toggle="collapse" href="#more-info-{{$user->id}}" role="button" aria-expanded="false" aria-controls="more-info-{{$user->id}}">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                </div>
                                                <div id="more-info-{{$user->id}}" class="collapse">
                                                    <div class="d-flex flex-column justify-content-center gap-3 mt-2">
                                                        <a href="{{route('citas.create', ['paciente_id' => $user->id])}}" class="btn btn-success" title="Crear Cita">
                                                            <i class="bi bi-calendar-plus"></i> Crear Cita
                                                        </a>
                                                        @if(Auth::user()->hasRole('admin'))
                                                            <a href="{{route('pacientes.medicos_paciente', ['paciente' => $user->id])}}" class="btn btn-info" title="Ver Médicos">
                                                                <i class="bi bi-people"></i> Ver Médicos
                                                            </a>
                                                        @endif
                                                        <a href="{{route('solicitudes.create', ['paciente' => $user->id])}}" class="btn btn-secondary" title="Solicitar cita sin cita">
                                                            <i class="bi bi-chat-dots"></i> Solicitar especialidad
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pacientes as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->dni}}</td>
                                            <td>{{$user->movil}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>

                                                    <a href="{{route('pacientes.show', $user->id)}}" class="btn btn-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    @if(Auth::user()->hasRole('admin'))
                                                        <a href="{{route('pacientes.edit', $user->id)}}" class="btn btn-warning">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger" onclick="confirmar_delete({{$user->id}})">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                    <button type="button" class="btn btn-outline-secondary" title="Ver mas"  data-bs-toggle="collapse" href="#more-info-{{$user->id}}" role="button" aria-expanded="false" aria-controls="more-info-{{$user->id}}">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                {{-- <div class="mt-2">
                                                    <a href="{{route('citas.create', ['paciente_id' => $user->id])}}" class="btn btn-success" title="Crear Cita">
                                                        <i class="bi bi-calendar-plus"></i>
                                                    </a>
                                                    <a href="" class="btn btn-info" title="Ver Médicos">
                                                        <i class="bi bi-people"></i>
                                                    </a>
                                                    <a href="" class="btn btn-secondary" title="Consulta sin cita">
                                                        <i class="bi bi-chat-dots"></i>
                                                    </a>
                                                </div> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" id="more-info-{{$user->id}}" class="collapse">
                                                <div class="d-flex justify-content-center gap-3">
                                                    <div>
                                                        <a href="{{route('citas.create', ['paciente_id' => $user->id])}}" class="btn btn-success" title="Crear Cita">
                                                            <i class="bi bi-calendar-plus"></i> Crear Cita
                                                        </a>
                                                    </div>
                                                    @if(Auth::user()->hasRole('admin'))
                                                        <div>
                                                            <a href="{{route('pacientes.medicos_paciente', ['paciente' => $user->id])}}" class="btn btn-info" title="Ver Médicos">
                                                                <i class="bi bi-people"></i> Ver Médicos
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{route('solicitudes.create', ['paciente' => $user->id])}}" class="btn btn-secondary" title="Solicitar cita sin cita">
                                                            <i class="bi bi-chat-dots"></i> Solicitar especialidad
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <div class="d-flex d-md-block justify-content-center">
                            {{$pacientes->links()}}
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
                url: '/pacientes/' + id,
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
