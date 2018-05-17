<?php



Route::get('/', function () {
    return view('welcome');
});

//ADMIN
Route::group([
	'prefix'      => 'admin',
	'namespace'   => 'Admin'
], function (){
	Route::get('/','DashboardController@index');
	Route::resource('/news', 'NewsesController');
	Route::get('/news/toggle/{id}', 'NewsesController@toggle');
	Route::resource('/reviews', 'ReviewsController');
	Route::get('/reviews/toggle/{id}', 'ReviewsController@toggle');
	
});

//WWW
Route::get('/news','HomeController@news_index');
Route::get('/news/{slug}','HomeController@news_show');
Route::get('/reviews','HomeController@review_index');

Route::post('/add_review','HomeController@add_review');
