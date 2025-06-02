<?php

use App\Enums\RoleEnum;
use App\Http\Controllers;
use App\Http\Controllers\Private;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('root');

Route::middleware('auth', 'verified')->prefix('/admin')->group(function () {
    Route::get("/make-role", function () {
        try {
            Role::firstOrCreate(['name' => RoleEnum::SuperAdmin]);
            Role::firstOrCreate(['name' => RoleEnum::Admin]);
        } catch (\Exception $e) {
            Log::error('Error membuat role: ' . $e->getMessage());
        }
        return response()->json(['message' => 'Role berhasil buat!']);
    });

    Route::prefix('/dashboard')->controller(Controllers\Private\DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::prefix('/filepond')->controller(Controllers\FilepondController::class)->group(function () {
        Route::post('upload', 'upload')->name('filepond.upload');
    });

    Route::prefix('/profile')->controller(Controllers\ProfileController::class)->group(function () {
        Route::get('/', 'show')->name('profile.show');
        Route::get('/edit', 'edit')->name('profile.edit');
        Route::patch('/update', 'update')->name('profile.update');
        Route::delete('/delete', 'destroy')->name('profile.destroy');
    });


    Route::prefix('/blog')->group(function () {
        Route::prefix('/category')->controller(Private\Post\BlogCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('blog.category.index');
            Route::get('/create', 'create')->name('blog.category.create');
            Route::post('/store', 'store')->name('blog.category.store');
            Route::get('/{id}/show', 'show')->name('blog.category.show');
            Route::get('/{id}/edit', 'edit')->name('blog.category.edit');
            Route::put('/{id}/update', 'update')->name('blog.category.update');
            Route::delete('/{id}/delete', 'destroy')->name('blog.category.delete');
            Route::get('/trash', 'trash')->name('blog.category.trash');
            Route::get('/{id}/restore', 'restore')->name('blog.category.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('blog.category.forceDelete');
        });

        Route::prefix('/tag')->controller(Private\Post\BlogTagController::class)->group(function () {
            Route::get('/', 'index')->name('blog.tag.index');
            Route::get('/create', 'create')->name('blog.tag.create');
            Route::post('/store', 'store')->name('blog.tag.store');
            Route::get('/{id}/show', 'show')->name('blog.tag.show');
            Route::get('/{id}/edit', 'edit')->name('blog.tag.edit');
            Route::put('/{id}/update', 'update')->name('blog.tag.update');
            Route::delete('/{id}/delete', 'destroy')->name('blog.tag.delete');
            Route::get('/trash', 'trash')->name('blog.tag.trash');
            Route::get('/{id}/restore', 'restore')->name('blog.tag.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('blog.tag.forceDelete');
        });

        Route::prefix('/article')->controller(Private\Post\BlogArticleController::class)->group(function () {
            Route::get('/', 'index')->name('blog.article.index');
            Route::get('/create', 'create')->name('blog.article.create');
            Route::post('/store', 'store')->name('blog.article.store');
            Route::get('/{id}/show', 'show')->name('blog.article.show');
            Route::get('/{id}/edit', 'edit')->name('blog.article.edit');
            Route::put('/{id}/update', 'update')->name('blog.article.update');
            Route::delete('/{id}/delete', 'destroy')->name('blog.article.delete');
            Route::get('/trash', 'trash')->name('blog.article.trash');
            Route::get('/{id}/restore', 'restore')->name('blog.article.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('blog.article.forceDelete');
        });

        Route::prefix('/page')->controller(Private\Post\PageController::class)->group(function () {
            Route::get('/', 'index')->name('blog.page.index');
            Route::get('/create', 'create')->name('blog.page.create');
            Route::post('/store', 'store')->name('blog.page.store');
            Route::get('/{id}/show', 'show')->name('blog.page.show');
            Route::get('/{id}/edit', 'edit')->name('blog.page.edit');
            Route::put('/{id}/update', 'update')->name('blog.page.update');
            Route::delete('/{id}/delete', 'destroy')->name('blog.page.delete');
            Route::get('/trash', 'trash')->name('blog.page.trash');
            Route::get('/{id}/restore', 'restore')->name('blog.page.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('blog.page.forceDelete');
        });

        Route::prefix('/link')->controller(Private\Post\LinkController::class)->group(function () {
            Route::get('/', 'index')->name('blog.link.index');
            Route::get('/create', 'create')->name('blog.link.create');
            Route::post('/store', 'store')->name('blog.link.store');
            Route::get('/{id}/show', 'show')->name('blog.link.show');
            Route::get('/{id}/edit', 'edit')->name('blog.link.edit');
            Route::put('/{id}/update', 'update')->name('blog.link.update');
            Route::delete('/{id}/delete', 'destroy')->name('blog.link.delete');
            Route::get('/trash', 'trash')->name('blog.link.trash');
            Route::get('/{id}/restore', 'restore')->name('blog.link.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('blog.link.forceDelete');
        });
    });

    Route::prefix('/media')->group(function () {
        Route::prefix('/carousel')->controller(Private\Media\CarouselController::class)->group(function () {
            Route::get('/', 'index')->name('media.carousel.index');
            Route::get('/create', 'create')->name('media.carousel.create');
            Route::post('/store', 'store')->name('media.carousel.store');
            Route::get('/{id}/show', 'show')->name('media.carousel.show');
            Route::get('/{id}/edit', 'edit')->name('media.carousel.edit');
            Route::put('/{id}/update', 'update')->name('media.carousel.update');
            Route::delete('/{id}/delete', 'destroy')->name('media.carousel.delete');
            Route::get('/trash', 'trash')->name('media.carousel.trash');
            Route::get('/{id}/restore', 'restore')->name('media.carousel.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('media.carousel.forceDelete');
        });
        Route::prefix('/category')->controller(Private\Media\FileCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('media.category.index');
            Route::get('/create', 'create')->name('media.category.create');
            Route::post('/store', 'store')->name('media.category.store');
            Route::get('/{id}/show', 'show')->name('media.category.show');
            Route::get('/{id}/edit', 'edit')->name('media.category.edit');
            Route::put('/{id}/update', 'update')->name('media.category.update');
            Route::delete('/{id}/delete', 'destroy')->name('media.category.delete');
            Route::get('/trash', 'trash')->name('media.category.trash');
            Route::get('/{id}/restore', 'restore')->name('media.category.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('media.category.forceDelete');
        });
        Route::prefix('/file')->controller(Private\Media\FileController::class)->group(function () {
            Route::get('/', 'index')->name('media.file.index');
            Route::get('/create', 'create')->name('media.file.create');
            Route::post('/store', 'store')->name('media.file.store');
            Route::get('/{id}/show', 'show')->name('media.file.show');
            Route::get('/{id}/edit', 'edit')->name('media.file.edit');
            Route::put('/{id}/update', 'update')->name('media.file.update');
            Route::delete('/{id}/delete', 'destroy')->name('media.file.delete');
            Route::get('/trash', 'trash')->name('media.file.trash');
            Route::get('/{id}/restore', 'restore')->name('media.file.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('media.file.forceDelete');
        });
        Route::prefix('/image')->controller(Private\Media\ImageController::class)->group(function () {
            Route::get('/', 'index')->name('media.image.index');
            Route::get('/create', 'create')->name('media.image.create');
            Route::post('/store', 'store')->name('media.image.store');
            Route::get('/{id}/show', 'show')->name('media.image.show');
            Route::get('/{id}/edit', 'edit')->name('media.image.edit');
            Route::put('/{id}/update', 'update')->name('media.image.update');
            Route::delete('/{id}/delete', 'destroy')->name('media.image.delete');
            Route::get('/trash', 'trash')->name('media.image.trash');
            Route::get('/{id}/restore', 'restore')->name('media.image.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('media.image.forceDelete');
        });
        Route::prefix('/information')->controller(Private\Media\InformationController::class)->group(function () {
            Route::get('/', 'index')->name('media.information.index');
            Route::get('/create', 'create')->name('media.information.create');
            Route::post('/store', 'store')->name('media.information.store');
            Route::get('/{id}/show', 'show')->name('media.information.show');
            Route::get('/{id}/edit', 'edit')->name('media.information.edit');
            Route::put('/{id}/update', 'update')->name('media.information.update');
            Route::delete('/{id}/delete', 'destroy')->name('media.information.delete');
            Route::get('/trash', 'trash')->name('media.information.trash');
            Route::get('/{id}/restore', 'restore')->name('media.information.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('media.information.forceDelete');
        });
        Route::prefix('/video')->controller(Private\Media\VideoController::class)->group(function () {
            Route::get('/', 'index')->name('media.video.index');
            Route::get('/create', 'create')->name('media.video.create');
            Route::post('/store', 'store')->name('media.video.store');
            Route::get('/{id}/show', 'show')->name('media.video.show');
            Route::get('/{id}/edit', 'edit')->name('media.video.edit');
            Route::put('/{id}/update', 'update')->name('media.video.update');
            Route::delete('/{id}/delete', 'destroy')->name('media.video.delete');
            Route::get('/trash', 'trash')->name('media.video.trash');
            Route::get('/{id}/restore', 'restore')->name('media.video.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('media.video.forceDelete');
        });
    });

    Route::prefix('/feature')->group(function () {
        Route::prefix('/contacus')->controller(Private\Feature\ContacUsController::class)->group(function () {
            Route::get('/', 'index')->name('feature.contacus.index');
            Route::get('/create', 'create')->name('feature.contacus.create');
            Route::post('/store', 'store')->name('feature.contacus.store');
            Route::get('/{id}/show', 'show')->name('feature.contacus.show');
            Route::get('/{id}/edit', 'edit')->name('feature.contacus.edit');
            Route::put('/{id}/update', 'update')->name('feature.contacus.update');
            Route::delete('/{id}/delete', 'destroy')->name('feature.contacus.delete');
            Route::get('/trash', 'trash')->name('feature.contacus.trash');
            Route::get('/{id}/restore', 'restore')->name('feature.contacus.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('feature.contacus.forceDelete');
        });
        Route::prefix('/category')->controller(Private\Feature\FeedbackCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('feature.category.index');
            Route::get('/create', 'create')->name('feature.category.create');
            Route::post('/store', 'store')->name('feature.category.store');
            Route::get('/{id}/show', 'show')->name('feature.category.show');
            Route::get('/{id}/edit', 'edit')->name('feature.category.edit');
            Route::put('/{id}/update', 'update')->name('feature.category.update');
            Route::delete('/{id}/delete', 'destroy')->name('feature.category.delete');
            Route::get('/trash', 'trash')->name('feature.category.trash');
            Route::get('/{id}/restore', 'restore')->name('feature.category.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('feature.category.forceDelete');
        });
        Route::prefix('/feedback')->controller(Private\Feature\FeedbackController::class)->group(function () {
            Route::get('/', 'index')->name('feature.feedback.index');
            Route::get('/create', 'create')->name('feature.feedback.create');
            Route::post('/store', 'store')->name('feature.feedback.store');
            Route::get('/{id}/show', 'show')->name('feature.feedback.show');
            Route::get('/{id}/edit', 'edit')->name('feature.feedback.edit');
            Route::put('/{id}/update', 'update')->name('feature.feedback.update');
            Route::delete('/{id}/delete', 'destroy')->name('feature.feedback.delete');
            Route::get('/trash', 'trash')->name('feature.feedback.trash');
            Route::get('/{id}/restore', 'restore')->name('feature.feedback.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('feature.feedback.forceDelete');
        });
        Route::prefix('/position')->controller(Private\Feature\PeoplePositionController::class)->group(function () {
            Route::get('/', 'index')->name('feature.position.index');
            Route::get('/create', 'create')->name('feature.position.create');
            Route::post('/store', 'store')->name('feature.position.store');
            Route::get('/{id}/show', 'show')->name('feature.position.show');
            Route::get('/{id}/edit', 'edit')->name('feature.position.edit');
            Route::put('/{id}/update', 'update')->name('feature.position.update');
            Route::delete('/{id}/delete', 'destroy')->name('feature.position.delete');
            Route::get('/trash', 'trash')->name('feature.position.trash');
            Route::get('/{id}/restore', 'restore')->name('feature.position.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('feature.position.forceDelete');
        });
        Route::prefix('/people')->controller(Private\Feature\PeopleController::class)->group(function () {
            Route::get('/', 'index')->name('feature.people.index');
            Route::get('/create', 'create')->name('feature.people.create');
            Route::post('/store', 'store')->name('feature.people.store');
            Route::get('/{id}/show', 'show')->name('feature.people.show');
            Route::get('/{id}/edit', 'edit')->name('feature.people.edit');
            Route::put('/{id}/update', 'update')->name('feature.people.update');
            Route::delete('/{id}/delete', 'destroy')->name('feature.people.delete');
            Route::get('/trash', 'trash')->name('feature.people.trash');
            Route::get('/{id}/restore', 'restore')->name('feature.people.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('feature.people.forceDelete');
        });
    });

    Route::prefix('/setting')->group(function () {
        Route::prefix('/role')->controller(Private\Setting\RoleController::class)->group(function () {
            Route::get('/', 'index')->name('setting.role.index');
            Route::get('/create', 'create')->name('setting.role.create');
            Route::post('/store', 'store')->name('setting.role.store');
            Route::get('/{id}/show', 'show')->name('setting.role.show');
            Route::get('/{id}/edit', 'edit')->name('setting.role.edit');
            Route::put('/{id}/update', 'update')->name('setting.role.update');
            Route::delete('/{id}/delete', 'destroy')->name('setting.role.delete');
            Route::get('/trash', 'trash')->name('setting.role.trash');
            Route::get('/{id}/restore', 'restore')->name('setting.role.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('setting.role.forceDelete');
        });
        Route::prefix('/user')->controller(Controllers\UserController::class)->group(function () {
            Route::get('/', 'index')->name('setting.user.index');
            Route::get('/create', 'create')->name('setting.user.create');
            Route::post('/store', 'store')->name('setting.user.store');
            Route::get('/{id}/show', 'show')->name('setting.user.show');
            Route::get('/{id}/edit', 'edit')->name('setting.user.edit');
            Route::put('/{id}/update', 'update')->name('setting.user.update');
            Route::delete('/{id}/delete', 'destroy')->name('setting.user.delete');
            Route::get('/trash', 'trash')->name('setting.user.trash');
            Route::get('/{id}/restore', 'restore')->name('setting.user.restore');
            Route::delete('/{id}/force-delete', 'forceDelete')->name('setting.user.forceDelete');
            Route::get('/{id}/password', 'password')->name('setting.user.password');
            Route::put('/{id}/reset', 'reset')->name('setting.user.reset');
        });

        Route::prefix('/site')->controller(Private\Setting\SiteController::class)->group(function () {
            Route::get('/', 'index')->name('setting.site.index');
        });
    });
});

require __DIR__ . '/auth.php';
