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
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SelectionController;
use App\Http\Controllers\MisGastosController;
use App\Http\Controllers\UserSemanaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\StatsController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('auth.login'));

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

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
| Rutas protegidas
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->prefix('admin')->group(function () {

        Route::get('/admin-dashboard', [AdminController::class, 'index'])
            ->name('admin.admin-dashboard');

        Route::get('/manage-properties', [PropiedadesController::class, 'socios_propiedades'])
            ->name('admin.manage-properties');

        Route::delete('/propiedades/{propiedad}/socios/{usuario}', [PropiedadesController::class, 'eliminarSocio'])
            ->name('propiedades.socios.eliminar');

        Route::get('/manage-partners', [PageController::class, 'ManagePartners'])
            ->name('admin.manage-partners');

        Route::get('/propiedades/{id}/semanas', [PropiedadesController::class, 'show_semanas'])
            ->name('propiedades.semanas');

        Route::get('/reserved-weeks', [PropiedadesController::class, 'reservedWeeks'])
            ->name('admin.reserved-weeks');

        Route::get('/billing', [GastoComunController::class, 'index'])
            ->name('admin.billing');

        Route::put('/gastos/{gasto}/marcar-pagado', [GastoComunController::class, 'marcarPagado'])
            ->name('gastos.marcarPagado');

        Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('users.update');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');

        Route::get('/propiedades/{id}/socios', [PropiedadesController::class, 'socios'])
            ->name('propiedades.socios');

        Route::get('/propiedades/{id}/gastos', [GastoComunController::class, 'index'])
            ->name('gastos.index');

        Route::post('/gastos', [GastoComunController::class, 'store'])
            ->name('gastos.store');

        Route::get('/propiedades/{propiedad}/edit', [PropiedadesController::class, 'edit'])
            ->name('propiedades.edit');
        
        Route::put('/propiedades/{propiedad}', [PropiedadesController::class, 'update'])
            ->name('propiedades.update');

        Route::get('/propiedades/crear', [PropiedadesController::class, 'create'])
            ->name('propiedades.create');

        Route::post('/propiedades', [PropiedadesController::class, 'store'])
            ->name('propiedades.store');


        /*
        |-----------------------------------------------------------------------------
        | CHARTS Y CARDS
        |-----------------------------------------------------------------------------
        */

        Route::get('/charts', [ChartController::class, 'index'])
            ->name('charts');

        Route::get('/admin/admin-dashboard', [StatsController::class, 'index'])
            ->name('admin.dashboard');

    });

    /*
    |-----------------------------------------------------------------------------
    | USER
    |-----------------------------------------------------------------------------
    */

    Route::middleware('role:user')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('user.dashboard');

        Route::get('/mis-gastos', [MisGastosController::class, 'index'])
            ->name('user.billing');

        Route::get('/mis-semanas', [UserSemanaController::class, 'index'])
            ->name('user.mis-semanas');
        
        Route::get('/propiedades/{id}', [PropiedadesController::class, 'show'])
            ->name('propiedades.show');

        Route::get('/propiedades', [PropiedadesController::class, 'mostrar_propiedades'])
            ->name('propiedades');
        
        Route::post('/propiedades/{propiedad}/selections/save', [SelectionController::class, 'save'])
            ->name('selections.save');

        Route::get('/propiedad/{id}/semanas-detalle', [PropiedadesController::class, 'semanasDetalle'])
            ->name('propiedad.semanas.detalle');

        Route::get('/pagos/{gasto}', [PagoController::class, 'show']);
        Route::get('/pagos/crear/{gasto}', [PagoController::class, 'crearPago']);
        Route::post('/pagos/marcar-pagado/{gasto}', [PagoController::class, 'marcarPagado']);
        
        Route::post('/pagos/marcar-pagado/{gasto}', [PagoController::class, 'marcarPagado'])
            ->name('pagos.marcar-pagado');

    });

    /*
    |--------------------------------------------------------------------------
    | Rutas compartidas
    |--------------------------------------------------------------------------
    */

    Route::get('/mi-perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mi-perfil', [ProfileController::class, 'update'])->name('profile.update');

});
