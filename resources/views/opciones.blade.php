@extends('layouts.app') {{-- Asegúrate que el nombre de tu layout sea correcto --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <h4 class="center-align">Opciones de Cuenta</h4>
            
            {{-- ALERTAS GENERALES --}}
            @if (session('status') || session('success') || session('error'))
                <div class="card-panel {{ session('error') ? 'red' : 'green' }} lighten-2">
                    <span class="white-text">
                        {{ session('status') }}
                        {{ session('success') }}
                        {{ session('error') }}
                    </span>
                </div>
            @endif

            <div class="card hoverable">
                <div class="card-content">
                    <span class="card-title">🔑 Cambiar Mi Contraseña</span>
                    <p class="mb-3">Usuario: **{{ $user->username }}** | Rol: **{{ ucfirst($user->rol) }}**</p>
                    
                    <form action="{{ route('opciones.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            {{-- Contraseña Actual --}}
                            <div class="input-field col s12 m4">
                                <input id="current_password" type="password" name="current_password" required>
                                <label for="current_password">Contraseña Actual</label>
                                @error('current_password')
                                    <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            {{-- Nueva Contraseña --}}
                            <div class="input-field col s12 m4">
                                <input id="password" type="password" name="password" required>
                                <label for="password">Nueva Contraseña</label>
                                @error('password')
                                    <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            {{-- Confirmar Nueva Contraseña --}}
                            <div class="input-field col s12 m4">
                                <input id="password_confirmation" type="password" name="password_confirmation" required>
                                <label for="password_confirmation">Confirmar Nueva</label>
                            </div>
                        </div>
                        
                        <div class="card-action right-align">
                            <button class="btn waves-effect waves-light blue" type="submit">
                                Actualizar Clave
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if(isset($usersList)) 
            <div class="card">
                <div class="card-content">
                    <span class="card-title">👥 Gestión de Usuarios</span>
                    
                    <div class="table-responsive">
                        <table class="striped highlight responsive-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    {{-- Solo ADMIN ve IP y Fecha --}}
                                    @if($user->rol === 'admin')
                                        <th>IP</th>
                                        <th>Última Conexión</th>
                                        <th class="center-align">Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usersList as $u)
                                <tr>
                                    <td>{{ $u->id }}</td>
                                    <td>
                                        <strong>{{ $u->name }}</strong><br>
                                        <span class="grey-text text-darken-1">{{ $u->email }}</span>
                                    </td>
                                    <td>
                                        <span class="new badge {{ $u->rol == 'admin' ? 'red' : ($u->rol == 'supervisor' ? 'blue' : 'grey') }}" data-badge-caption="">
                                            {{ ucfirst($u->rol) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="{{ $u->is_active ? 'green-text' : 'red-text' }} fw-bold">
                                            {{ $u->is_active ? 'Activo' : 'Bloqueado' }}
                                        </span>
                                    </td>
                                    
                                    {{-- COLUMNAS Y ACCIONES EXCLUSIVAS DE ADMIN --}}
                                    @if($user->rol === 'admin')
                                        <td class="small-text">{{ $u->last_login_ip ?? '-' }}</td>
                                        <td class="small-text">{{ $u->last_login_at ?? '-' }}</td>
                                        <td class="center-align">
                                            
                                            {{-- BOTÓN PARA ABRIR EL SIDENAV (Llama a JS) --}}
                                            <button 
                                                type="button"
                                                class="btn-small waves-effect waves-light orange"
                                                onclick="openUserSidenav(
                                                    '{{ $u->id }}', 
                                                    '{{ $u->name }}', 
                                                    '{{ $u->rol }}', 
                                                    '{{ $u->is_active }}'
                                                )">
                                                <i class="material-icons">edit</i>
                                            </button>

                                            {{-- Botón Borrar --}}
                                            <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Borrar usuario?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-small waves-effect waves-light red"><i class="material-icons">delete</i></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        {{-- Paginación (Usando la plantilla default) --}}
                        <div class="mt-3 center-align">
                            {{ $usersList->links('pagination::default') }} 
                        </div>
                    </div>
                </div>
            </div>
            @endif 
        </div>
    </div>
</div>

<ul id="user-sidenav" class="sidenav sidenav-right">
    <li>
        <div class="user-view">
            <span class="sidenav-close right-align"><i class="material-icons">close</i></span>
            <h5 id="sidenav-title">Editando Usuario</h5>
            <p id="sidenav-subtitle" class="grey-text"></p>
        </div>
    </li>
    <li>
        <div class="divider"></div>
    </li>
    <li>
        <div class="row" style="padding: 0 20px;">
            <form id="user-edit-form" method="POST">
                @csrf 
                @method('PUT')
                
                <p>Opciones de gestión:</p>

                {{-- Selector de Rol --}}
                <div class="input-field col s12">
                    <select name="rol" id="edit-rol">
                        <option value="admin">Admin</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="user">Usuario</option>
                    </select>
                    <label>Rol</label>
                </div>

                {{-- Checkbox de Estado --}}
                <div class="col s12 mt-3">
                    <p>
                        <label>
                            <input type="checkbox" name="is_active" id="edit-is_active" value="1" />
                            <span>Cuenta Habilitada / Bloqueada</span>
                        </label>
                    </p>
                </div>

                {{-- Resetear Contraseña --}}
                <div class="input-field col s12">
                    <input id="edit-password" type="password" name="password">
                    <label for="edit-password">Nueva clave (opcional)</label>
                </div>

                {{-- Botón de Guardar --}}
                <div class="col s12 center-align" style="margin-top: 20px;">
                    <button type="submit" class="btn waves-effect waves-light green accent-4">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </li>
</ul>

<script>
    // Variables globales para las instancias de Materialize
    let sidenavInstance;
    let selectInstance;

    document.addEventListener('DOMContentLoaded', function() {
        // 1. Inicializa el Sidenav (Cajón Lateral)
        var sidenavEl = document.querySelector('#user-sidenav');
        sidenavInstance = M.Sidenav.init(sidenavEl, {
            edge: 'right'
        });
        
        // 2. Inicializa los Selects generales (incluye el select de roles en el sidenav)
        var selectElems = document.querySelectorAll('select');
        M.FormSelect.init(selectElems);
    });

    /**
     * Función que abre el Sidenav y carga los datos del usuario seleccionado.
     */
    function openUserSidenav(userId, userName, userRol, isActive) {
        
        // --- 1. Cargar Datos en el Formulario ---
        
        // Títulos
        document.getElementById('sidenav-title').innerText = `Editando a ${userName}`;
        document.getElementById('sidenav-subtitle').innerText = `ID: ${userId}`;
        
        // Selector de Rol
        const rolSelect = document.getElementById('edit-rol');
        rolSelect.value = userRol;
        
        // Checkbox Activo/Bloqueado (Nota: isActive es '1' o '0' desde Laravel)
        const isActiveCheckbox = document.getElementById('edit-is_active');
        isActiveCheckbox.checked = (isActive == '1' || isActive === true); 

        // Resetear campo de contraseña
        document.getElementById('edit-password').value = ''; 
        
        // --- 2. Establecer la Acción del Formulario ---
        const form = document.getElementById('user-edit-form');
        form.action = `/users/${userId}`; // Usa la ruta PUT /users/{id}
        
        // --- 3. Abrir el Sidenav ---
        sidenavInstance.open();
        
        // --- 4. Forzar Actualización de Materialize ---
        // Necesario para que el Select muestre el valor pre-seleccionado
        M.updateTextFields(); // Actualiza etiquetas de inputs
        
        // Re-inicializamos el Select para que muestre el valor correcto
        var selectEl = document.querySelector('#edit-rol');
        M.FormSelect.init(selectEl); 
    }
</script>
@endsection