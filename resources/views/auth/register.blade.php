@extends('layouts.app')

@section('content')
  <div class="card p-4 shadow" style="max-width: 25rem; margin:auto; margin-top:50px;">
    <h4 class="center-align mb-3">🗂️ Registro de Usuario</h4>

    @if(session('success'))
      <div class="card-panel green lighten-4 green-text text-darken-4">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="/register">
      @csrf

      <div class="input-field">
        <input type="text" name="name" id="name" required>
        <label for="name">Nombre</label>
      </div>

      <div class="input-field">
        <input type="text" name="username" id="username" required>
        <label for="username">Usuario</label>
      </div>

      <div class="input-field">
        <input type="email" name="email" id="email" required>
        <label for="email">Email</label>
      </div>

      <div class="input-field">
        <input type="password" name="password" id="password" required>
        <label for="password">Contraseña</label>
      </div>

      <div class="input-field">
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <label for="password_confirmation">Confirmar Contraseña</label>
      </div>

      <div class="input-field">
        <select name="rol" required>
          <option value="" disabled selected>Seleccione un rol</option>
          <option value="admin">Admin</option>
          <option value="digitador">Digitador</option>
          <option value="supervisor">Supervisor</option>
        </select>
        <label>Rol</label>
      </div>

      <button type="submit" class="btn waves-effect waves-light w-100">Crear Usuario</button>
    </form>

    <p class="center-align" style="margin-top:20px;">
      <a href="/login">Volver al login</a>
    </p>
  </div>

  <!-- Inicializar select de Materialize -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      M.FormSelect.init(elems);
    });
  </script>
@endsection
