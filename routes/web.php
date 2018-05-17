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
	Route::resource('/comments', 'CommentsController');
	Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
	
});

//WWW
Route::get('/news','HomeController@news_list');
Route::get('/news/{slug}','HomeController@single_news_show');
Route::post('/add_comment','HomeController@add_comment');
