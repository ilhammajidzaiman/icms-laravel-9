<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Private\ProfilController;
use App\Http\Controllers\Private\DashboardController;
use App\Http\Controllers\Private\Developer\ArchiveController;
use App\Http\Controllers\Private\Developer\GaleryController;
use App\Http\Controllers\Private\Developer\NavMenu\NavMenuChildController;
use App\Http\Controllers\Private\Developer\NavMenu\NavMenuParentController;
use App\Http\Controllers\Private\Developer\PageController;
use App\Http\Controllers\Private\Developer\Blog\BlogPostController;
use App\Http\Controllers\Private\Developer\Blog\BlogCategoryController;
use App\Http\Controllers\Private\Developer\SlideshowController;
use App\Http\Controllers\Private\Developer\Management\UserController;
use App\Http\Controllers\Private\Developer\Management\UserAccessController;

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

Route::middleware('auth')->group(
    function () {
        Route::prefix('admin')->middleware(['isAdmin'])->controller()->group(
            function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
                // 
                Route::prefix('profil')->controller(ProfilController::class)->group(function () {
                    Route::get('/{id}', 'index')->name('admin.profil.index');
                    Route::get('/{id}/edit', 'edit')->name('admin.profil.edit');
                    Route::put('/{id}/edit', 'update')->name('admin.profil.update');
                    Route::get('/{id}/password-edit', 'passwordEdit')->name('admin.profil.password.edit');
                    Route::put('/{id}/password-update', 'passwordUpdate')->name('admin.profil.password.update');
                });
                // 
                Route::prefix('management')->group(
                    function () {
                        Route::prefix('access')->controller(UserAccessController::class)->group(function () {
                            Route::get('/', 'index')->name('admin.management.access.index');
                            Route::get('/{id}/show', 'show')->name('admin.management.access.show');
                            Route::get('/{id}/edit', 'edit')->name('admin.management.access.edit');
                            Route::get('/parent/{level}/{parent}', 'updateParent')->name('admin.management.access.parent.update');
                            Route::get('/child/{level}/{parent}/{child}', 'updateChild')->name('admin.management.access.child.update');
                        });
                        // 
                        Route::prefix('user')->controller(UserController::class)->group(function () {
                            Route::get('/', 'index')->name('admin.management.user.index');
                            Route::get('/create', 'create')->name('admin.management.user.create');
                            Route::post('/store', 'store')->name('admin.management.user.store');
                            Route::get('/{id}/show', 'show')->name('admin.management.user.show');
                            Route::get('/{id}/edit', 'edit')->name('admin.management.user.edit');
                            Route::put('/{id}/update', 'update')->name('admin.management.user.update');
                            Route::delete('/{id}/delete', 'destroy')->name('admin.management.user.delete');
                        });
                    }
                );
                // 
                Route::prefix('slideshow')->controller(SlideshowController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.slideshow.index');
                    Route::get('/create', 'create')->name('admin.slideshow.create');
                    Route::post('/store', 'store')->name('admin.slideshow.store');
                    Route::get('/{id}/show', 'show')->name('admin.slideshow.show');
                    Route::get('/{id}/edit', 'edit')->name('admin.slideshow.edit');
                    Route::put('/{id}/update', 'update')->name('admin.slideshow.update');
                    Route::delete('/{id}/delete', 'destroy')->name('admin.slideshow.delete');
                });
                // 
                Route::prefix('blog')->group(
                    function () {
                        Route::prefix('category')->controller(BlogCategoryController::class)->group(function () {
                            Route::get('/', 'index')->name('admin.blog.category.index');
                            Route::get('/create', 'create')->name('admin.blog.category.create');
                            Route::post('/store', 'store')->name('admin.blog.category.store');
                            Route::get('/{id}/show', 'show')->name('admin.blog.category.show');
                            Route::get('/{id}/edit', 'edit')->name('admin.blog.category.edit');
                            Route::put('/{id}/update', 'update')->name('admin.blog.category.update');
                            Route::delete('/{id}/delete', 'destroy')->name('admin.blog.category.delete');
                        });
                        // 
                        Route::prefix('post')->controller(BlogPostController::class)->group(function () {
                            Route::get('/', 'index')->name('admin.blog.post.index');
                            Route::get('/create', 'create')->name('admin.blog.post.create');
                            Route::post('/store', 'store')->name('admin.blog.post.store');
                            Route::get('/{id}/show', 'show')->name('admin.blog.post.show');
                            Route::get('/{id}/edit', 'edit')->name('admin.blog.post.edit');
                            Route::put('/{id}/update', 'update')->name('admin.blog.post.update');
                            Route::delete('/{id}/delete', 'destroy')->name('admin.blog.post.delete');
                        });
                    }
                );
                // 
                Route::prefix('page')->controller(PageController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.page.index');
                    Route::get('/create', 'create')->name('admin.page.create');
                    Route::post('/store', 'store')->name('admin.page.store');
                    Route::get('/{id}/show', 'show')->name('admin.page.show');
                    Route::get('/{id}/edit', 'edit')->name('admin.page.edit');
                    Route::put('/{id}/update', 'update')->name('admin.page.update');
                    Route::delete('/{id}/delete', 'destroy')->name('admin.page.delete');
                });
                // 
                Route::prefix('nav-menu')->controller(NavMenuParentController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.nav-menu.parent.index');
                    Route::get('/create', 'create')->name('admin.nav-menu.parent.create');
                    Route::post('/store', 'store')->name('admin.nav-menu.parent.store');
                    Route::get('/{id}/show', 'show')->name('admin.nav-menu.parent.show');
                    Route::get('/{id}/edit', 'edit')->name('admin.nav-menu.parent.edit');
                    Route::put('/{id}/update', 'update')->name('admin.nav-menu.parent.update');
                    Route::delete('/{id}/delete', 'destroy')->name('admin.nav-menu.parent.delete');
                    // 
                    Route::prefix('/child')->controller(NavMenuChildController::class)->group(function () {
                        Route::get('/create/{id}', 'create')->name('admin.nav-menu.child.create');
                        Route::post('/store/{id}', 'store')->name('admin.nav-menu.child.store');
                        Route::get('/{id}/show', 'show')->name('admin.nav-menu.child.show');
                        Route::get('/{id}/edit', 'edit')->name('admin.nav-menu.child.edit');
                        Route::put('/{id}/update', 'update')->name('admin.nav-menu.child.update');
                        Route::delete('/{id}/delete', 'destroy')->name('admin.nav-menu.child.delete');
                    });
                });
                // 
                Route::prefix('galery')->controller(GaleryController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.galery.index');
                    Route::get('/create', 'create')->name('admin.galery.create');
                    Route::post('/store', 'store')->name('admin.galery.store');
                    Route::get('/{id}/show', 'show')->name('admin.galery.show');
                    Route::get('/{id}/edit', 'edit')->name('admin.galery.edit');
                    Route::put('/{id}/update', 'update')->name('admin.galery.update');
                    Route::delete('/{id}/delete', 'destroy')->name('admin.galery.delete');
                });
                Route::prefix('archive')->controller(ArchiveController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.archive.index');
                    Route::get('/create', 'create')->name('admin.archive.create');
                    Route::post('/store', 'store')->name('admin.archive.store');
                    Route::get('/{id}/show', 'show')->name('admin.archive.show');
                    Route::get('/{id}/edit', 'edit')->name('admin.archive.edit');
                    Route::put('/{id}/update', 'update')->name('admin.archive.update');
                    Route::delete('/{id}/delete', 'destroy')->name('admin.archive.delete');
                });
            }
        );
    }
);
