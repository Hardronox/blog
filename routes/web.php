<?php

Route::group(['middleware'=>'locale'], function()
{
	Route::get('/', 'BlogController@index');

	Route::get('/post/{slug}', 'BlogController@articleView')->middleware('subscriber');

	Route::group(['middleware'=>'auth'], function()
	{
		Route::get('/article/write', 'BlogController@articleCreate');

		Route::post('/create', 'BlogController@articleCreate')->name('create-article');

		Route::get('/article/edit/{id}', 'BlogController@articleEdit');

		Route::post('/edit-article/{id}', 'BlogController@articleEdit')->name('edit-article');

		Route::get('/article/status', 'BlogController@articleStatus');

		Route::get('/article/delete/{id}', 'BlogController@articleDelete');

		Route::get('/profile', 'UserController@userProfile');

		Route::post('/profile/edit', 'UserController@editProfile')->name('edit-profile');

		Route::get('/profile/delete', 'UserController@deleteProfile');

		Route::get('/profile/articles', 'UserController@myArticles');

		Route::post('/payment/paypal', 'PaymentController@paypal');

		Route::post('/payment/card', 'PaymentController@card');

		Route::get('/payment/success', 'PaymentController@successPayment');

		Route::post('/comment/save', 'ServiceController@saveComment');

		Route::get('/comment/delete/{id}', 'UserController@deleteComment');

	});

	Route::group(['middleware'=>'admin'], function()
	{
		Route::get('/admin/users', 'UserController@adminUsers');

		Route::get('/admin/articles', 'UserController@adminArticles');

		Route::get('/admin/comments', 'UserController@adminComments');

		Route::get('/article/premium', 'UserController@makePremium');

	});



	Route::get('/change-locale/{lang}', function($lang){

		session()->forget('locale');

		session(['locale' => $lang]);
		return back();
	});

	Route::get('/confirm-email', 'UserController@confirmEmail');

	Route::get('/search', 'BlogController@articleSearch')->name('search');

	Route::get('/elastic', 'BlogController@elastic');

	Route::get('/likes', 'ServiceController@likes');

	Route::post('/comments', 'ServiceController@showComments');

	Route::get('/article-permissions/{slug}', 'BlogController@articlePermissions');

	Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

	Route::get('/vk/auth', 'Auth\AuthController@vk');

	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::auth();
});


