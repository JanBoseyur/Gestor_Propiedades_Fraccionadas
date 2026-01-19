<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PropiedadesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {return view('auth.login');});

########################### Rutas Login #########################################

// Vista login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Procesar login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/AdminDashboard', [AdminController::class, 'index'])
        ->name('AdminDashboard');
});

########################### Rutas Register #########################################

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

################################################################################# 

Route::get('/home', [PageController::class, 'home'])->name('home');

# Solo usar para debug /// Route::get('/AdminDashboard', [PageController::class, 'AdminDashboard'])->name('AdminDashboard');

# Consulta Propiedades
Route::get('/admin/Dashboard', [PropiedadesController::class, 'index'])
    ->name('admin.Dashboard');

# Consulta Propiedades
Route::get('/admin/ManageProperties', [PropiedadesController::class, 'listado'])
    ->name('admin.ManageProperties');

# Consulta Propiedades
Route::get('/admin/manage-partners', [PageController::class, 'ManagePartners'])->name('ManagePartners');

# Consulta Propiedades
Route::get('/admin/reserved-weeks', [PageController::class, 'ReservedWeeks'])->name('ReservedWeeks');

# Consulta Propiedades
Route::get('/admin/billing-page', [PageController::class, 'BillingPage'])->name('BillingPage');

# Consulta Propiedades por ID
Route::get('/propiedades/{id}', [PropiedadesController::class, 'show'])
    ->name('propiedades.show');

Route::get('/propiedades/{id}/socios', [PropiedadesController::class, 'socios'])
    ->middleware('auth')
    ->name('propiedades.socios');

# Modificar Usuarios
Route::put('/admin/users/{user}', [UserController::class, 'update'])
    ->name('users.update');

Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy');