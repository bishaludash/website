<?php

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

// Auth, Use controllers
Route::get('/be-login', 'BE\UserAuthController@index')->name('be.login');
Route::post('/be-login', 'BE\UserAuthController@login');
Route::get('/be-logout', 'BE\UserAuthController@logout')->name('be.logout');

Route::get('forgot-password', 'BE\UserAuthController@forgotPassword');
Route::post('recover-password', 'BE\UserAuthController@resetPassword');
Route::post('recover-link', 'BE\UserAuthController@recoverPasswordLink');

// TO make this home
Route::get('/', 'FE\HomeController@home')->name('home');

// Blog
Route::get('/blog', 'FE\HomeController@blogHome')->name('blog.home');
Route::get('/blog/{blog}', 'FE\HomeController@show')->name('blog.show');
Route::post('/blog/{blog}/comment', 'FE\HomeController@show');


// Place this into middleware
Route::get('dashboard', 'BE\DashboardController@index')->name('dashboard.home');

Route::get('dashboard/about-user', 'BE\DashboardController@aboutUser');
Route::get('dashboard/projects', 'BE\DashboardController@projects');
Route::get('dashboard/contact', 'BE\DashboardController@contact');

Route::resource('dashboard/blog', 'BE\BlogController');
Route::resource('dashboard/comments', 'BE\CommentController');

