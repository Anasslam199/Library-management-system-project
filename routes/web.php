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
Route::get('/','HomeController@index');
Route::get('/home/{id}/show/','HomeController@show');
Route::get('/home/books','HomeController@books');
Route::get('/home/borrows','HomeController@borrows');
Route::get('/home/profil','HomeController@membershow');
Route::delete('/home/delete','HomeController@reservationdelete');
Route::post('/home/empty_dates',"borrowController@empty_dates")->name("empty_dates");
Route::group(['middleware' => 'is_admin'], function () {
    Route::auth();
    Route::get('/dashboard', 'borrowController@dashboard');
    // Books
    Route::get('themes', 'bookController@themes');
    Route::post('themes/store', 'bookController@themeStore');
    Route::delete('themes/destroy', 'bookController@themeDestroy');
    Route::post('/themes/update', 'bookController@themeUpdate');


    Route::get('books/', 'bookController@index');
    Route::get('books/create/','bookController@create');
    Route::post('books', 'bookController@store');
    Route::get('books/{id}/edit/', 'bookController@edit');
    Route::put('books/{id}', 'bookController@update');
    Route::delete('books/{id}', 'bookController@destroy');
    Route::get("books/filter","bookController@filter");
    Route::get('books/{id}/show', 'bookController@show');
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
    Route::get('borrows/reservation', 'borrowController@reservation');
    Route::post('borrows/borrowing_Reservation', 'borrowController@borrowing_Reservation');
    Route::post('borrows/reserving', 'borrowController@reserving')->name("reserving");

    // Borrow test
    Route::get('borrows/{id}/reborrow','borrowController@reborrow');
    Route::get('borrows/{id}/return','borrowController@return');


    // DomPDF
    Route::get('members/generate-pdf','membersController@generatePDF');
    Route::get('books/generate-pdf','bookController@generatePDF');
    Route::get('borrows/generate-pdf','borrowController@generatePDF');

    Route::get('members/generate-pdf/{id}','membersController@generatePDF_Member');
});


// Localization
Route::get('locale/{locale}',array('as'=>'set-locale','uses'=>'AppController@setlocale'));


//this is only for test, remove it later
Route::get('/sendmail','membersController@sendMail');
Route::get('/test_Reservation','borrowController@test_Reservation')->name("test_Res");

















Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mylogin', function () {
    return view('mylogin');
});
