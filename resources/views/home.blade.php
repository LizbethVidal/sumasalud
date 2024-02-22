@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex justify-content-start flex-column gap-3">
            @if(Auth::user()->rol != 'paciente')
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div>
                            <h3>Users</h3>
                            <hr>
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Crear Usuario</a>
                            <a href="{{ route('users.index') }}" class="btn btn-primary">Ver Usuarios</a>
                            <a href="{{ route('pacientes.index')}}" class="btn btn-primary"> Ver Pacientes</a>
                            <a href="{{ route('empleados.index')}}" class="btn btn-primary"> Ver Empleados</a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div>
                        <h3>Especialidades</h3>
                        <hr>
                        <a href="{{ route('especialidades.create') }}" class="btn btn-primary">Crear Especialidad</a>
                        <a href="{{ route('especialidades.index') }}" class="btn btn-primary">Ver Especialidades</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
