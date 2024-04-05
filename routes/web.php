<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EventoPersonalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::view('/goals', 'goals.goals');

/* Rutas para el modulo de calendario */
Route::middleware('auth')->group(function () {
    Route::get('/index', [CalendarioController::class, 'index'])->name('index');
});

/* Rutas para marcar como leídas las notificaciones */
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
Route::post('/notification/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');

Route::middleware('auth')->group(function () {

    Route::view('/apps/chat', 'apps.chat.index');
    
});

/* Rutas para el modulo de servicios */
Route::middleware('auth')->group(function () {
    Route::get('/apps/servicio', [ServicioController::class, 'index'])->name('apps.servicio.index');
    Route::post('/apps/servicio', [ServicioController::class, 'store'])->name('apps.servicio.store');
    Route::put('/apps/servicio/{id}', [ServicioController::class, 'update'])->name('apps.servicio.update');
    Route::delete('/apps/servicio/{id}', [ServicioController::class, 'destroy'])->name('apps.servicio.destroy');
});

/* Rutas para el modulo de gruposs */
Route::middleware('auth')->group(function () {
    Route::get('/apps/grupo', [GrupoController::class, 'index'])->name('apps.grupo.index');
    Route::post('/apps/grupo', [GrupoController::class, 'store'])->name('apps.grupo.store');
    Route::put('/apps/grupo/{id}', [GrupoController::class, 'update'])->name('apps.grupo.update');
    Route::delete('/apps/grupo/{id}', [GrupoController::class, 'destroy'])->name('apps.grupo.destroy');
});

/* Rutas para el modulo de carreras */
Route::middleware('auth')->group(function () {
    Route::get('/apps/carrera', [CarreraController::class, 'index'])->name('apps.carrera.index');
    Route::post('/apps/carrera', [CarreraController::class, 'store'])->name('apps.carrera.store');
    Route::put('/apps/carrera/{id}', [CarreraController::class, 'update'])->name('apps.carrera.update');
    Route::delete('/apps/carrera/{id}', [CarreraController::class, 'destroy'])->name('apps.carrera.destroy');
});

/* Rutas para el modulo de comunidad (admin) */
Route::middleware('auth')->group(function () {
    Route::get('/apps/comunidad', [PublicacionController::class, 'index'])->name('apps.comunidad.index');
    Route::post('/apps/comunidad', [PublicacionController::class, 'store'])->name('apps.comunidad.store');
    Route::put('/apps/comunidad/{id}', [PublicacionController::class, 'update'])->name('apps.comunidad.update');
    Route::delete('/apps/comunidad/{id}', [PublicacionController::class, 'destroy'])->name('apps.comunidad.destroy');
});

/* Rutas para el modulo de comunidad (estudiante) */
Route::middleware('auth')->group(function () {
    Route::get('/apps/comunidad_estudiante', [PublicacionController::class, 'index'])->name('apps.comunidad_estudiante.index');
});

/* Rutas para el modulo de perfil */
Route::middleware('auth')->group(function () {
    Route::get('/apps/users', [PerfilController::class, 'index'])->name('apps.users.index');
    Route::put('/apps/users', [PerfilController::class, 'update'])->name('apps.users.update');
});

/* Rutas para el modulo de eventos personales */
Route::middleware('auth')->group(function () {
    Route::get('/apps/evento', [EventoPersonalController::class, 'index'])->name('apps.evento.index');
    Route::post('/apps/evento', [EventoPersonalController::class, 'store'])->name('apps.evento.store');
    Route::put('/apps/evento/{id}', [EventoPersonalController::class, 'update'])->name('apps.evento.update');
    Route::delete('/apps/evento/{id}', [EventoPersonalController::class, 'destroy'])->name('apps.evento.destroy');
});

/* Rutas para el modulo de citas (admin) */
Route::middleware('auth')->group(function () {
    Route::get('/apps/cita', [CitaController::class, 'index'])->name('apps.cita.index');
    Route::get('/apps/cita/estudiante/{matricula}', [CitaController::class, 'buscarPorMatricula'])->name('apps.cita.estudiante.buscarPorMatricula');
    Route::post('/apps/cita', [CitaController::class, 'store'])->name('apps.cita.store');
    Route::put('/apps/cita/{id}', [CitaController::class, 'update'])->name('apps.cita.update');
    Route::delete('/apps/cita/{id}', [CitaController::class, 'destroy'])->name('apps.cita.destroy');
});

/* Rutas para el modulo de citas (estudiante) */
Route::middleware('auth')->group(function () {
    Route::get('/apps/cita_estudiante', [CitaController::class, 'index'])->name('apps.cita_estudiante.index');
    Route::post('/apps/cita_estudiante', [CitaController::class, 'store'])->name('apps.cita_estudiante.store');
});

require __DIR__.'/auth.php';
