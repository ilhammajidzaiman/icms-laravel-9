<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Private\LoginController;
// 
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Private\ProfilController;
use App\Http\Controllers\Private\RegisterController;
use App\Http\Controllers\Private\DashboardController;

// management
use App\Http\Controllers\Private\Developer\Management\UserLevelController as DeveloperUserLevelController;
use App\Http\Controllers\Private\Developer\Management\UserStatusController as DeveloperUserStatusController;
use App\Http\Controllers\Private\Developer\Management\UserMenuParentController as DeveloperUserMenuParentController;
use App\Http\Controllers\Private\Developer\Management\UserMenuChildController as DeveloperUserMenuChildController;
use App\Http\Controllers\Private\Developer\Management\UserAccessController as DeveloperUserAccessController;
use App\Http\Controllers\Private\Developer\Management\UserController as DeveloperUserController;

// slideshow
use App\Http\Controllers\Private\Developer\SlideshowController as DeveloperSlideshowController;

// blog
use App\Http\Controllers\Private\Developer\Blog\BlogStatusController as DeveloperBlogStatusController;
use App\Http\Controllers\Private\Developer\Blog\BlogCategoryController as DeveloperBlogCategoryController;
use App\Http\Controllers\Private\Developer\Blog\BlogPostController as DeveloperBlogPostController;

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

// 
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
                Route::prefix('slideshow')->controller(DeveloperSlideshowController::class)->group(function () {
                    Route::get('/', 'index')->name('developer.slideshow.index');
                    Route::get('/create', 'create')->name('developer.slideshow.create');
                    Route::post('/store', 'store')->name('developer.slideshow.store');
                    Route::get('/{id}/show', 'show')->name('developer.slideshow.show');
                    Route::get('/{id}/edit', 'edit')->name('developer.slideshow.edit');
                    Route::put('/{id}/update', 'update')->name('developer.slideshow.update');
                    Route::delete('/{id}/delete', 'destroy')->name('developer.slideshow.delete');
                });
                // 
                Route::prefix('blog')->group(
                    function () {
                        Route::prefix('status')->controller(DeveloperBlogStatusController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.blog.status.index');
                            Route::get('/create', 'create')->name('developer.blog.status.create');
                            Route::post('/store', 'store')->name('developer.blog.status.store');
                            Route::get('/{id}/show', 'show')->name('developer.blog.status.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.blog.status.edit');
                            Route::put('/{id}/update', 'update')->name('developer.blog.status.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.blog.status.delete');
                        });
                        // 
                        Route::prefix('category')->controller(DeveloperBlogCategoryController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.blog.category.index');
                            Route::get('/create', 'create')->name('developer.blog.category.create');
                            Route::post('/store', 'store')->name('developer.blog.category.store');
                            Route::get('/{id}/show', 'show')->name('developer.blog.category.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.blog.category.edit');
                            Route::put('/{id}/update', 'update')->name('developer.blog.category.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.blog.category.delete');
                        });
                        // 
                        Route::prefix('post')->controller(DeveloperBlogPostController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.blog.post.index');
                            Route::get('/create', 'create')->name('developer.blog.post.create');
                            Route::post('/store', 'store')->name('developer.blog.post.store');
                            Route::get('/{id}/show', 'show')->name('developer.blog.post.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.blog.post.edit');
                            Route::put('/{id}/update', 'update')->name('developer.blog.post.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.blog.post.delete');
                        });
                    }
                );
                // 
            }
        );
    }
);
