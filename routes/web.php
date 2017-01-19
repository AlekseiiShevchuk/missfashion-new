<?php
Route::get('/', function () {
    return redirect('/home');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('auth.password.email');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('donors', 'DonorsController');
    Route::post('donors_mass_destroy', ['uses' => 'DonorsController@massDestroy', 'as' => 'donors.mass_destroy']);
    Route::resource('categories', 'CategoriesController');
    Route::post('categories_mass_destroy', ['uses' => 'CategoriesController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::resource('images', 'ImagesController');
    Route::post('images_mass_destroy', ['uses' => 'ImagesController@massDestroy', 'as' => 'images.mass_destroy']);
    Route::resource('colors', 'ColorsController');
    Route::post('colors_mass_destroy', ['uses' => 'ColorsController@massDestroy', 'as' => 'colors.mass_destroy']);
    Route::resource('sizes', 'SizesController');
    Route::post('sizes_mass_destroy', ['uses' => 'SizesController@massDestroy', 'as' => 'sizes.mass_destroy']);
    Route::resource('products', 'ProductsController');
    Route::post('products_mass_destroy', ['uses' => 'ProductsController@massDestroy', 'as' => 'products.mass_destroy']);
});
