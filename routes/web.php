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
// Route::get('/', function () {
//     return view('welcome');
// });

#Route::get('login','LoginController@getLogin');
#Route::get('login','LoginController@getLogin');
Route::get('/','HomeController@getHome');
Route::get('home','HomeController@getHome');
Route::get('home/{page}','HomeController@getHomePage');
Route::get('people','People@getName');
#Route::post('login','LoginController@postLogin');
Route::group(['prefix'=>'login','middleware'=>'checkLogin'], function(){
    Route::post('/','LoginController@postLogin');
    Route::get('/','LoginController@getLogin');
});
Route::group(['middleware'=>'checkAdmin'], function(){
    Route::get('logout','LoginController@getLogout');
    Route::get('admin2','LoginController@getIndex');
});


Route::get('news/catid/{cat_id}', 'NewsController@getNewsByCatId');
Route::get('post','NewsController@getPost');
Route::get('news/newsid/{news_id}', 'NewsController@getNewsById');

Route::group(['prefix'=>'category','middleware'=>'checkAdmin'],function(){
	Route::get('add','Category@getAdd');
	Route::post('add','Category@postAdd');
	Route::get('edit','Category@getEdit');
	Route::post('edit','Category@postEdit');
	Route::post('del/{cat_id}','Category@postDel');
});

Route::group(['prefix'=>'news','middleware'=>'checkAdmin'],function(){
	Route::get('add','NewsController@getAdd');
	Route::post('add','NewsController@postAdd');
	Route::get('edit','NewsController@getEdit');
	Route::post('edit','NewsController@postEdit');
	Route::post('del/{news_id}','NewsController@postDel');
});
//gio hang
//Route::post('/cart', 'Front@cart');
Route::get('cart','CartController@getCart');
Route::post('cart','CartController@postCart');

Route::post('comment','NewsController@postComment');
//Route::get('comment','NewsController@postComment');

Route::group(['prefix'=>'client','middleware'=>'checkLoginClient'],function(){
	Route::get('login','ClientController@getLogin');
	Route::post('login','ClientController@postLogin');
	Route::get('register','ClientController@getRegister');
	Route::post('register','ClientController@postRegister');
	Route::get('logout','ClientController@getLogout');
});

Route::get('eloquent','TestEloquent@getAll');
// Route::get('search/{pasge}/{keyword}','NewsController@getSearch');
