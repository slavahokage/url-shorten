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

Route::get('/', 'LinkController@createShortLink')->name('create-short-link');

Route::post('/handle-new-link', 'LinkController@handleNewLink')->name('handle-new-link');

Route::get('/link/{id}', 'LinkController@redirectToOriginalLink')->name('short-link');

Route::get('/link/show-info/{id}', 'LinkController@showLinkInfo')->name('link-information');
