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
Route::post('search/post', 'FE\BlogController@searchPostView')->name('post.search');

// categories
Route::get('/category/{category}', 'FE\CategoryController@index', ['except' => ['create', 'show']])->name('cat.show');

// BE (middleware)
Route::group(['middleware' => ['checkAuth'], 'prefix' => 'dashboard'], function () {
    Route::get('/', 'BE\DashboardController@index')->name('dashboard.home');
    Route::get('about-user/{user}', 'BE\AboutUserController@aboutUser')->name('about.user');
    Route::post('about-user/{user}', 'BE\AboutUserController@updateAboutUser');


    Route::resource('category', 'BE\CategoryController', ['except' => ['create', 'show']]);
    Route::get('category/{category}/delete', 'BE\CategoryController@delete')->name('category.delete');

    Route::resource('posts', 'BE\PostController');
    Route::get('posts/{post}/{archive}/archive', 'BE\PostController@archive')->name('posts.archive');
    Route::post('posts/{post}/{archive}/archive', 'BE\PostController@archivePost');
    Route::get('posts/{post}/delete', 'BE\PostController@delete')->name('posts.delete');

    Route::resource('projects', 'BE\ProjectsController');
    Route::get('projects/{project}/delete', 'BE\ProjectsController@delete')->name('projects.delete');

    Route::resource('filemanager', 'BE\FileController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    Route::get('filemanager/{file}/delete', 'BE\FileController@delete')->name('file.delete');
    Route::post('filemanager/destroy', 'BE\FileController@destroy')->name('file.destroy');
});



// Resume Maker
Route::group(['namespace' => 'Resume'], function () {
    Route::get('resume-builder', 'ResumeController@index')->name('resume.home');
    Route::get('resume-builder/build', 'ResumeController@build')->name('resume.build');
    Route::post('resume-builder/build', 'ResumeController@saveBuild')->name('resume.save');
    Route::get('resume-builder/theme', 'ResumeController@showThemes')->name('resume.theme');
    Route::get('resume-builder/theme/{theme}', 'ResumeController@pickTheme')->name('pick.theme');
    Route::get('resume-generate', 'ResumeController@generate')->name('resume.generate');
    Route::get('resume-builder/search', 'ResumeController@searchGeneratedResume')->name('resume.search');

    // Resume Edit
    Route::get('resume-builder/edit/{uuid}', 'ResumeEditController@showEditPage')->name('resume.edit');
    Route::post('resume-builder/edit/{resumeid}', 'ResumeEditController@updateResume');
    Route::get('resume-builder/{uuid}/softDelete/{typeid}', 'ResumeEditController@softDeleteItem')->name('resume.softDelete');
});
