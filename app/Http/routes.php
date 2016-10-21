<?php

//Route::get('customer_name/', function () {
//
//    $customer=App\Customers::where('name','=','Tony')->first();
//    echo $customer->id;
//});
//
//
Route::get('orders', function () {

    $users=App\UsersProfile::find(1);
    //foreach ($users as $blogs) {

        echo $users->users->name.' belongs to '.$users->firstname;

    //}

    //var_dump('<pre>', $users->users, '</pre>');

});

Route::get('/', 'HomeController@index');


Route::get('/api/todos',function() {

    $blogs = \App\Blogs::all();

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
