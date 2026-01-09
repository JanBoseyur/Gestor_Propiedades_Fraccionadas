<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/AdminDashboard', [PageController::class, 'AdminDashboard'])->name('AdminDashboard');
Route::get('/AdminPropertyDetails', [PageController::class, 'AdminPropertyDetails'])->name('AdminPropertyDetails');
Route::get('/ManagePartners', [PageController::class, 'ManagePartners'])->name('ManagePartners');   