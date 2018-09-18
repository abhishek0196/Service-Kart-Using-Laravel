<?php

Route::get('/', function () {
  return view('welcome');
});

// Authentication Routes...
/* $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');
 */
// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);


});

Route::group([/*'middleware' => ['web', 'admin', 'auth:admin'],*/ //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::group(['prefix' => 'customer'], function () {
  Route::get('/login', 'CustomerAuth\LoginController@showLoginForm')->name('customer.login');
  Route::post('/login', 'CustomerAuth\LoginController@login');
  Route::post('/logout', 'CustomerAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'CustomerAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'CustomerAuth\RegisterController@register');

  Route::post('/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
  Route::post('/password/reset', 'CustomerAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
  Route::get('/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm')->name('customer.password.reset');
  Route::get('user/activation/{token}', 'CustomerAuth\RegisterController@userActivation')->name('customer.activation');
  
  Route::resource('/order/OfficeServices', 'CustomerAuth\Orders\OfficeServiceController');
  Route::get('/order/office/categories', ['uses' => 'CustomerAuth\Orders\OfficeServiceController@categoryView', 'as' => 'OfficeServices.catgeories']);
  Route::get('/order/office/categories/{id}', ['uses' => 'CustomerAuth\Orders\OfficeServiceController@productView', 'as' => 'catgeory']);


  Route::resource('/order/BeautyServices', 'CustomerAuth\Orders\BeautyServiceController');
  Route::resource('/order/TutionServices', 'CustomerAuth\Orders\TutionServiceController');


  Route::resource('/orderHistory', 'CustomerAuth\Orders\OrdersOverviewController');
  
});

Route::group(['prefix' => 'serviceprovider'], function () {
  Route::get('/login', 'ServiceproviderAuth\LoginController@showLoginForm')->name('serviceprovider.login');
  Route::post('/login', 'ServiceproviderAuth\LoginController@login');
  Route::post('/logout', 'ServiceproviderAuth\LoginController@logout')->name('serviceprovider.logout');

  Route::get('/register', 'ServiceproviderAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'ServiceproviderAuth\RegisterController@register');

  Route::post('/password/email', 'ServiceproviderAuth\ForgotPasswordController@sendResetLinkEmail')->name('serviceprovider.password.email');
  Route::post('/password/reset', 'ServiceproviderAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'ServiceproviderAuth\ForgotPasswordController@showLinkRequestForm')->name('serviceprovider.password.request');
  Route::get('/password/reset/{token}', 'ServiceproviderAuth\ResetPasswordController@showResetForm')->name('serviceprovider.password.reset');
  Route::get('user/activation/{token}', 'ServiceproviderAuth\RegisterController@userActivation')->name('activation');
  
  Route::resource('product_categories', 'ServiceproviderAuth\ProductCategoriesController');
  Route::post('product_categories_mass_destroy', ['uses' => 'ServiceproviderAuth\ProductCategoriesController@massDestroy', 'as' => 'product_categories.mass_destroy']);
  Route::resource('product_tags', 'ServiceproviderAuth\ProductTagsController');
  Route::post('product_tags_mass_destroy', ['uses' => 'ServiceproviderAuth\ProductTagsController@massDestroy', 'as' => 'product_tags.mass_destroy']);
  Route::resource('products', 'ServiceproviderAuth\ProductsController');
  Route::post('products_mass_destroy', ['uses' => 'ServiceproviderAuth\ProductsController@massDestroy', 'as' => 'products.mass_destroy']);

  Route::get('profile' , 'ServiceproviderAuth\ProfileController@index')->name('profile.index');
  Route::post('updateprofile' , 'ServiceproviderAuth\ProfileController@updateProfile')->name('profile.update');
  
  Route::get('/otp' ,'ServiceproviderAuth\RegisterController@otp');
  Route::post('/otp', 'ServiceproviderAuth\RegisterController@otpCheck');
  
  Route::resource('pending_orders', 'ServiceproviderAuth\orders\PendingController');
  Route::resource('approved_orders', 'ServiceproviderAuth\orders\ApprovedController');
  Route::resource('inprogress_orders', 'ServiceproviderAuth\orders\InProgressController');
  Route::resource('completed_orders', 'ServiceproviderAuth\orders\AllOrdersController');

  Route::get('/approveStatus/{updateStatus}','ServiceproviderAuth\orders\PendingController@approveStatus')->name('status.approve');
  Route::get('/rejectStatus/{updateStatus}','ServiceproviderAuth\orders\PendingController@rejectStatus')->name('status.reject');

  Route::get('/inprogress/{updateStatus}','ServiceproviderAuth\orders\ApprovedController@inProgress')->name('status.inprogress');

  Route::get('/completed/{updateStatus}','ServiceproviderAuth\orders\InProgressController@completed')->name('status.completed');


  
  
});
