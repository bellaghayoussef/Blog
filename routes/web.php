<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes();
Route::middleware('auth:web')->group(function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'prefix' => 'posts',
], function () {
    

    

    Route::post('/', 'App\Http\Controllers\PostsController@store')
         ->name('posts.post.store');
   
    Route::delete('/post/{post}','App\Http\Controllers\PostsController@destroy')
         ->name('posts.post.destroy')->where('id', '[0-9]+');
});


Route::group([
    'prefix' => 'commenters',
], function () {
    
    Route::post('/', 'App\Http\Controllers\CommentersController@store')
         ->name('commenters.commenter.store');

    Route::delete('/commenter/{commenter}','App\Http\Controllers\CommentersController@destroy')
         ->name('commenters.commenter.destroy')->where('id', '[0-9]+');
});
});
