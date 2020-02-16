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
Route::get('/','HomeController@index')->name('home');
// Admin
Route::view('admin/login', 'admin.pages.login')->name('view.admin.login');
Route::post('admin/login', 'UserController@loginAdmin')->name('admin.login');
Route::get('admin/logout', 'UserController@logoutAdmin')->name('admin.logout');
Route::group(['prefix' => 'admin', 'middleware' => 'AdminMiddleware'], function() {
	Route::view('/','admin.pages.index')->name('admin.home');
	Route::group(['prefix' => 'category'], function() {
		Route::get('/list','CategoryController@list')->name('admin.get.list.category');
		Route::get('/add','CategoryController@add')->name('admin.get.add.category');
		Route::post('/add','CategoryController@save');
		Route::get('/edit/{id}','CategoryController@edit')->name('admin.get.edit.category');
		Route::post('/edit/{id}','CategoryController@update');
		Route::get('/delete/{id}','CategoryController@delete')->name('admin.get.delete.category');
	});
	Route::resource('producttype','ProductTypeController');
	Route::resource('product','ProductController');
	Route::post('product-update/{id}','ProductController@update');
	Route::resource('order', 'OrderController');
	Route::get('action/{id}', 'OrderController@action')->name('admin.get.order.action');
	Route::get('orderDetail/{id}', 'OrderDetailController@index')->name('admin.get.order.detail');
	//ajax admin
	Route::group(['prefix' => 'ajax'], function() {
		Route::get('/product/{id}','AjaxController@getProductType');
	});
});

// Client 
// đặng nhập user
Route::post('login-user', 'Auth\LoginController@getLogin')->name('get.login');
Route::post('register-user', 'Auth\RegisterController@create')->name('get.register');
Route::get('logout-user', 'Auth\LoginController@getLogout')->name('get.logout');

// giỏ hàng
Route::resource('/cart', 'CartController');
Route::get('addCart/{id}', 'CartController@add')->name('add.cart');
Route::get('checkout', 'CartController@checkout')->name('checkout');
Route::get('san-pham/{id}/{slug}.html', 'ProductDetailController@index')->name('get.product.detail');
Route::get('loai-san-pham/{id}/{slug}.html', 'HomeController@productType')->name('get.product.type');
Route::get('search', 'HomeController@search')-> name('get.search.product');

// thông tin khách hàng
Route::resource('customer','CustomerController');


