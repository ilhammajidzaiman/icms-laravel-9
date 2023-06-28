<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Private\ProfilController;
use App\Http\Controllers\Private\DashboardController;
use App\Http\Controllers\Private\Developer\Page\PageController;
use App\Http\Controllers\Private\Developer\Galery\GaleryController;
use App\Http\Controllers\Private\Developer\Page\PageTrashController;
use App\Http\Controllers\Private\Developer\Archive\ArchiveController;
use App\Http\Controllers\Private\Developer\Blog\Post\BlogPostController;
use App\Http\Controllers\Private\Developer\Galery\GaleryTrashController;
use App\Http\Controllers\Private\Developer\Slideshow\SlideshowController;
use App\Http\Controllers\Private\Developer\Archive\ArchiveTrashController;
use App\Http\Controllers\Private\Developer\Management\User\UserController;
use App\Http\Controllers\Private\Developer\Blog\Status\BlogStatusController;
use App\Http\Controllers\Private\Developer\Blog\Post\BlogPostTrashController;
use App\Http\Controllers\Private\Developer\Slideshow\SlideshowTrashController;
use App\Http\Controllers\Private\Developer\Management\User\UserTrashController;
use App\Http\Controllers\Private\Developer\Blog\Category\BlogCategoryController;
use App\Http\Controllers\Private\Developer\Management\Level\UserLevelController;
use App\Http\Controllers\Private\Developer\NavMenu\Child\NavMenuChildController;
use App\Http\Controllers\Private\Developer\Blog\Status\BlogStatusTrashController;
use App\Http\Controllers\Private\Developer\Management\Access\UserAccessController;
use App\Http\Controllers\Private\Developer\Management\Status\UserStatusController;
use App\Http\Controllers\Private\Developer\NavMenu\Parent\NavMenuParentController;
use App\Http\Controllers\Private\Developer\Blog\Category\BlogCategoryTrashController;
use App\Http\Controllers\Private\Developer\Management\Level\UserLevelTrashController;
use App\Http\Controllers\Private\Developer\NavMenu\Child\NavMenuChildTrashController;
use App\Http\Controllers\Private\Developer\Management\Access\UserAccessTrashController;
use App\Http\Controllers\Private\Developer\Management\Status\UserStatusTrashController;
use App\Http\Controllers\Private\Developer\NavMenu\Parent\NavMenuParentTrashController;
use App\Http\Controllers\Private\Developer\Management\Menu\Child\UserMenuChildController;
use App\Http\Controllers\Private\Developer\Management\Menu\Parent\UserMenuParentController;
use App\Http\Controllers\Private\Developer\Management\Menu\Child\UserMenuChildTrashController;
use App\Http\Controllers\Private\Developer\Management\Menu\Parent\UserMenuParentTrashController;

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
        Route::prefix('developer')->middleware(['isDeveloper'])->controller()->group(
            function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('developer.dashboard');
                Route::prefix('profil')->controller(ProfilController::class)->group(function () {
                    Route::get('/{id}', 'index')->name('developer.profil.index');
                    Route::get('/{id}/edit', 'edit')->name('developer.profil.edit');
                    Route::put('/{id}/edit', 'update')->name('developer.profil.update');
                    Route::get('/{id}/password-edit', 'passwordEdit')->name('developer.profil.password.edit');
                    Route::put('/{id}/password-update', 'passwordUpdate')->name('developer.profil.password.update');
                });
                Route::prefix('management')->group(
                    function () {
                        Route::prefix('status')->controller(UserStatusController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.user.status.index');
                            Route::get('/create', 'create')->name('developer.management.user.status.create');
                            Route::post('/store', 'store')->name('developer.management.user.status.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.status.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.status.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.status.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.status.delete');
                            Route::prefix('trash')->controller(UserStatusTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.management.user.status.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.management.user.status.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.status.trash.delete');
                            });
                        });
                        Route::prefix('level')->controller(UserLevelController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.user.level.index');
                            Route::get('/create', 'create')->name('developer.management.user.level.create');
                            Route::post('/store', 'store')->name('developer.management.user.level.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.level.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.level.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.level.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.level.delete');
                            Route::prefix('trash')->controller(UserLevelTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.management.user.level.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.management.user.level.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.level.trash.delete');
                            });
                        });
                        Route::prefix('menu')->controller(UserMenuParentController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.user.menu.parent.index');
                            Route::get('/create', 'create')->name('developer.management.user.menu.parent.create');
                            Route::post('/store', 'store')->name('developer.management.user.menu.parent.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.menu.parent.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.menu.parent.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.menu.parent.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.menu.parent.delete');
                            Route::prefix('trash')->controller(UserMenuParentTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.management.user.menu.parent.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.management.user.menu.parent.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.menu.parent.trash.delete');
                            });
                        });
                        Route::prefix('menu/child')->controller(UserMenuChildController::class)->group(function () {
                            Route::get('/create/{id}', 'create')->name('developer.management.user.menu.child.create');
                            Route::post('/store/{id}', 'store')->name('developer.management.user.menu.child.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.menu.child.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.menu.child.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.menu.child.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.menu.child.delete');
                            Route::prefix('trash')->controller(UserMenuChildTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.management.user.menu.child.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.management.user.menu.child.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.menu.child.trash.delete');
                            });
                        });
                        Route::prefix('access')->controller(UserAccessController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.access.index');
                            Route::get('/{id}/show', 'show')->name('developer.management.access.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.access.edit');
                            Route::get('/parent/{level}/{parent}', 'updateParent')->name('developer.management.access.parent.update');
                            Route::get('/child/{level}/{parent}/{child}', 'updateChild')->name('developer.management.access.child.update');
                            Route::prefix('trash')->controller(UserAccessTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.management.access.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.management.access.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.management.access.trash.delete');
                            });
                        });
                        Route::prefix('user')->controller(UserController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.management.user.index');
                            Route::get('/create', 'create')->name('developer.management.user.create');
                            Route::post('/store', 'store')->name('developer.management.user.store');
                            Route::get('/{id}/show', 'show')->name('developer.management.user.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.management.user.edit');
                            Route::put('/{id}/update', 'update')->name('developer.management.user.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.delete');
                            Route::get('/{id}/password', 'password')->name('developer.management.user.password');
                            Route::put('/{id}/reset', 'reset')->name('developer.management.user.reset');
                            Route::prefix('trash')->controller(UserTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.management.user.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.management.user.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.management.user.trash.delete');
                            });
                        });
                    }
                );
                Route::prefix('slideshow')->controller(SlideshowController::class)->group(function () {
                    Route::get('/', 'index')->name('developer.slideshow.index');
                    Route::get('/create', 'create')->name('developer.slideshow.create');
                    Route::post('/store', 'store')->name('developer.slideshow.store');
                    Route::get('/{id}/show', 'show')->name('developer.slideshow.show');
                    Route::get('/{id}/edit', 'edit')->name('developer.slideshow.edit');
                    Route::put('/{id}/update', 'update')->name('developer.slideshow.update');
                    Route::delete('/{id}/delete', 'destroy')->name('developer.slideshow.delete');
                    Route::prefix('trash')->controller(SlideshowTrashController::class)->group(function () {
                        Route::get('', 'index')->name('developer.slideshow.trash.index');
                        Route::get('/{id}/restore', 'restore')->name('developer.slideshow.trash.restore');
                        Route::delete('/{id}/delete', 'destroy')->name('developer.slideshow.trash.delete');
                    });
                });
                Route::prefix('blog')->group(
                    function () {
                        Route::prefix('status')->controller(BlogStatusController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.blog.status.index');
                            Route::get('/create', 'create')->name('developer.blog.status.create');
                            Route::post('/store', 'store')->name('developer.blog.status.store');
                            Route::get('/{id}/show', 'show')->name('developer.blog.status.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.blog.status.edit');
                            Route::put('/{id}/update', 'update')->name('developer.blog.status.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.blog.status.delete');
                            Route::prefix('trash')->controller(BlogStatusTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.blog.status.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.blog.status.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.blog.status.trash.delete');
                            });
                        });
                        // 
                        Route::prefix('category')->controller(BlogCategoryController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.blog.category.index');
                            Route::get('/create', 'create')->name('developer.blog.category.create');
                            Route::post('/store', 'store')->name('developer.blog.category.store');
                            Route::get('/{id}/show', 'show')->name('developer.blog.category.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.blog.category.edit');
                            Route::put('/{id}/update', 'update')->name('developer.blog.category.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.blog.category.delete');
                            Route::prefix('trash')->controller(BlogCategoryTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.blog.category.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.blog.category.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.blog.category.trash.delete');
                            });
                        });
                        // 
                        Route::prefix('post')->controller(BlogPostController::class)->group(function () {
                            Route::get('/', 'index')->name('developer.blog.post.index');
                            Route::get('/create', 'create')->name('developer.blog.post.create');
                            Route::post('/store', 'store')->name('developer.blog.post.store');
                            Route::get('/{id}/show', 'show')->name('developer.blog.post.show');
                            Route::get('/{id}/edit', 'edit')->name('developer.blog.post.edit');
                            Route::put('/{id}/update', 'update')->name('developer.blog.post.update');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.blog.post.delete');
                            Route::prefix('trash')->controller(BlogPostTrashController::class)->group(function () {
                                Route::get('', 'index')->name('developer.blog.post.trash.index');
                                Route::get('/{id}/restore', 'restore')->name('developer.blog.post.trash.restore');
                                Route::delete('/{id}/delete', 'destroy')->name('developer.blog.post.trash.delete');
                            });
                        });
                    }
                );
                Route::prefix('page')->controller(PageController::class)->group(function () {
                    Route::get('/', 'index')->name('developer.page.index');
                    Route::get('/create', 'create')->name('developer.page.create');
                    Route::post('/store', 'store')->name('developer.page.store');
                    Route::get('/{id}/show', 'show')->name('developer.page.show');
                    Route::get('/{id}/edit', 'edit')->name('developer.page.edit');
                    Route::put('/{id}/update', 'update')->name('developer.page.update');
                    Route::delete('/{id}/delete', 'destroy')->name('developer.page.delete');
                    Route::prefix('trash')->controller(PageTrashController::class)->group(function () {
                        Route::get('', 'index')->name('developer.page.trash.index');
                        Route::get('/{id}/restore', 'restore')->name('developer.page.trash.restore');
                        Route::delete('/{id}/delete', 'destroy')->name('developer.page.trash.delete');
                    });
                });
                Route::prefix('nav-menu')->controller(NavMenuParentController::class)->group(function () {
                    Route::get('/', 'index')->name('developer.nav-menu.parent.index');
                    Route::get('/create', 'create')->name('developer.nav-menu.parent.create');
                    Route::post('/store', 'store')->name('developer.nav-menu.parent.store');
                    Route::get('/{id}/show', 'show')->name('developer.nav-menu.parent.show');
                    Route::get('/{id}/edit', 'edit')->name('developer.nav-menu.parent.edit');
                    Route::put('/{id}/update', 'update')->name('developer.nav-menu.parent.update');
                    Route::delete('/{id}/delete', 'destroy')->name('developer.nav-menu.parent.delete');
                    Route::prefix('trash')->controller(NavMenuParentTrashController::class)->group(function () {
                        Route::get('', 'index')->name('developer.nav-menu.parent.trash.index');
                        Route::get('/{id}/restore', 'restore')->name('developer.nav-menu.parent.trash.restore');
                        Route::delete('/{id}/delete', 'destroy')->name('developer.nav-menu.parent.trash.delete');
                    });

                    // 
                    Route::prefix('/child')->controller(NavMenuChildController::class)->group(function () {
                        Route::get('/create/{id}', 'create')->name('developer.nav-menu.child.create');
                        Route::post('/store/{id}', 'store')->name('developer.nav-menu.child.store');
                        Route::get('/{id}/show', 'show')->name('developer.nav-menu.child.show');
                        Route::get('/{id}/edit', 'edit')->name('developer.nav-menu.child.edit');
                        Route::put('/{id}/update', 'update')->name('developer.nav-menu.child.update');
                        Route::delete('/{id}/delete', 'destroy')->name('developer.nav-menu.child.delete');
                        Route::prefix('trash')->controller(NavMenuChildTrashController::class)->group(function () {
                            Route::get('', 'index')->name('developer.nav-menu.child.trash.index');
                            Route::get('/{id}/restore', 'restore')->name('developer.nav-menu.child.trash.restore');
                            Route::delete('/{id}/delete', 'destroy')->name('developer.nav-menu.child.trash.delete');
                        });
                    });
                });
                Route::prefix('galery')->controller(GaleryController::class)->group(function () {
                    Route::get('/', 'index')->name('developer.galery.index');
                    Route::get('/create', 'create')->name('developer.galery.create');
                    Route::post('/store', 'store')->name('developer.galery.store');
                    Route::get('/{id}/show', 'show')->name('developer.galery.show');
                    Route::get('/{id}/edit', 'edit')->name('developer.galery.edit');
                    Route::put('/{id}/update', 'update')->name('developer.galery.update');
                    Route::delete('/{id}/delete', 'destroy')->name('developer.galery.delete');
                    Route::prefix('trash')->controller(GaleryTrashController::class)->group(function () {
                        Route::get('', 'index')->name('developer.galery.trash.index');
                        Route::get('/{id}/restore', 'restore')->name('developer.galery.trash.restore');
                        Route::delete('/{id}/delete', 'destroy')->name('developer.galery.trash.delete');
                    });
                });
                Route::prefix('archive')->controller(ArchiveController::class)->group(function () {
                    Route::get('/', 'index')->name('developer.archive.index');
                    Route::get('/create', 'create')->name('developer.archive.create');
                    Route::post('/store', 'store')->name('developer.archive.store');
                    Route::get('/{id}/show', 'show')->name('developer.archive.show');
                    Route::get('/{id}/edit', 'edit')->name('developer.archive.edit');
                    Route::put('/{id}/update', 'update')->name('developer.archive.update');
                    Route::delete('/{id}/delete', 'destroy')->name('developer.archive.delete');
                    Route::prefix('trash')->controller(ArchiveTrashController::class)->group(function () {
                        Route::get('', 'index')->name('developer.archive.trash.index');
                        Route::get('/{id}/restore', 'restore')->name('developer.archive.trash.restore');
                        Route::delete('/{id}/delete', 'destroy')->name('developer.archive.trash.delete');
                    });
                });
            }
        );
    }
);
