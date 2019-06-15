<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@welcomePage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'books'], function () {
    Route::get('', 'BooksController@index')->name('books.list');
    Route::get('create', 'BooksController@create')->name('book.create');
    Route::post('', 'BooksController@store')->name('book.store');
    Route::get('{id}', 'BooksController@show')->name('book.show');
    Route::get('{id}/edit', 'BooksController@edit')->name('book.edit');
    Route::put('{id}', 'BooksController@update')->name('book.update');
    Route::delete('{id}', 'BooksController@destroy')->name('book.destroy');
});



Route::group(['prefix' => 'authors'], function () {
    Route::get('', 'AuthorsController@index')->name('authors.list');
    Route::get('create', 'AuthorsController@create')->name('author.create');
    Route::post('', 'AuthorsController@store')->name('author.store');
    Route::get('{id}', 'AuthorsController@show')->name('author.show');
    Route::get('{id}/edit', 'AuthorsController@edit')->name('author.edit');
    Route::put('{id}', 'AuthorsController@update')->name('author.update');
    Route::delete('{id}', 'AuthorsController@destroy')->name('author.destroy');
});
