@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/auth/login.css') }}">
@endsection

@section('content')
    <div class="full-screen">
        <div class="login-container">
            <h1 class="login-title">Recupera tu contraseña</h1>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group success">
                    <label for="email"></label>
                    <input id="email" placeholder="{{ __('Correo electrónico') }}" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="login-form @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" id="login-button">Enviar enlace de recuperación</button>
                <a href="{{ route('login') }}" class="register text-center text-white">{{ __('¿Ya tienes cuenta? Inicia sesión') }}</a>
            </form>
        </div>

    </div>
@endsection
