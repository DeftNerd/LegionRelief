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
          'as' => 'admin.tips.index', 
          'uses' => 'TipsController@index'
        ]
      );

      Route::post('/tips/approve/{id}', 
        [
          'as' => 'admin_tips_approve',
          'uses' => 'TipsController@approve'
        ]
      );

      Route::post('/tips/unapprove/{id}', 
        [
          'as' => 'admin_tips_unapprove',
          'uses' => 'TipsController@unapprove'
        ]
      );

      Route::resource('tips', 'TipsController');
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
 * Tip-related routes
 * 
 */

Route::resource('categories', 'CategoryController');

Route::get('search', 
  [
    'as' => 'search', 
    'uses' => 'TipController@search'
  ]
);

Route::post('tips/star', 
  [
  	'as' => 'tips.star', 
    'uses' => 'TipController@star'
  ]
);

Route::get('tips/popular', 
  [
    'as' => 'tips.popular', 
    'uses' => 'TipController@popular'
  ]
);

Route::get('tips/new', 
  [
    'as' => 'tips.latest', 
    'uses' => 'TipController@latest'
  ]
);

Route::resource('tips', 'TipController');

Route::get('/users/{username}/tips', 
  [
    'as' => 'user.tips', 
    'uses' => 'UsersController@tips'
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

