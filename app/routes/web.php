<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PropiedadesController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {return view('login');});

########################### Rutas login #########################################

Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/AdminDashboard', [PropiedadesController::class, 'index'])->name('AdminDashboard');
    Route::get('/propiedades/{id}', [PropiedadesController::class, 'show'])->name('propiedades.show');
});

################################################################################# 

Route::get('/register', [PageController::class, 'register'])->name('register');
Route::get('/home', [PageController::class, 'home'])->name('home');

# Solo usar para debug /// Route::get('/AdminDashboard', [PageController::class, 'AdminDashboard'])->name('AdminDashboard');

# Consulta Propiedades
Route::get('/admin/Dashboard', [PropiedadesController::class, 'index'])
    ->name('admin.Dashboard');

# Consulta Propiedades
Route::get('/admin/ManageProperties', [PropiedadesController::class, 'listado'])
    ->name('admin.ManageProperties');

# Consulta Propiedades
Route::get('/admin/manage-par{+ltners', [PageController::class, 'ManagePartners'])->name('ManagePartners');

# Consulta Propiedades
Route::get('/admin/reserved-weeks', [PageController::class, 'ReservedWeeks'])->name('ReservedWeeks');

# Consulta Propiedades
Route::get('/admin/billing-page', [PageController::class, 'BillingPage'])->name('BillingPage');

# Consulta Propiedades por ID
Route::get('/propiedades/{id}', [PropiedadesController::class, 'show'])
    ->name('propiedades.show');