<?php

use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Input;

Route::get('/', 'BlogController@index');

Route::get('/blog/{id}', 'BlogController@articleView')->middleware('subscriber');

Route::group(['middleware'=>'auth'], function()
{
	Route::get('/create', 'BlogController@articleCreate');

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
});




Route::get('/mail', function(){
	Mail::to("Sanya.Chuck@mail.ru")->send(new ConfirmEmail());
});

Route::post('/check', function(){

	define("UPLOAD_DIR", "images/avatars/");

	if (!empty($_FILES["avatar"])) {
		$myFile = $_FILES["avatar"];

//		var_dump('<pre>', $myFile["tmp_name"], '</pre>');
//		exit;

		// preserve file from temporary directory
		$success = move_uploaded_file($myFile["tmp_name"][0],
			UPLOAD_DIR . $myFile["name"][0]);
		if (!$success) {
			echo "<p>Unable to save file.</p>";
			exit;
		}
	}

		// set proper permissions on the new file
		chmod(UPLOAD_DIR . $myFile["name"][0], 0644);
});

Route::get('/elastic', 'BlogController@elastic');

Route::get('/likes', 'ServiceController@likes');

Route::post('/comments', 'ServiceController@showComments');

Route::get('/article-permissions/{id}', 'BlogController@articlePermissions');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/vk/auth', 'Auth\AuthController@vk');

Route::auth();
