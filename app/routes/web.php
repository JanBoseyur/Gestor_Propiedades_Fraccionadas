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
Route::get('/admin/dashboard', [PropiedadesController::class, 'index'])
    ->name('admin.dashboard');

# Consulta Propiedades
Route::get('/admin/ManageProperties', [PropiedadesController::class, 'listado'])
    ->name('admin.ManageProperties');

Route::get('/ManagePartners', [PageController::class, 'ManagePartners'])->name('ManagePartners');   

# Consulta Propiedades por ID
Route::get('/propiedades/{id}', [PropiedadesController::class, 'show'])
    ->name('propiedades.show');