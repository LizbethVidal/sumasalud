@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/modules/users/index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <h1 class="text-center">Editar Medico</h1>
                <hr>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('medicos.update', $user->id)}}" enctype="multipart/form-data">
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
                                <label for="especialidad_id">Especialidad</label>
                                <select name="especialidad_id" id="especialidad_id" class="form-control form-select @if($errors->has('especialidad_id')) is-invalid @endif" required>
                                    <option value="">Seleccione una especialidad</option>
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{$especialidad->id}}" @if($user->especialidad_id == $especialidad->id) selected @endif>{{$especialidad->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-9">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control @if($errors->has('direccion')) is-invalid @endif" placeholder="Dirección" value="{{$user->direccion}}">
                            </div>
                            <div class="col-12 mt-3">
                                <a href="{{route('empleados.index')}}" class="btn btn-outline-dark">
                                    <i class="bi bi-arrow-left-circle"></i> Volver
                                </a>
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

    <script>
    </script>

    <script type="module">
        $(document).ready(function() {
            $('#especialidad').select2({
                theme: 'bootstrap-5'

            })
        });
    </script>
@endsection
