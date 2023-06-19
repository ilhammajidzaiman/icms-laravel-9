<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Private\ProfilController;
use App\Http\Controllers\Private\DashboardController;
use App\Http\Controllers\Private\Developer\Page\PageController;
use App\Http\Controllers\Private\Developer\Galery\GaleryController;
use App\Http\Controllers\Private\Developer\Archive\ArchiveController;
use App\Http\Controllers\Private\Developer\Blog\Post\BlogPostController;
use App\Http\Controllers\Private\Developer\Slideshow\SlideshowController;
use App\Http\Controllers\Private\Developer\NavMenu\NavMenuChildController;
use App\Http\Controllers\Private\Developer\NavMenu\NavMenuParentController;
use App\Http\Controllers\Private\Developer\Blog\Category\BlogCategoryController;

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
        Route::prefix('user')->middleware(['isUser'])->controller()->group(
            function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
                // 
                Route::prefix('profil')->controller(ProfilController::class)->group(function () {
                    Route::get('/{id}', 'index')->name('user.profil.index');
                    Route::get('/{id}/edit', 'edit')->name('user.profil.edit');
                    Route::put('/{id}/edit', 'update')->name('user.profil.update');
                    Route::get('/{id}/password-edit', 'passwordEdit')->name('user.profil.password.edit');
                    Route::put('/{id}/password-update', 'passwordUpdate')->name('user.profil.password.update');
                });
                // 
                Route::prefix('slideshow')->controller(SlideshowController::class)->group(function () {
                    Route::get('/', 'index')->name('user.slideshow.index');
                    Route::get('/create', 'create')->name('user.slideshow.create');
                    Route::post('/store', 'store')->name('user.slideshow.store');
                    Route::get('/{id}/show', 'show')->name('user.slideshow.show');
                    Route::get('/{id}/edit', 'edit')->name('user.slideshow.edit');
                    Route::put('/{id}/update', 'update')->name('user.slideshow.update');
                    Route::delete('/{id}/delete', 'destroy')->name('user.slideshow.delete');
                });
                // 
                Route::prefix('blog')->group(
                    function () {
                        Route::prefix('category')->controller(BlogCategoryController::class)->group(function () {
                            Route::get('/', 'index')->name('user.blog.category.index');
                            Route::get('/create', 'create')->name('user.blog.category.create');
                            Route::post('/store', 'store')->name('user.blog.category.store');
                            Route::get('/{id}/show', 'show')->name('user.blog.category.show');
                            Route::get('/{id}/edit', 'edit')->name('user.blog.category.edit');
                            Route::put('/{id}/update', 'update')->name('user.blog.category.update');
                            Route::delete('/{id}/delete', 'destroy')->name('user.blog.category.delete');
                        });
                        // 
                        Route::prefix('post')->controller(BlogPostController::class)->group(function () {
                            Route::get('/', 'index')->name('user.blog.post.index');
                            Route::get('/create', 'create')->name('user.blog.post.create');
                            Route::post('/store', 'store')->name('user.blog.post.store');
                            Route::get('/{id}/show', 'show')->name('user.blog.post.show');
                            Route::get('/{id}/edit', 'edit')->name('user.blog.post.edit');
                            Route::put('/{id}/update', 'update')->name('user.blog.post.update');
                            Route::delete('/{id}/delete', 'destroy')->name('user.blog.post.delete');
                        });
                    }
                );
                // 
                Route::prefix('page')->controller(PageController::class)->group(function () {
                    Route::get('/', 'index')->name('user.page.index');
                    Route::get('/create', 'create')->name('user.page.create');
                    Route::post('/store', 'store')->name('user.page.store');
                    Route::get('/{id}/show', 'show')->name('user.page.show');
                    Route::get('/{id}/edit', 'edit')->name('user.page.edit');
                    Route::put('/{id}/update', 'update')->name('user.page.update');
                    Route::delete('/{id}/delete', 'destroy')->name('user.page.delete');
                });
                // 
                Route::prefix('nav-menu')->controller(NavMenuParentController::class)->group(function () {
                    Route::get('/', 'index')->name('user.nav-menu.parent.index');
                    Route::get('/create', 'create')->name('user.nav-menu.parent.create');
                    Route::post('/store', 'store')->name('user.nav-menu.parent.store');
                    Route::get('/{id}/show', 'show')->name('user.nav-menu.parent.show');
                    Route::get('/{id}/edit', 'edit')->name('user.nav-menu.parent.edit');
                    Route::put('/{id}/update', 'update')->name('user.nav-menu.parent.update');
                    Route::delete('/{id}/delete', 'destroy')->name('user.nav-menu.parent.delete');
                    // 
                    Route::prefix('/child')->controller(NavMenuChildController::class)->group(function () {
                        Route::get('/create/{id}', 'create')->name('user.nav-menu.child.create');
                        Route::post('/store/{id}', 'store')->name('user.nav-menu.child.store');
                        Route::get('/{id}/show', 'show')->name('user.nav-menu.child.show');
                        Route::get('/{id}/edit', 'edit')->name('user.nav-menu.child.edit');
                        Route::put('/{id}/update', 'update')->name('user.nav-menu.child.update');
                        Route::delete('/{id}/delete', 'destroy')->name('user.nav-menu.child.delete');
                    });
                });
                // 
                Route::prefix('galery')->controller(GaleryController::class)->group(function () {
                    Route::get('/', 'index')->name('user.galery.index');
                    Route::get('/create', 'create')->name('user.galery.create');
                    Route::post('/store', 'store')->name('user.galery.store');
                    Route::get('/{id}/show', 'show')->name('user.galery.show');
                    Route::get('/{id}/edit', 'edit')->name('user.galery.edit');
                    Route::put('/{id}/update', 'update')->name('user.galery.update');
                    Route::delete('/{id}/delete', 'destroy')->name('user.galery.delete');
                });
                Route::prefix('archive')->controller(ArchiveController::class)->group(function () {
                    Route::get('/', 'index')->name('user.archive.index');
                    Route::get('/create', 'create')->name('user.archive.create');
                    Route::post('/store', 'store')->name('user.archive.store');
                    Route::get('/{id}/show', 'show')->name('user.archive.show');
                    Route::get('/{id}/edit', 'edit')->name('user.archive.edit');
                    Route::put('/{id}/update', 'update')->name('user.archive.update');
                    Route::delete('/{id}/delete', 'destroy')->name('user.archive.delete');
                });
            }
        );
    }
);
