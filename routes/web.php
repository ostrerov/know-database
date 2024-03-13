<?php

use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\LandingController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Example Routes
Route::get('/', [LandingController::class, 'index'])->name('index');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});

Auth::routes();

Route::prefix('dashboard')->middleware('roles:Администратор,Редактор')->name('dashboard.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::prefix('users')->middleware('roles:Администратор')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('add', [UsersController::class, 'createUser'])->name('add');
    });
    Route::prefix('posts')->middleware('roles:Администратор,Редактор')->name('posts.')->group(function () {
        Route::get('/', [PostsController::class, 'index'])->name('index');
        Route::get('add', [PostsController::class, 'createPost'])->name('add');
        Route::post('image-post-upload', [PostsController::class, 'uploadImageForm'])->name('image-post-upload');
        Route::get('preview/{id}', [PostsController::class, 'showPreview'])->name('preview');
        Route::get('edit/{id}', [PostsController::class, 'editPost'])->name('edit');
    });
});
