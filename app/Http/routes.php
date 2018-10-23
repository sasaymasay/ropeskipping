<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::resource('/','IndexController',[
                                        'only'=>['index'],
                                        'names'=>['index'=>'home']
]);



Route::resource('portfolios','PortfolioController', [
                                                    'parametrs' => ['portfolios'=>'alias']
    
    
]);


Route::group(['middleware' => 'auth'], function () {

Route::resource('competitions', 'CompetitionController', [
                                                           'parametrs' => ['competitions' => 'alias']]);
                                                            
});


Route::resource('articles', 'ArticlesController', [ 'parametrs' => ['articles'=>'alias']]);

Route::group(['middleware' => 'auth'], function () {
    
Route::resource('signup', 'ResultController');



});

    
Route::match(['get','post'],'/contacts', ['uses'=>'ContactController@index', 'as'=>'contacts']);



Route::auth();

Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
    
    Route::get('/',['uses'=>'Admin\IndexController@index','as'=>'adminIndex']);
    Route::resource('/articless', 'Admin\ArticlesController');
    Route::resource('/comps', 'Admin\CompetitionController');
    Route::resource('/judges', 'Admin\JudgesController');
    Route::resource('/permissions', 'Admin\PermissionsController');
    Route::resource('/users', 'Admin\UsersController');
    Route::resource('/disc', 'Admin\DisciplinesController');
    Route::resource('/groups', 'Admin\GroupsController');
    Route::resource('/results', 'Admin\ScoreController');
    Route::resource('/scores', 'Admin\ScoreController'); 
   
});




