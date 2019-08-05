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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('chat')->name('client.chat.')->group(function () {
    Route::get('', 'Client\ChatController@index')->name('index');
    Route::post('/submit', 'Client\ChatController@submit')->name('submit');
});

Route::middleware('auth')->prefix('admin/chat')->name('admin.chat.')->group(function () {
    Route::get('', 'Admin\ChatController@index')->name('index');
    Route::post('/submit', 'Admin\ChatController@submit')->name('submit');
});
