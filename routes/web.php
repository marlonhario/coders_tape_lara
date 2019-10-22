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

Route::get('relational/onetoone', function() {
	// $user = factory(\App\User::class)->create();
	// $phone = new \App\Phone();
	// $phone->phone = '123-123-1234';
	// $user->phone()->save($phone);


	// Shortway ==============
	$user = factory(\App\User::class)->create(); 
	$user->phone()->create([
		'phone' => '222-333-4567'
	]);
})->name('relational.onetoone');


Route::get('relational/onetomany', function() {
	// //long run =============
	// $user = factory(\App\User::class)->create();
	// $post = new \App\Post([
	// 	'title' => 'Title here',
	// 	'body' => 'Body here',
	// 	'user_id' => $user->id
	// ]);
	// $post->save();
	// dd($post);

	// short run ===========
	$user = factory(\App\User::class)->create();
	$user->posts()->create([
		'title' => 'Title here',
		'body' => 'Body here',
	]);
			// // short update relation ===============
			// $user->posts->first()->title = 'New Title';
			// $user->posts->first()->body = 'New Body';
			// $user->push();
			// long update relation ===============
			$posts = $user->post->first();
			$posts->title = 'New 123';
			$posts->body = 'New 123';
			$posts->save();

	dd($user->posts);

})->name('relational.onetomany');


Route::get('relational/manytomany', function () {
	$user = \App\User::first();
	// $roles = \App\Role::all();
	// $roles = \App\Role::first();
	$user->roles()->sync([1,2,4]);
	$user->roles()->syncWithoutDetaching([3]);
	// $user->roles()->attach($roles);
	// $user->roles()->detach($roles);
	// dd($roles);


	// ================flip way
	$role = \App\Role::find(4);
	$role->users()->sync([5]);
})->name('relational.manytomany');


Route::get('contact', 'ContactFormController@create')->name('contact.create');
Route::post('contact', 'ContactFormController@store')->name('contact.store');

Route::view('about', 'about')->middleware('test');
Route::get('customers', 'CustomersController@index')->name('customers.index');
Route::get('customers/create', 'CustomersController@create')->name('customers.create');
Route::get('customers/{customer}', 'CustomersController@show')->middleware('can:view,customer');
Route::get('customers/{customer}/edit', 'CustomersController@edit')->name('customers.edit');
Route::post('customers', 'CustomersController@store')->name('customers.store');
Route::patch('customers/{customers}', 'CustomersController@update')->name('customers.update')	;
Route::delete('customers/{customers}', 'CustomersController@destroy')->name('customers.destroy');

// Route::resource('customers', 'CustomersController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
