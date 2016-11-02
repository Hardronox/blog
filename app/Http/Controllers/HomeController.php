<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $blogs = \App\Blogs::with('category')->get();

        return view('home');
    }

    public function blogView($id)
    {
        $blog=Blogs::find($id);

        return view('view',['blog'=>$blog]);
    }

    public function userProfile()
    {
        $user_id = Auth::user();

        $user= User::with('profile')->find($user_id['id']);
        //$user = User::with('profile')->get($user_id['id']);

        return view('profile',['user'=>$user]);
    }

    public function editProfile()
    {
        $user_id = Auth::user();

        $user= User::with('profile')->find($user_id['id']);
        //$user = User::with('profile')->get($user_id['id']);

        return view('profile',['user'=>$user]);
    }

    public function deleteAccount()
    {
        $user_id = Auth::user();

        $user= User::with('profile')->find($user_id['id']);
        //$user = User::with('profile')->get($user_id['id']);

        return view('profile',['user'=>$user]);
    }



    public function blogCreate()
    {
        $blogCategory= \App\BlogCategory::all();

        if (!empty($_POST))
        {

            $user = Auth::user();
            //var_dump('<pre>',$user['id'] , '</pre>');
            $blog= new \App\Blogs();
            //$blog->user_id=$user['id'];
            $blog->title=$_POST['title'];
            $blog->description=$_POST['desc'];
            $blog->text=$_POST['text'];
            $blog->category_id=$_POST['category'];

            $blog->save();

            if ($blog->save())
            {
                $file = array('image' => Input::file('image'));
                $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000

                $validator = Validator::make($file, $rules);
                if ($validator->fails()) {
                    // send back to the page with the input data and errors
                    return Redirect::to('create')->withInput()->withErrors($validator);
                }
                else
                {
                    $destinationPath = 'uploads'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111,99999).'.'.$extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    // sending back with message
                    flash('Your article was created successfully!', 'success');
                    return redirect('/');
                }


            }
        }

        return view('create',['category' => $blogCategory]);
    }

//    public function blogSave(\Illuminate\Http\Request $request)
//    {
//        //$user = Auth::user();
//        //var_dump('<pre>',$user['id'] , '</pre>');
//        $blog= new \App\Blogs();
//        $blog->title=$request['title'];
//        $blog->description=$request['desc'];
//        $blog->text=$request['text'];
//        $blog->save();
//        var_dump('<pre>', $request, '</pre>');
//
//        return view('create');
//    }
}
