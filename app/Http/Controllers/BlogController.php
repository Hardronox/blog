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

class BlogController extends Controller
{

    /**
     * displays home page(whole logic in angular(js/angular/main.controller.js) )
     */
    public function index()
    {
        return view('home');
    }

    /**
     * displays single article
     */
    public function articleView($id)
    {
        $blog=Blog::with('likes')->find($id);

        ServiceController::views($blog);

        return view('view',['blog'=>$blog, 'likes'=> sizeof($blog->likes)]);
    }

    /**
     * displays create-article page and is form-create action(if $_POST isset)
     */
    public function articleCreate()
    {
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

        return view('create',['categories' =>ServiceController::getCategories()
        ]);
    }

    /**
     * displays edit-article page(just like create above)
     */
    public function articleEdit($id)
    {
        $article= Blog::find($id);

        if (!empty($_POST))
        {
            $file = array('image' => Input::file('image'));
            $rules = array('image' => 'mimes:jpeg,bmp,png'); //mimes:jpeg,bmp,png and for max size max:10000

            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                return Redirect::to('/profile/articles')->withInput()->withErrors($validator);
            }
            else
            {
                $array_to_update = [
                    'title'=>$_POST['title'],
                    'description'=>$_POST['desc'],
                    'text'=>$_POST['text'],
                    'category_id'=>$_POST['category']
                ];

                if (Input::file('image'))
                {
                    $destinationPath = 'images/blog'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = str_random(30).'.'.$extension; // renaming image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    $array_to_update = array_add($array_to_update, 'image', $fileName);
                }


                Blog::find($id)
                    ->update($array_to_update);

                Blog::editElastic($id, $_POST, $fileName);


                flash('Your Article was edited successfully!', 'success');
                return redirect('/profile/articles');
            }
        }
        return view('article-edit',[
                                    'article' => $article,
                                    'categories' => ServiceController::getCategories()

        ]);
    }

    /**
     * ajax-change status of article in profile/articles
     */
    public function articleStatus()
    {
        if (Request::ajax())
        {
            $article = Blog::find($_GET['id']);
            $user = Auth::user();

            if ($article['user_id'] == $user['id'])
            {
                if ($article->status == "Draft") {
                    $article->status = "Published";
                } else {
                    $article->status = "Draft";
                }
                $article->save();


                return $article->status;
            } else {
                abort(403, 'You are not allowed to perform this action');
            }
        }
    }

    /**
     * deletes article(from db and elastic) in profile/articles
     */
    public function articleDelete($id)
    {
        $article= Blog::find($id);
        $user = Auth::user();

        if ($article['user_id']==$user['id'])
        {
            $article->delete();

            $client = ClientBuilder::create()->build();

            $params = [
                'index' => 'myblogs',
                'type' => 'myblogs',
                'id' => $id
            ];

            $client->delete($params);

            return redirect('/profile/articles');
        }
        else
        {
            abort(403, 'You are not allowed to perform this action');
        }
    }

    /**
     *  adds all articles in elasticSearch
     */
    public static function elastic()
    {
        $blogs=Blog::with('category')->get();

        foreach ($blogs as $blog) {
            ServiceController::uploadToElastic($blog);
        }
    }
}