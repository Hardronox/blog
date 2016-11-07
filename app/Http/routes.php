<?php

//Route::get('customer_name/', function () {
//
//    $customer=App\Customers::where('name','=','Tony')->first();
//    echo $customer->id;
//});
//
//
//Route::get('orders', function () {
//    $users=App\UsersProfile::find(1);
//    //foreach ($users as $blogs) {
//        echo $users->users->name.' belongs to '.$users->firstname;
//    //}
//    //var_dump('<pre>', $users->users, '</pre>');
//});

Route::get('/', 'BlogsController@index');

Route::get('/blog/{id}', 'BlogsController@blogView');





Route::group(['middleware'=>'auth'], function()
{
    Route::get('/create', 'BlogsController@blogCreate');

    Route::post('/create', 'BlogsController@blogCreate')->name('create-blog');

    Route::get('/edit-article', 'BlogsController@blogCreate');

    Route::get('/profile', 'UserController@userProfile')->name('profile');

    Route::post('/edit-profile', 'UserController@editProfile')->name('edit-profile');

    Route::get('/delete-profile', 'UserController@deleteProfile')->name('delete');

});


Route::get('/api/blogs',function() {

    $blogs = \App\Models\Blogs::with('category')->get();
    return $blogs;
});


////create
//Route::post('test', function () {
//    echo ' walking where dead ships dwell';
//});
//
////read
//Route::get('test', function () {
//    echo '<form action="test" method="post">';
//    echo '<input type="submit">';
//    echo '<input type="hidden" value="' . csrf_token() .'" name="_token">';
//    echo '<input type="hidden" name="_method" value="PUT">';
//    echo '</form>';
//});
//
////update
//Route::put('test', function () {
//    echo 'we updated dead ships';
//});
//
//Route::delete('test', function ($name) {
//    echo 'we deleted dead ships';
//});
Route::auth();
