@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row valign-wrapper" style="height:100vh;">
    <div class="col s12 m6 offset-m3">
        <div class="card">
            <div class="card-content">
                <h5 class="center-align text-brand">Plataforma Actas</h5>

                <form method="POST" action="/login">
                    @csrf
                    <div class="input-field">
                        <input id="username" type="text" name="username" required>
                        <label for="username">Usuario</label>
                    </div>

                    <div class="input-field">
                        <input id="password" type="password" name="password" required>
                        <label for="password">Contraseña</label>
                    </div>

                    @error('login_error')
                        <div class="red-text">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn waves-effect waves-light red darken-2" style="width:100%;">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
