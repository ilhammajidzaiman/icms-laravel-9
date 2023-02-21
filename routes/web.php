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



Route::controller(App\Http\Controllers\private\LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login')->middleware('guest');
    Route::post('login', 'authenticate')->name('authenticate');
    Route::get('logout', 'logout')->name('logout');
    Route::post('logout', 'logout')->name('logout');
});



Route::prefix('superadmin')->middleware(['auth', 'isSuperAdmin'])->controller()->group(
    function () {
        Route::get('/dashboard', [App\Http\Controllers\Private\DashboardController::class, 'index'])->name('superadmin.dashboard');

        Route::prefix('profil')->controller(App\Http\Controllers\Private\ProfilController::class)->group(function () {
            Route::get('/{uuid}', 'index')->name('superadmin.profil');
            Route::get('/{uuid}/edit', 'edit')->name('superadmin.profil.edit');
            Route::put('/{uuid}/edit', 'update')->name('superadmin.profil.update');
            Route::get('/{uuid}/password', 'password')->name('superadmin.profil.password');
            Route::put('/{uuid}', 'update2')->name('superadmin.profil.update2');
        });

        Route::prefix('config')->controller(App\Http\Controllers\Private\SuperAdmin\ConfigController::class)->group(function () {
            Route::get('/', 'index')->name('superadmin.config');
            Route::get('/edit', 'edit')->name('superadmin.config.edit');
            Route::put('/edit', 'update')->name('superadmin.config.edit');
        });

        Route::prefix('management')->group(
            function () {
                Route::resource('/status', App\Http\Controllers\Private\SuperAdmin\UserStatusController::class)->scoped(['status' => 'slug']);

                Route::resource('/level', App\Http\Controllers\Private\SuperAdmin\UserLevelController::class)->scoped(['level' => 'slug']);

                Route::controller(App\Http\Controllers\Private\SuperAdmin\UserMenuController::class)->group(function () {
                    Route::resource('/menu', App\Http\Controllers\Private\SuperAdmin\UserMenuController::class)->scoped(['menu' => 'slug']);
                    Route::get('menu/{menu:slug}/create_sub', 'create_sub')->name('menu.create_sub');
                    Route::post('menu/{menu:slug}/create_sub', 'store_sub')->name('menu.create_sub');
                });

                Route::controller(App\Http\Controllers\Private\SuperAdmin\UserAccessController::class)->group(function () {
                    Route::resource('/access', App\Http\Controllers\Private\SuperAdmin\UserAccessController::class)->scoped(['access' => 'slug']);
                    Route::get('access/parent/{level}/{parent}/{order}', 'updateParent')->name('access.parent');
                    Route::get('access/child/{level}/{parent}/{child}/{order}', 'updateChild')->name('access.child');
                });

                Route::resource('/user', App\Http\Controllers\Private\SuperAdmin\UserController::class)->scoped(['user' => 'uuid']);
            }
        );

        // Route::prefix('master')->group(
        //     function () {
        //         Route::resource('/status', App\Http\Controllers\Private\SuperAdmin\UserStatusController::class)->scoped(['status' => 'slug']);

        //         Route::resource('/level', App\Http\Controllers\Private\SuperAdmin\UserLevelController::class)->scoped(['level' => 'slug']);

        //         Route::controller(App\Http\Controllers\Private\SuperAdmin\UserMenuController::class)->group(function () {
        //             Route::resource('/menu', App\Http\Controllers\Private\SuperAdmin\UserMenuController::class)->scoped(['menu' => 'slug']);
        //             Route::get('menu/{menu:slug}/create_sub', 'create_sub')->name('menu.create_sub');
        //             Route::post('menu/{menu:slug}/create_sub', 'store_sub')->name('menu.create_sub');
        //         });

        //         Route::controller(App\Http\Controllers\Private\SuperAdmin\UserAccessController::class)->group(function () {
        //             Route::resource('/access', App\Http\Controllers\Private\SuperAdmin\UserAccessController::class)->scoped(['access' => 'slug']);
        //             Route::get('access/parent/{level}/{parent}/{order}', 'updateParent')->name('access.parent');
        //             Route::get('access/child/{level}/{parent}/{child}/{order}', 'updateChild')->name('access.child');
        //         });

        //         Route::resource('/user', App\Http\Controllers\Private\SuperAdmin\UserController::class)->scoped(['user' => 'uuid']);
        //     }
        // );
    }
);



Route::prefix('admin')->middleware(['auth', 'isAdmin'])->controller()->group(
    function () {
        Route::get('/dashboard', [App\Http\Controllers\Private\DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('profil')->controller(App\Http\Controllers\Private\ProfilController::class)->group(function () {
            Route::get('/{uuid}', 'index')->name('admin.profil');
            Route::get('/{uuid}/edit', 'edit')->name('admin.profil.edit');
            Route::put('/{uuid}', 'update')->name('admin.profil.update');
            Route::get('/{uuid}/password', 'password')->name('admin.profil.password');
            Route::put('/{uuid}', 'update2')->name('admin.profil.update2');
        });

        Route::prefix('management')->group(
            function () {
                Route::resource('/status', App\Http\Controllers\Private\Admin\UserStatusController::class)->scoped(['status' => 'slug']);

                Route::resource('/level', App\Http\Controllers\Private\Admin\UserLevelController::class)->scoped(['level' => 'slug']);

                Route::controller(App\Http\Controllers\Private\Admin\UserMenuController::class)->group(function () {
                    Route::resource('/menu', App\Http\Controllers\Private\Admin\UserMenuController::class)->scoped(['menu' => 'slug']);
                    Route::get('menu/{menu:slug}/create_sub', 'create_sub')->name('menu.create_sub');
                    Route::post('menu/{menu:slug}/create_sub', 'store_sub')->name('menu.create_sub');
                });

                Route::controller(App\Http\Controllers\Private\Admin\UserAccessController::class)->group(function () {
                    Route::resource('/access', App\Http\Controllers\Private\Admin\UserAccessController::class)->scoped(['access' => 'slug']);
                    Route::get('access/parent/{level}/{parent}/{order}', 'updateParent')->name('access.parent');
                    Route::get('access/child/{level}/{parent}/{child}/{order}', 'updateChild')->name('access.child');
                });

                Route::resource('/user', App\Http\Controllers\Private\Admin\UserController::class)->scoped(['user' => 'uuid']);
            }
        );

        // Route::prefix('master')->group(
        //     function () {
        //         Route::resource('/status', App\Http\Controllers\Private\Admin\UserStatusController::class)->scoped(['status' => 'slug']);

        //         Route::resource('/level', App\Http\Controllers\Private\Admin\UserLevelController::class)->scoped(['level' => 'slug']);

        //         Route::controller(App\Http\Controllers\Private\Admin\UserMenuController::class)->group(function () {
        //             Route::resource('/menu', App\Http\Controllers\Private\Admin\UserMenuController::class)->scoped(['menu' => 'slug']);
        //             Route::get('menu/{menu:slug}/create_sub', 'create_sub')->name('menu.create_sub');
        //             Route::post('menu/{menu:slug}/create_sub', 'store_sub')->name('menu.create_sub');
        //         });

        //         Route::resource('/access', App\Http\Controllers\Private\Admin\UserAccessController::class)->scoped(['access' => 'slug']);
        //     }
        // );

        // Route::resource('/user', App\Http\Controllers\Private\Admin\UserController::class)->scoped(['user' => 'uuid']);
    }
);



Route::prefix('user')->middleware(['auth', 'isUser'])->group(
    function () {
        Route::prefix('profil')->controller(App\Http\Controllers\Private\ProfilController::class)->group(function () {
            Route::get('/{uuid}', 'index')->name('admin.profil');
            Route::get('/{uuid}/edit', 'edit')->name('admin.profil.edit');
            Route::put('/{uuid}', 'update')->name('admin.profil.update');
        });

        Route::get('/dashboard', [App\Http\Controllers\Private\DashboardController::class, 'index'])->name('user.dashboard');
    }
);
