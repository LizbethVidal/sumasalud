@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h1 class="text-center">Crear Médico</h1>
            <hr>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('medicos.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="name" class="form-control @if($errors->has('nombre')) is-invalid @endif" placeholder="Nombre" required value="{{old('nombre')}}">
                            @if($errors->has('nombre'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('nombre')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="dni">DNI</label>
                            <input type="text" name="dni" id="dni" class="form-control @if($errors->has('dni')) is-invalid @endif" placeholder="DNI" required value="{{old('dni')}}">
                            @if($errors->has('dni'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('dni')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control @if($errors->has('telefono')) is-invalid @endif" placeholder="Teléfono" required value="{{old('telefono')}}">
                            @if($errors->has('telefono'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('telefono')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Email" required value="{{old('email')}}">
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="especialidad">Especialidad</label>
                            <select name="especialidad" id="especialidad" class="form-control @if($errors->has('especialidad')) is-invalid @endif" required>
                                <option value="">Seleccione una especialidad</option>
                                @foreach($especialidades as $especialidad)
                                    <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('especialidad'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('especialidad')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control @if($errors->has('direccion')) is-invalid @endif" placeholder="Dirección" required value="{{old('direccion')}}">
                            @if($errors->has('direccion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('direccion')}}</strong>
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
</div>

<script type="module">
    $(document).ready(function() {
        $('#especialidad').select2({
            theme:'bootstrap-5'
        });
    });

</script>
@endsection
