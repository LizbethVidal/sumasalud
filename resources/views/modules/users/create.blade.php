@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h1 class="text-center">Crear Usuario</h1>
            <hr>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="Nombre" required value="{{old('name')}}">
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="email">Correo</label>
                            <input type="email" name="email" id="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Correo" required value="{{old('email')}}">
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-3">
                            <label for="dni">DNI</label>
                            <input type="text" name="dni" id="dni" class="form-control @if($errors->has('dni')) is-invalid @endif" placeholder="DNI" required value="{{old('dni')}}">
                            @if($errors->has('dni'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('dni')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-3">
                            <label for="movil">Teléfono</label>
                            <input type="text" name="movil" id="movil" class="form-control @if($errors->has('movil')) is-invalid @endif" placeholder="Teléfono" required value="{{old('movil')}}">
                            @if($errors->has('movil'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('movil')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-3">
                            <label for="fecha_nac">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nac" id="fecha_nac" class="form-control @if($errors->has('fecha_nac')) is-invalid @endif" placeholder="Fecha de Nacimiento" value="{{old('fecha_nac')}}">
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
                                <option value="admin">Administrador</option>
                                <option value="medico">Médico</option>
                                <option value="paciente">Paciente</option>
                            </select>
                            @if($errors->has('rol'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('rol')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control @if($errors->has('direccion')) is-invalid @endif" placeholder="Dirección" value="{{old('direccion')}}">
                            @if($errors->has('direccion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('direccion')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-9">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control @if($errors->has('foto')) is-invalid @endif" placeholder="Foto" value="{{old('foto')}}">
                            @if($errors->has('foto'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('foto')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Contraseña" required>
                            @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="col-6">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" placeholder="Confirmar Contraseña" required>
                            @if($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('password_confirmation')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-12 mt-3">
                            <button class="btn btn-success" type="submit">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
