<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// PONER / EN LA RAÍZ
Route::get('/', function () {
    return redirect()->route('login');
});

// RUTAS DE AUTENTICACIÓN
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// RUTAS PROTEGIDAS POR LOGIN
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD DE ACTAS
    Route::get('/actas/crear', [ActaController::class, 'create'])->name('actas.create');
    Route::post('/actas', [ActaController::class, 'store'])->name('actas.store');

    Route::get('/actas/listar', [ActaController::class, 'listarActas'])->name('actas.listar');

    // Editar y actualizar acta
    Route::get('/actas/{id}/editar', [ActaController::class, 'edit'])->name('actas.edit');
    Route::put('/actas/{id}', [ActaController::class, 'update'])->name('actas.update');

    // Eliminar acta
    Route::delete('/actas/{id}', [ActaController::class, 'destroy'])->name('actas.destroy');

    // Ver detalle de acta individual
    Route::get('/actas/{id}', [ActaController::class, 'show'])->name('actas.show');

    // RUTA DE ESTADÍSTICAS
    Route::get('/estadisticas', [App\Http\Controllers\EstadisticaController::class, 'index'])->name('estadisticas.index');

});

// API PARA CARGAR CENTROS DINÁMICOS
Route::get('/api/centros/{municipio}', [ActaController::class, 'getCentros']); //REVISAR API PUBLICA 21/10/25

// ENDPOINT AUXILIAR: última actualización
Route::get('/actas/ultima-actualizacion', function () {
    $ultima = \App\Models\Acta::latest('updated_at')->value('updated_at');
    return response()->json(['ultima_actualizacion' => $ultima]);
});


Route::middleware(['auth'])->group(function () {

    // 1. Ruta Principal: Muestra TODO (Perfil + Tabla si eres admin)
    Route::get('/opciones', [ProfileController::class, 'edit'])->name('opciones.edit');
    
    // 2. Acción: Cambiar MI propia contraseña
    Route::patch('/opciones', [ProfileController::class, 'update'])->name('opciones.update');

    // 3. Acciones Administrativas (Editar OTROS / Borrar OTROS)
    // Estas rutas reciben los datos de los formularios en la tabla
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});