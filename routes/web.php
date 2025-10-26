<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/test-s3-upload', function() {
    try {
        $filePath = Storage::disk('s3')->put('test', '¡Conexión exitosa!');
        if ($filePath) {
            return '✅ Archivo subido a S3 en: ' . Storage::disk('s3')->url($filePath);
        } else {
            return '❌ No se pudo subir el archivo.';
        }
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
});