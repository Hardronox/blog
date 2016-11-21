<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Likes;
use Elasticsearch\ClientBuilder;
use Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller {


    public function index()
    {
        return view('home');
    }

    public function articleView($id)
    {
        $blog=Blog::with('likes')->find($id);

        ServiceController::views($blog);

        return view('view',['blog'=>$blog, 'likes'=> sizeof($blog->likes)]);
    }

    public function articleCreate()
    {
        $blogCategory= BlogCategory::all();

        if (!empty($_POST))
        {
            $user = Auth::user();
            $blog= new Blog();

            $blog->user_id=$user['id'];
            $blog->title=$_POST['title'];
            $blog->description=$_POST['desc'];
            $blog->text=$_POST['text'];
            $blog->category_id=$_POST['category'];


            $file = array('image' => Input::file('image'));
            $rules = array('image' => 'mimes:jpeg,bmp,png'); //mimes:jpeg,bmp,png and for max size max:10000

            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                // send back to the page with the input data and errors
                return Redirect::to('create')->withInput()->withErrors($validator);
            }
            else
            {
                if (Input::file('image'))
                {
                    $destinationPath = 'images/blog'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = str_random(30).'.'.$extension; // renaming image

                    $blog->image=$fileName;
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

                }
                $blog->save();

                ServiceController::uploadToElastic($blog);

                // sending back with message
                flash('Your article was created successfully!', 'success');
                return redirect('/');
            }

        }

        return view('create',['category' => $blogCategory]);
    }

    public function articleEdit($id)
    {
        $user_id = Auth::user();

        $article= Blog::find($id);


        if (!empty($_POST))
        {
            $user_id = Auth::user();

            $file = array('image' => Input::file('image'));
            $rules = array('image' => 'mimes:jpeg,bmp,png'); //mimes:jpeg,bmp,png and for max size max:10000

            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                return Redirect::to('/profile')->withInput()->withErrors($validator);
            }
            else
            {
                if (Input::file('image'))
                {
                    $destinationPath = 'images/avatars'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = str_random(30).'.'.$extension; // renaming image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    $array_to_update = ['firstname'=>$_POST['firstname'], 'lastname'=>$_POST['lastname'], 'avatar'=>$fileName];
                }
                else
                    $array_to_update = ['firstname'=>$_POST['firstname'], 'lastname'=>$_POST['lastname']];


                $profile=UsersProfile::where(['user_id'=> $user_id['id']])->get();

                if (sizeof($profile)===0)
                {
                    $userProfile= new UsersProfile();
                    $userProfile->user_id=$user_id['id'];
                    $userProfile->firstname=$_POST['firstname'];
                    $userProfile->lastname=$_POST['lastname'];
                    if(isset($fileName))
                    {
                        $userProfile->avatar=$fileName;
                    }
                    $userProfile->save();
                }
                else
                {
                    UsersProfile::where(['user_id'=> $user_id['id']])
                        ->update($array_to_update);
                }

                flash('Your profile was edited successfully!', 'success');
                return redirect('/profile');
            }
        }
        return view('edit-profile',['user' => $user]);
    }

    public function articleStatus($id)
    {
        $article= Blog::find($id);
        $user = Auth::user();


        if ($article['user_id']==$user['id'])
        {
            if($article->status==0)
            {
                $article->status=1;
            }
            else
            {
                $article->status=0;
            }
            $article->save();

            return redirect('/profile/articles');
        }
        else
        {
            abort(403, 'You are not allowed to perform this action');
        }
    }

    public function articleDelete($id)
    {
        $article= Blog::find($id);
        $user = Auth::user();

        if ($article['user_id']==$user['id'])
        {
            $article->delete();

            return redirect('/profile');
        }
        else
        {
            abort(403, 'You are not allowed to perform this action');
        }
    }

    public static function elastic()
    {
        $blogs=Blog::with('category')->get();

        foreach ($blogs as $blog) {

            ServiceController::uploadToElastic($blog);

        }


//        $params = [
//            'index' => 'my_index',
//            'type' => 'my_type',
//            'id' => '2'
//        ];

        //$response = $client->get($params);

        //var_dump($response['_source']['test2']);

        //$blogs = \App\Models\Blogs::with('category')->get();

        //return view('home');
    }

}