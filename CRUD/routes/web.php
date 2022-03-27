<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\GoogleLoginController;
use Laravel\Socialite\Facades\Socialite;
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
});

Route::get('/posts',[PostController::class,"index"])->name('posts')->middleware("auth");
// Route::post('/posts',[PostController::class,"index"])->name('posts')->middleware("auth");

Route::get('/posts/view/{post}',[PostController::class,"show"])->middleware("auth");

Route::get('/posts/edit/{post}',[PostController::class,"edit"])->middleware("auth");
Route::post('/posts/update/{id}',[PostController::class,"update"])->name('update')->middleware("auth");



Route::get('/posts/add/',[PostController::class,"add"])->middleware("auth");
Route::post('/posts/add',[PostController::class,"insert"])->middleware("auth");

Route::get('/posts/delete/{id}',[PostController::class,"del"])->middleware("auth");

Route::get('/posts/userposts/{id}',[UserController::class,"userposts"])->name('all');
// Route::get('/view'.[PostController::class, 'show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// 92536170504-uk4vq1fqsdfvj8hbnk4hcjm966rneg4v.apps.googleusercontent.com
// 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


//sociallite

// Route::get('http://localhost/CRUD/CRUD/public/posts/auth/redirect', function () {
//     dd('hi');
//     return Socialite::driver('github')->redirect();
// });
 
// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('github')->user();
//     dd($user);
//     // $user->token
// });

// sociallite with controller
Route::get('/posts/auth/redirect',[AuthController::class,"go"]);
// Route::get('/posts/auth/callback',[AuthController::class,"rego"]);

//google 
// Route::get('/google',function(){

//     return view('googleAuth');
    
// });

Route::get('/posts/auth/google', [AuthController::class,"redirectToGoogle"]);
Route::get('/posts/auth/google/callback', [AuthController::class,"handleGoogleCallback"]);