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

Route::view('/', 'home');

Route::get('vuetify', 'VuetifyController@index')->name('vuetify.index');

Route::get('contact', 'ContactFormController@create')->name('contact.create');
Route::post('contact', 'ContactFormController@store')->name('contact.store');

Route::view('about', 'about')->middleware('test');
// Route::get('customers', 'CustomersController@index');
// Route::get('customers/create', 'CustomersController@create');
// Route::get('customers/{customer}', 'CustomersController@show');
// Route::get('customers/{customer}/edit', 'CustomersController@edit');
// Route::post('customers', 'CustomersController@store');
// Route::patch('customers/{customers}', 'CustomersController@update');
// Route::delete('customers/{customers}', 'CustomersController@destroy');

Route::resource('customers', 'CustomersController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
