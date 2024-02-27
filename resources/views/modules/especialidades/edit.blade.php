@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h1 class="text-center">Editar Especialidad</h1>
            <hr>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('especialidades.update', $especialidad->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="name" class="form-control @if($errors->has('nombre')) is-invalid @endif" placeholder="Nombre" required value="{{$especialidad->nombre}}">
                            @if($errors->has('nombre'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('nombre')}}</strong>
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
@endsection

