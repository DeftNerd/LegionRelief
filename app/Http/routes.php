<?php

/**
 * Home route
 */

Route::get('/', 
  [
  	'as' => 'home', 
    'uses' => 'WelcomeController@index'
  ]
);

/**
 * Administration routes
 */

Route::group(
	[
    'prefix' => 'admin', 
  	'namespace' => 'Admin',
  	'middleware' => 'admin'
	], function()
  {
      
      Route::get('/', 
        [
          'as' => 'admin.legionnaires.index', 
          'uses' => 'LegionnairesController@index'
        ]
      );

      Route::post('/legionnaires/approve/{id}', 
        [
          'as' => 'admin_legionnaires_approve',
          'uses' => 'LegionnairesController@approve'
        ]
      );

      Route::post('/legionnaires/unapprove/{id}', 
        [
          'as' => 'admin_legionnaires_unapprove',
          'uses' => 'LegionnairesController@unapprove'
        ]
      );

      Route::resource('legionnaires', 'LegionnairesController');
      Route::resource('users', 'UsersController');

  });

/**
 * About and contact routes
 */

Route::get('/about', 
  [
    'as' => 'about.index', 
    function () {
      return view('about.index');
    }
  ]
);

Route::get('/books', 
  [
    'as' => 'about.books', 
    function () {
      return view('about.books');
    }
  ]
);

Route::get('/buy', 
  [
    'as' => 'about.buy', 
    function () {
      return view('about.buy');
    }
  ]
);

Route::get('/contact', 
  [
    'as' => 'about.contact', 
    'uses' => 'AboutController@contact'
  ]
);

Route::post('contact', 
  [
  	'as' => 'contact_store', 
    'uses' => 'AboutController@contact_store'
  ]
);

/**
 * Legionnaire-related routes
 * 
 */

Route::resource('categories', 'CategoryController');

Route::get('search', 
  [
    'as' => 'search', 
    'uses' => 'LegionnaireController@search'
  ]
);

Route::post('legionnaires/star', 
  [
  	'as' => 'legionnaires.star', 
    'uses' => 'LegionnaireController@star'
  ]
);

Route::get('legionnaires/popular', 
  [
    'as' => 'legionnaires.popular', 
    'uses' => 'LegionnaireController@popular'
  ]
);

Route::get('legionnaires/new', 
  [
    'as' => 'legionnaires.latest', 
    'uses' => 'LegionnaireController@latest'
  ]
);

Route::resource('legionnaires', 'LegionnaireController');

Route::get('/users/{username}/legionnaires', 
  [
    'as' => 'user.legionnaires', 
    'uses' => 'UsersController@legionnaires'
  ]
);

Route::get('/users/{username}/stars', 
  [
    'as' => 'user.stars', 
    'uses' => 'UsersController@stars'
  ]
);

Route::get('/users/{username}', 
  [
    'as' => 'user.show', 
    'uses' => 'UsersController@show'
  ]
);

/**
 * Account management routes
 */

Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

