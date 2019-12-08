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

// Home
Route::get('/', 'FE\HomeController@home')->name('home');
Route::get('about', 'FE\HomeController@aboutUser')->name('home.about');
Route::get('projects', 'FE\HomeController@projects')->name('home.projects');

// FE 
    // Blog
    Route::get('/blog', 'FE\BlogController@index')->name('blog.home');
    Route::get('/blog/{month}/{year}', 'FE\BlogController@getArchive')->name('blog.archive');

    // posts
    Route::get('/post/{post}', 'FE\BlogController@show')->name('post.show');
    Route::post('/post/{post}/comment', 'FE\BlogController@show');

    // categories
    Route::get('/category/{category}', 'FE\CategoryController@index')->name('cat.show');


// BE (Place this into middleware)
Route::group(['middleware' => ['checkAuth']], function () {
    Route::get('dashboard', 'BE\DashboardController@index')->name('dashboard.home');
    Route::get('dashboard/about-user/{user}', 'BE\AboutUserController@aboutUser')->name('about.user');
    Route::post('dashboard/about-user/{user}', 'BE\AboutUserController@storeAboutUser');


    Route::resource('dashboard/category', 'BE\CategoryController', ['except'=>['create','show']]);
    Route::get('dashboard/category/{category}/delete', 'BE\CategoryController@delete')->name('category.delete');

    Route::resource('dashboard/posts', 'BE\PostController');
    Route::get('dashboard/posts/{post}/{archive}/archive', 'BE\PostController@archive')->name('posts.archive');
    Route::post('dashboard/posts/{post}/{archive}/archive', 'BE\PostController@archivePost');
    Route::get('dashboard/posts/{post}/delete', 'BE\PostController@delete')->name('posts.delete');
});


// Route::resource('dashboard/comments', 'BE\CommentController');

