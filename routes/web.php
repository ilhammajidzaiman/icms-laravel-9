<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
// 
use App\Http\Controllers\Private\LoginController;
use App\Http\Controllers\Private\ProfilController;
use App\Http\Controllers\Private\DashboardController;
// 
use App\Http\Controllers\Private\Admin\UserController as AdminUserController;
use App\Http\Controllers\Private\Admin\UserAccessController as AdminUserAccessController;
// 
use App\Http\Controllers\Private\Developer\UserController as DeveloperUserController;
use App\Http\Controllers\Private\Developer\UserLevelController as DeveloperUserLevelController;
use App\Http\Controllers\Private\Developer\UserAccessController as DeveloperUserAccessController;
use App\Http\Controllers\Private\Developer\UserStatusController as DeveloperUserStatusController;
use App\Http\Controllers\Private\Developer\UserMenuChildController as DeveloperUserMenuChildController;
use App\Http\Controllers\Private\Developer\UserMenuParentController as DeveloperUserMenuParentController;
use App\Http\Controllers\Private\Developer\BlogCategoryController as DeveloperBlogCategoryController;
use App\Http\Controllers\Private\Developer\BlogArticleController as DeveloperBlogArticleController;

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

Route::get('/', [App\Http\Controllers\Public\PublicController::class, 'index'])->name('/');

Route::get('/redirect', function () {
    $prefix = Str::replace(' ', '', Str::lower(auth()->user()->level->name));
    return redirect()->intended($prefix . '/dashboard');
});



Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login')->middleware('guest');
    Route::post('login', 'authenticate')->name('authenticate');
    Route::get('logout', 'logout')->name('logout');
    Route::post('logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(
    function () {
        Route::prefix('developer')->middleware(['isDeveloper'])->controller()->group(
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
                        Route::resource('/status', DeveloperUserStatusController::class)->scoped(['status' => 'slug']);
                        Route::resource('/level', DeveloperUserLevelController::class)->scoped(['level' => 'slug']);
                        Route::resource('/menu', DeveloperUserMenuParentController::class)->scoped(['menu' => 'uuid']);
                        Route::controller(DeveloperUserMenuChildController::class)->group(function () {
                            Route::get('menu/{menu:uuid}/show-sub', 'show')->name('show.sub');
                            Route::get('menu/{menu:uuid}/create-sub', 'create')->name('create.sub');
                            Route::post('menu/{menu:uuid}/create-sub', 'store')->name('create.sub');
                            Route::get('menu/{menu:uuid}/edit-sub', 'edit')->name('edit.sub');
                            Route::put('menu/{menu:uuid}/edit-sub', 'update')->name('edit.sub');
                            Route::delete('menu/{menu:uuid}/delete-sub', 'destroy')->name('delete.sub');
                        });
                        Route::controller(DeveloperUserAccessController::class)->group(function () {
                            Route::resource('/access', DeveloperUserAccessController::class)->scoped(['access' => 'slug']);
                            Route::get('access/parent/{level}/{parent}/{order}', 'updateParent')->name('access.parent');
                            Route::get('access/child/{level}/{parent}/{child}/{order}', 'updateChild')->name('access.child');
                        });
                        Route::resource('/user', DeveloperUserController::class)->scoped(['user' => 'uuid']);
                    }
                );

                Route::prefix('blog')->group(
                    function () {
                        Route::resource('/category', DeveloperBlogCategoryController::class)->scoped(['category' => 'slug']);
                        Route::resource('/post', DeveloperBlogArticleController::class)->scoped(['post' => 'slug']);
                    }
                );
            }
        );

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
