@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/auth/login.css') }}">
@endsection

@section('content')
    <div class="full-screen">
        <div class="login-container">
            <h1 class="login-title">Bienvenido</h1>
            <form method="POST" action="{{ route('login') }}">
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

                <div class="input-group error">
                    <label for="password"></label>

                    <input id="password" placeholder="{{ __('Contraseña') }}" type="password" name="password" required autocomplete="current-password" class="login-form @error('password') is-invalid @enderror">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" id="login-button">Acceder</button>
                <a href="{{ route('register') }}" class="register text-center text-white">{{ __('¿No tienes cuenta? Regístrate') }}</a>
                <a href="{{ route('password.request') }}" class="forgot-password text-center text-white">{{ __('¿Olvidaste tu contraseña?') }}</a>
            </form>
        </div>
    </div>
@endsection
