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


// Books
// Route::get('books', 'bookController@index');
Route::get('books/', 'bookController@index');
Route::get('books/create/','bookController@create');
Route::post('books', 'bookController@store');
Route::get('books/{id}/edit/', 'bookController@edit');
Route::put('books/{id}', 'bookController@update');
Route::delete('books/{id}', 'bookController@destroy');
Route::get("books/filter","bookController@filter");
Route::get('books/{id}/show', 'bookController@show');

// Themes
Route::post('books/theme', 'bookController@theme');

// Members
Route::get('members', 'membersController@index');
Route::get('members/create','membersController@create');
Route::post('members', 'membersController@store');
Route::get('members/{id}/edit', 'membersController@edit');
Route::put('members/{id}', 'membersController@update');
Route::delete('members/{id}', 'membersController@destroy');
Route::get('members/{id}/show', 'membersController@show');
Route::get('members/sendmail/{id}', 'membersController@sendmail');

// Borrows
Route::get('borrows/', 'borrowController@index');
Route::get('borrows/memberdetail/{id}','borrowController@memberdetail');
Route::get('borrows/bookdetail/{id}/','borrowController@bookdetail');
Route::get('borrows/create/{id}','borrowController@create');
Route::post('borrows', 'borrowController@store');
Route::get('borrows/{id}/edit', 'borrowController@edit');
Route::put('borrows/{id}', 'borrowController@update');
Route::delete('borrows/{id}', 'borrowController@destroy');

// Borrow test
Route::get('borrows/{id}/reborrow','borrowController@reborrow');
Route::get('borrows/{id}/return','borrowController@return');

// Localization
Route::get('locale/{locale}',array('as'=>'set-locale','uses'=>'AppController@setlocale'));

// DomPDF
Route::get('members/generate-pdf','membersController@generatePDF');
Route::get('books/generate-pdf','bookController@generatePDF');
Route::get('borrows/generate-pdf','borrowController@generatePDF');

Route::get('members/generate-pdf/{id}','membersController@generatePDF_Member');
Route::get('/', 'borrowController@total');














Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mylogin', function () {
    return view('mylogin');
});
