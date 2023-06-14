<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Private\LoginController;
use App\Http\Controllers\Public\PublicController;

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
// Route::get('/', [PublicController::class, 'index'])->name('/');
Route::prefix('/')->controller(PublicController::class)->group(function () {
    Route::get('', 'index')->name('/');
    Route::get('/page/{id}', 'page')->name('page');
    Route::get('/post/{id}', 'post')->name('post');
    Route::get('/download', 'download')->name('download');
    Route::get('/download/{id}', 'downloadFile')->name('download.file');
});

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
