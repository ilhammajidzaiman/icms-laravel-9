<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('private.dashboard');
// });

Route::get('/', [App\Http\Controllers\Public\PublicController::class, 'index'])->name('/');

Route::get('/redirect', function () {
    $prefix = strtolower(auth()->user()->level->name);
    return redirect()->intended($prefix . '/dashboard');
});

Route::controller(App\Http\Controllers\LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login')->middleware('guest');
    Route::post('login', 'authenticate')->name('authenticate');
    Route::get('logout', 'logout')->name('logout');
    Route::post('logout', 'logout')->name('logout');
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->controller()->group(
    function () {
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('profil')->controller(App\Http\Controllers\ProfilController::class)->group(function () {
            Route::get('/{uuid}', 'index')->name('admin.profil');
            Route::get('/{uuid}/edit', 'edit')->name('admin.profil.edit');
            Route::put('/{uuid}', 'update')->name('admin.profil.update');
            Route::get('/{uuid}/password', 'password')->name('admin.profil.password');
            Route::put('/{uuid}', 'update2')->name('admin.profil.update2');
        });

        Route::prefix('config')->controller(App\Http\Controllers\Admin\ConfigController::class)->group(function () {
            Route::get('/', 'index')->name('admin.config');
            Route::get('/edit', 'edit')->name('admin.config.edit');
            Route::put('/edit', 'update')->name('admin.config.edit');
        });

        Route::prefix('master')->group(
            function () {
                Route::resource('/status', App\Http\Controllers\Admin\UserStatusController::class)->scoped(['status' => 'slug']);
                Route::resource('/level', App\Http\Controllers\Admin\UserLevelController::class)->scoped(['level' => 'slug']);
            }
        );

        Route::resource('/user', App\Http\Controllers\Admin\UserController::class)->scoped(['user' => 'uuid']);
    }
);







Route::prefix('user')->middleware(['auth', 'isUser'])->group(
    function () {
        Route::prefix('profil')->controller(App\Http\Controllers\ProfilController::class)->group(function () {
            Route::get('/{uuid}', 'index')->name('admin.profil');
            Route::get('/{uuid}/edit', 'edit')->name('admin.profil.edit');
            Route::put('/{uuid}', 'update')->name('admin.profil.update');
        });

        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('user.dashboard');
    }
);
