<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
// 
use App\Http\Controllers\Private\LoginController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Private\ProfilController;
// 
use App\Http\Controllers\Private\DashboardController;
// 
use App\Http\Controllers\Private\Developer\UserController as DeveloperUserController;
use App\Http\Controllers\Private\Developer\UserLevelController as DeveloperUserLevelController;
use App\Http\Controllers\Private\Developer\UserAccessController as DeveloperUserAccessController;
use App\Http\Controllers\Private\Developer\UserStatusController as DeveloperUserStatusController;
use App\Http\Controllers\Private\Developer\UserMenuChildController as DeveloperUserMenuChildController;
use App\Http\Controllers\Private\Developer\UserMenuParentController as DeveloperUserMenuParentController;
use App\Http\Controllers\Private\Developer\BlogArticleController as DeveloperBlogArticleController;
use App\Http\Controllers\Private\Developer\BlogCategoryController as DeveloperBlogCategoryController;
// 
use App\Http\Controllers\Private\Admin\UserController as AdminUserController;
use App\Http\Controllers\Private\Admin\UserAccessController as AdminUserAccessController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

// 
Route::get('/', [PublicController::class, 'index'])->name('/');

// 
Route::get('/redirect', function () {
    $level = Str::replace(' ', '', Str::lower(auth()->user()->level->name));
    return redirect()->intended($level . '/dashboard');
});

// 
Route::prefix('auth')->controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('auth.login')->middleware('guest');
    Route::post('/login', 'authenticate')->name('auth.authenticate')->middleware('guest');
    Route::get('/logout', 'logout')->name('auth.logout');
    Route::post('/logout', 'logout')->name('auth.signout');
});



Route::middleware('auth')->group(
    function () {
        Route::prefix('developer')->middleware(['isDeveloper'])->controller()->group(
            function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('developer.dashboard');
                // 
                Route::prefix('profil')->controller(ProfilController::class)->group(function () {
                    Route::get('/{id}', 'index')->name('developer.profil.index');
                    Route::get('/{id}/edit', 'edit')->name('developer.profil.edit');
                    Route::put('/{id}/edit', 'update')->name('developer.profil.update');
                    Route::get('/{id}/password-edit', 'passwordEdit')->name('developer.profil.password.edit');
                    Route::put('/{id}/password-update', 'passwordUpdate')->name('developer.profil.password.update');
                });
                // 
                Route::prefix('management')->group(
                    function () {
                        Route::prefix('status')->controller(DeveloperUserStatusController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.user.status.index');
                            Route::get('/create', 'create')->name('developer.management.user.status.create');
                            Route::post('/store', 'store')->name('developer.management.user.status.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.status.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.status.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.status.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.status.delete');
                        });
                        // 
                        Route::prefix('level')->controller(DeveloperUserLevelController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.user.level.index');
                            Route::get('/create', 'create')->name('developer.management.user.level.create');
                            Route::post('/store', 'store')->name('developer.management.user.level.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.level.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.level.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.level.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.level.delete');
                        });
                        // 
                        Route::prefix('menu')->controller(DeveloperUserMenuParentController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.user.menu.parent.index');
                            Route::get('/create', 'create')->name('developer.management.user.menu.parent.create');
                            Route::post('/store', 'store')->name('developer.management.user.menu.parent.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.menu.parent.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.menu.parent.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.menu.parent.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.menu.parent.delete');
                        });
                        // 
                        Route::prefix('menu/child')->controller(DeveloperUserMenuChildController::class)->group(function () {
                            Route::get('/create/{id}', 'create')->name('developer.management.user.menu.child.create');
                            Route::post('/store/{id}', 'store')->name('developer.management.user.menu.child.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.menu.child.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.menu.child.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.menu.child.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.menu.child.delete');
                        });
                        // 
                        Route::prefix('access')->controller(DeveloperUserAccessController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.access.index');
                            Route::get('/{id}/show', 'show')->name('developer.management.access.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.access.edit');
                            Route::get('/parent/{level}/{parent}', 'updateParent')->name('developer.management.access.parent.update');
                            Route::get('/child/{level}/{parent}/{child}', 'updateChild')->name('developer.management.access.child.update');
                        });
                        // 
                        Route::prefix('user')->controller(DeveloperUserController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.user.index');
                            Route::get('/create', 'create')->name('developer.management.user.create');
                            Route::post('/store', 'store')->name('developer.management.user.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.delete');
                        });
                    }
                );
                // 
            }
        );
        // Route::prefix('developer')->middleware(['isDeveloper'])->controller()->group(
        //     function () {
        //         Route::get('/dashboard', [DashboardController::class, 'index'])->name('developer.dashboard');
        //         Route::prefix('profil')->controller(ProfilController::class)->group(function () {
        //             Route::get('/{uuid}', 'index')->name('developer.profil');
        //             Route::get('/{uuid}/edit', 'edit')->name('developer.profil.edit');
        //             Route::put('/{uuid}/edit', 'update')->name('developer.profil.update');
        //             Route::get('/{uuid}/password', 'password')->name('developer.profil.password');
        //             Route::put('/{uuid}', 'update2')->name('developer.profil.update2');
        //         });
        //         Route::prefix('management')->group(
        //             function () {
        //                 Route::resource('/status', DeveloperUserStatusController::class)->scoped(['status' => 'slug']);
        //                 Route::resource('/level', DeveloperUserLevelController::class)->scoped(['level' => 'slug']);
        //                 Route::resource('/menu', DeveloperUserMenuParentController::class)->scoped(['menu' => 'uuid']);
        //                 Route::controller(DeveloperUserMenuChildController::class)->group(function () {
        //                     Route::get('menu/{menu:uuid}/show-sub', 'show')->name('show.sub');
        //                     Route::get('menu/{menu:uuid}/create-sub', 'create')->name('create.sub');
        //                     Route::post('menu/{menu:uuid}/create-sub', 'store')->name('create.sub');
        //                     Route::get('menu/{menu:uuid}/edit-sub', 'edit')->name('edit.sub');
        //                     Route::put('menu/{menu:uuid}/edit-sub', 'update')->name('edit.sub');
        //                     Route::delete('menu/{menu:uuid}/delete-sub', 'destroy')->name('delete.sub');
        //                 });
        //                 Route::controller(DeveloperUserAccessController::class)->group(function () {
        //                     Route::resource('/access', DeveloperUserAccessController::class)->scoped(['access' => 'slug']);
        //                     Route::get('access/parent/{level}/{parent}/{order}', 'updateParent')->name('access.parent');
        //                     Route::get('access/child/{level}/{parent}/{child}/{order}', 'updateChild')->name('access.child');
        //                 });
        //                 Route::resource('/user', DeveloperUserController::class)->scoped(['user' => 'uuid']);
        //             }
        //         );

        //         Route::prefix('blog')->group(
        //             function () {
        //                 Route::resource('/category', DeveloperBlogCategoryController::class)->scoped(['category' => 'slug']);
        //                 Route::resource('/post', DeveloperBlogArticleController::class)->scoped(['post' => 'slug']);
        //             }
        //         );
        //     }
        // );

        Route::prefix('admin')->middleware(['isAdmin'])->controller()->group(
            function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('developer.dashboard');
                Route::prefix('profil')->controller(ProfilController::class)->group(function () {
                    Route::get('/{uuid}', 'index')->name('developer.profil');
                    Route::get('/{uuid}/edit', 'edit')->name('developer.profil.edit');
                    Route::put('/{uuid}/edit', 'update')->name('developer.profil.update');
                    Route::get('/{uuid}/password', 'password')->name('developer.profil.password');
                    Route::put('/{uuid}', 'update2')->name('developer.profil.update2');
                });
                Route::prefix('management')->group(
                    function () {
                        Route::controller(AdminUserAccessController::class)->group(function () {
                            Route::resource('/access', AdminUserAccessController::class)->scoped(['access' => 'slug']);
                            Route::get('access/parent/{level}/{parent}/{order}', 'updateParent')->name('access.parent');
                            Route::get('access/child/{level}/{parent}/{child}/{order}', 'updateChild')->name('access.child');
                        });
                        Route::resource('/user', AdminUserController::class)->scoped(['user' => 'uuid']);
                    }
                );
            }
        );

        Route::prefix('user')->middleware(['isUser'])->controller()->group(
            function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('developer.dashboard');
                Route::prefix('profil')->controller(ProfilController::class)->group(function () {
                    Route::get('/{uuid}', 'index')->name('developer.profil');
                    Route::get('/{uuid}/edit', 'edit')->name('developer.profil.edit');
                    Route::put('/{uuid}/edit', 'update')->name('developer.profil.update');
                    Route::get('/{uuid}/password', 'password')->name('developer.profil.password');
                    Route::put('/{uuid}', 'update2')->name('developer.profil.update2');
                });
            }
        );
    }
);
