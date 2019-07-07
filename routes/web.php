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

Route::get('/', function () {
    return view('app');
});

Route::get('/dashboard', function(){
    return view("backend.backend_index");
});

// Auth
Route::get('/be-login', function(){
    return "Please log in";
});

Route::post('/be-login', function(){
    return "Please log in";
});