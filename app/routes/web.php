<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PropiedadesController;

Route::get('/', function () {return view('login');});

Route::get('/login', [PageController::class, 'login'])->name('login');
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
Route::get('/admin/ManagePartners', [PageController::class, 'ManagePartners'])->name('ManagePartners');

# Consulta Propiedades
Route::get('/admin/ReservedWeeks', [PageController::class, 'ReservedWeeks'])->name('ReservedWeeks');

# Consulta Propiedades
Route::get('/admin/BillingPage', [PageController::class, 'BillingPage'])->name('BillingPage');

# Consulta Propiedades por ID
Route::get('/propiedades/{id}', [PropiedadesController::class, 'show'])
    ->name('propiedades.show');