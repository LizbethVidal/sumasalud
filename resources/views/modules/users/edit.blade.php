@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/modules/users/index.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <h1 class="text-center">Editar Usuario</h1>
                <hr>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4">
                                <div class="mt-2 profile_img">
                                    <img id="preview" src="{{ $user->foto ? asset('storage/' . $user->foto) : '/images/default.png' }}" alt="Foto de Perfil" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                                <div class="mt-2">
                                    <input type="file" name="foto" id="foto" class="form-control @if($errors->has('foto')) is-invalid @endif" accept="image/*" onchange="previewFile()">
                                    @if($errors->has('foto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('foto')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 mb-3"></div>
                            <hr>

                            <div class="col-6">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Nombre" required value="{{$user->name}}">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="email">Correo</label>
                                <input type="email" name="email" id="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Correo" required value="{{$user->email}}">
                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-3">
                                <label for="dni">DNI</label>
                                <input type="text" name="dni" id="dni" class="form-control @if($errors->has('dni')) is-invalid @endif" placeholder="DNI" required value="{{$user->dni}}">
                                @if($errors->has('dni'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('dni')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-3">
                                <label for="movil">Teléfono</label>
                                <input type="text" name="movil" id="movil" class="form-control @if($errors->has('movil')) is-invalid @endif" placeholder="Teléfono" required value="{{$user->movil}}">
                                @if($errors->has('movil'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('movil')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-3">
                                <label for="fecha_nac">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nac" id="fecha_nac" class="form-control @if($errors->has('fecha_nac')) is-invalid @endif" placeholder="Fecha de Nacimiento" value="{{$user->fecha_nac}}">
                                @if($errors->has('fecha_nac'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('fecha_nac')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-3">
                                <label for="rol">Rol</label>
                                <select name="rol" id="rol" class="form-control @if($errors->has('rol')) is-invalid @endif" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="admin" @if($user->rol == 'admin') selected @endif>Administrador</option>
                                    <option value="medico" @if($user->rol == 'medico') selected @endif>Medico</option>
                                    <option value="paciente" @if($user->rol == 'paciente') selected @endif>Paciente</option>
                                </select>
                                @if($errors->has('rol'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('rol')}}</strong>
                                    </span>
                                @endif
                            </div>
                            @if($user->rol == 'paciente')
                            <div class="col-3">
                                <label for="tutor">Tutor</label>
                                <input readonly="true" type="text" name="tutor" id="tutor" class="form-control" placeholder="Tutor" value="{{$user->tutor?->name}}">
                                <input type="hidden" name="tutor_id" id="tutor_id" value="{{$user->tutor_id}}">
                            </div>
                            @elseif ($user->rol == 'medico')
                                {{-- Especialidad seleccionar, como quieras  --}}
                            @endif
                            <div class="col-9">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control @if($errors->has('direccion')) is-invalid @endif" placeholder="Dirección" value="{{$user->direccion}}">
                            </div>
                            <div class="col-12 mt-3">
                                <a href="{{route('users.index')}}" class="btn btn-outline-dark">
                                    <i class="bi bi-arrow-left-circle"></i> Volver
                                </a>
                                @if($user->rol == 'paciente')
                                    <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modal_tutor">
                                        <i class="bi bi-person-plus"></i> Asignar Tutor
                                    </button>
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_tutor" tabindex="-1" aria-labelledby="modal_tutor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar Tutor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="user_id" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-12">
                            <label for="tutor_search">DNI</label>
                            <input type="text" name="tutor_search" id="tutor_search" class="form-control" placeholder="Buscar Tutor">
                        </div>
                    </div>
                    <div class="row" id="tutors">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_modal" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="search_tutor()">Buscar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function search_tutor() {
            var tutor_search = $('#tutor_search').val();
            $.ajax({
                url: '/users/search_tutor',
                type: 'POST',
                data: {
                    _token: $('input[name=_token]').val(),
                    tutor_search: tutor_search,
                    user_id: $('#user_id').val()
                },
                success: function (response) {
                    var tutors = response.tutors;
                    var html = '';
                    tutors.forEach(tutor => {
                        html += '<div class="col-12 mt-3">';
                        html += '<button type="button" class="btn btn-outline-dark" onclick="assign_tutor('+tutor.id+', \''+tutor.name+'\')">';
                        html += tutor.name;
                        html += '</button>';
                        html += '</div>';
                    });

                    if(tutors.length == 0) {
                        html += '<div class="col-12 mt-3">';
                        html += '<p>No se encontraron resultados, recuerde que debe buscar por DNI</p>';
                        html += '</div>';
                    }
                    $('#tutors').html(html);
                }
            });
        }

        function assign_tutor(tutor_id, tutor_name) {
            $('#tutor').val(tutor_name);
            $('#tutor_id').val(tutor_id);
            $('#close_modal').click();
        }
    </script>

    <script type="module">
        $(document).ready(function() {
            $('#modal_tutor').on('hidden.bs.modal', function (e) {
                $('#tutor_search').val('');
                $('#tutors').html('');
            });
        });
    </script>
@endsection
