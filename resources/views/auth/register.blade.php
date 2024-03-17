@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/auth/login.css') }}">
@endsection

@section('content')
    <div class="full-screen">
        <div class="login-container">
            <h1 class="login-title"> Regístrate </h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group success">
                    <label for="name"></label>
                    <input id="name" placeholder="{{ __('Nombre') }}" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus class="login-form @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group success">
                    <label for="email"></label>
                    <input id="email" placeholder="{{ __('Correo electrónico') }}" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="login-form @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group success">
                    <label for="dni"></label>
                    <input id="dni" placeholder="{{ __('DNI') }}" type="text" name="dni" value="{{ old('dni') }}" required autocomplete="dni" autofocus class="login-form @error('dni') is-invalid @enderror">
                    @error('dni')
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
                <div class="input-group error">
                    <label for="password-confirm"></label>
                    <input id="password-confirm" placeholder="{{ __('Confirmar contraseña') }}" type="password" name="password_confirmation" required autocomplete="current-password" class="login-form @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" id="login-button">Registrarse</button>
                <a href="{{ route('login') }}" class="register text-center text-white">{{ __('¿Ya tienes cuenta? Inicia sesión') }}</a>
            </form>
        </div>
    </div>
@endsection

