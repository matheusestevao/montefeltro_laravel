<?php

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

/*SYSTEM*/
Route::group(['namespace' => 'System'], function() {

	Route::get('/admin', 'HomeController@index')->name('home');

	/*AUTH*/
	Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {

		/*MASTER*/
		Route::group(['namespace' => 'Master', 'prefix' => 'master'], function() {

			/*MODULES*/
			Route::group(['prefix' => 'modules'], function () {
				Route::get('/', 'ModulesController@index')->name('module.index');
				Route::get('/add', 'ModulesController@create')->name('module.add');
				Route::post('/store', 'ModulesController@store')->name('module.store');
				Route::get('/edit/{id}', 'ModulesController@edit')->name('module.edit');
				Route::post('/update/{id}', 'ModulesController@update')->name('module.update');
				Route::post('/delete/{id}', 'ModulesController@destroy')->name('module.delete');
			});

			/*PERMISSIONS*/
			Route::group(['prefix' => 'permission'], function () {
				Route::get('/', 'PermissionsController@index')->name('permission.index');
				Route::get('/edit/{id}', 'PermissionsController@edit')->name('permission.edit');
				Route::post('/store', 'PermissionsController@store')->name('permission.store');
				Route::get('/delete/{id}', 'PermissionsController@destroy')->name('permission.delete');
			});

			/*ROLES*/
			Route::group(['prefix' => 'role'], function () {
				Route::get('/', 'RolesController@index')->name('role.index');
				Route::get('/add', 'RolesController@create')->name('role.add');
				Route::post('/store', 'RolesController@store')->name('role.store');
				Route::get('/edit/{id}', 'RolesController@edit')->name('role.edit');
				Route::post('/delete/{id}', 'RolesController@destroy')->name('role.delete');
				Route::post('/update/{id}', 'RolesController@update')->name('role.update');
			});

		});

		/*PROFILE*/
		Route::group(['namespace' => 'Users'], function() {

			Route::group(['prefix' => 'profile'], function() {
				Route::get('/{id}', 'UsersController@myProfile')->name('profile.myProfile');
				Route::post('/update/{id}', 'UsersController@myProfileUpdate')->name('profile.update');
			});

			Route::group(['prefix' => 'users'], function() {
				Route::get('/', 'UsersController@index')->name('user.index');
				Route::get('/create', 'UsersController@create')->name('user.add');
				Route::post('/store', 'UsersController@store')->name('user.store');
				Route::get('/edit/{id}', 'UsersController@edit')->name('user.edit');
				Route::post('/update/{id}', 'UsersController@update')->name('user.update');
				Route::post('/delete/{id}', 'UsersController@destroy')->name('user.delete');
			});

		});

        /*CLIENTS*/
        Route::group(['prefix' => 'clients'], function() {
            Route::get('/', 'ClientsController@index')->name('client.index');
            Route::get('/add', 'ClientsController@create')->name('client.add');
            Route::post('/store', 'ClientsController@store')->name('client.store');
            Route::get('/edit/{id}', 'ClientsController@edit')->name('client.edit');
            Route::post('/update/{id}', 'ClientsController@update')->name('client.update');
            Route::post('/delete/{id}', 'ClientsController@destroy')->name('client.delete');
        });

        /*CATEGORIES*/
        Route::group(['prefix' => 'categories'], function() {
            Route::get('/', 'CategoriesController@index')->name('category.index');
            Route::get('/add', 'CategoriesController@create')->name('category.add');
            Route::post('/store', 'CategoriesController@store')->name('category.store');
            Route::get('/edit/{id}', 'CategoriesController@edit')->name('category.edit');
            Route::post('/update/{id}', 'CategoriesController@update')->name('category.update');
            Route::post('/delete/{id}', 'CategoriesController@destroy')->name('category.delete');
        });

	});

});



