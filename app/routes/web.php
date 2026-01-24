<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PageController;
use App\Http\Controllers\PropiedadesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\GastoComunController;
use Spatie\Permission\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    # Dashboard principal
    Route::get('/AdminDashboard', [AdminController::class, 'index'])->name('AdminDashboard');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Rutas solo ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'role:admin'])->group(function () {

        # Dashboards y propiedades
        Route::get('/admin/Dashboard', [PropiedadesController::class, 'index'])->name('admin.Dashboard');
        Route::get('/admin/ManageProperties',[PropiedadesController::class, 'socios_propiedades'])->name('admin.ManageProperties');
        Route::get('/admin/ManageProperties', [PropiedadesController::class, 'contar_usuarios_propiedad'])->name('admin.ManageProperties');

        # Eliminar socio
        Route::delete('/admin/propiedades/{propiedad}/socios/{usuario}', [PropiedadesController::class, 'eliminarSocio'])->name('propiedades.socios.eliminar');

        # Gestion de socios
        Route::get('/admin/manage-partners', [PageController::class, 'ManagePartners'])->name('ManagePartners');

        # Semanas y reservas
        Route::get('/admin/propiedades/{id}/semanas', [PropiedadesController::class, 'show_semanas'])->name('propiedades.semanas');
        Route::get('/admin/reserved-weeks', [PropiedadesController::class, 'reservedWeeks'])->name('admin.reserved-weeks');

        # Pagos y gastos comunes
        Route::get('/admin/billing-page', [GastoComunController::class, 'index'])->name('BillingPage');
        Route::put('/gastos/{gasto}/marcar-pagado', [GastoComunController::class, 'marcarPagado'])->name('gastos.marcarPagado');

        # Usuarios
        Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Rutas solo SOCIO
    |--------------------------------------------------------------------------
    */
    
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Rutas generales (usuarios, propiedades, gastos)
    |--------------------------------------------------------------------------
    */

    # Propiedades
    Route::get('/propiedades/{id}', [PropiedadesController::class, 'show'])->name('propiedades.show');
    Route::get('/propiedades/{id}/socios', [PropiedadesController::class, 'socios'])->name('propiedades.socios');
    Route::get('/propiedades/{id}/gastos', [GastoComunController::class, 'index'])->name('gastos.index');

    # Gastos
    Route::post('/gastos', [GastoComunController::class, 'store'])->name('gastos.store');

    Route::get('/test-role-admin', function () {
        return 'ACCESO ADMIN PERMITIDO';
    })->middleware('role:admin'); // <- funciona perfectamente

    Route::get('/test-role-user', function () {
        return 'ACCESO USER PERMITIDO';
    })->middleware('role:user');
});
