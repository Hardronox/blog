<?php





Route::get('/', 'BlogController@index');

Route::get('/blog/{id}', 'BlogController@articleView')->middleware('subscriber');


Route::get('/elastic', 'BlogController@elastic');

Route::get('/likes', 'ServiceController@likes');

Route::post('/comments', 'ServiceController@showComments');

Route::get('/article-permissions/{id}', 'BlogController@articlePermissions');


Route::group(['middleware'=>'auth'], function()
{
    Route::get('/create', 'BlogController@articleCreate');

    Route::post('/create', 'BlogController@articleCreate')->name('create-article');

    Route::get('/article/edit/{id}', 'BlogController@articleEdit');

    Route::post('/edit-article/{id}', 'BlogController@articleEdit')->name('edit-article');

    Route::get('/article/status', 'BlogController@articleStatus');

    Route::get('/article/delete/{id}', 'BlogController@articleDelete');

    Route::get('/profile', 'UserController@userProfile')->name('profile');

    Route::post('/edit-profile', 'UserController@editProfile')->name('edit-profile');

    Route::get('/delete-profile', 'UserController@deleteProfile')->name('delete');

    Route::get('/profile/articles', 'UserController@myArticles');

    Route::get('/subscribe', 'UserController@subscribe');

    Route::post('/payment/paypal', 'PaymentController@paypal');

    Route::post('/payment/card', 'PaymentController@card');

    Route::get('/payment/success', 'PaymentController@successPayment');

    Route::post('/comment-save', 'ServiceController@saveComment');

});

Route::auth();
