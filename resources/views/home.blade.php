@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div>
                        <h3>Users</h3>
                        <hr>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Crear Usuario</a>
                        <a href="{{ route('users.index') }}" class="btn btn-primary">Ver Usuarios</a>
                        <a href="{{ route('users.verPacientes')}}" class="btn btn-primary"> Ver Pacientes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
