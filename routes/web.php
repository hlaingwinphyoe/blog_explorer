<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/',[PageController::class,'index'])->name('index');
Route::get('/detail/{slug}',[PageController::class,'detail'])->name('post.detail');
Route::get('job-test',[PageController::class,'jobTest']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('verified')->group(function (){
    Route::resource('/post',\App\Http\Controllers\PostController::class);
    Route::resource('/comment',\App\Http\Controllers\CommentController::class);
    Route::resource('/gallery',\App\Http\Controllers\GalleryController::class);
    Route::prefix('/user')->group(function (){
        Route::get('/edit-profile',[\App\Http\Controllers\HomeController::class,'editProfile'])->name('edit-profile');
        Route::post('/update-profile',[\App\Http\Controllers\HomeController::class,'updateProfile'])->name('update-profile');
        Route::get('/change-password',[\App\Http\Controllers\HomeController::class,'changePassword'])->name('change-password');
        Route::post('/update-password',[\App\Http\Controllers\HomeController::class,'updatePassword'])->name('update-password');
    });

});
