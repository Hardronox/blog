<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Elasticsearch\ClientBuilder;
use Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class BlogsController extends Controller {


    public function index()
    {
        $client = ClientBuilder::create()->build();

//        $params = [
//            'index' => 'my_index',
//            'type' => 'my_type',
//            'id' => '2',
//            'body' => ['testField' => 'abc','test2'=>'blyaaa']
//        ];
//
//        $response = $client->index($params);

        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => '2'
        ];

        $response = $client->get($params);

        var_dump($response['_source']['test2']);

        $blogs = \App\Models\Blogs::with('category')->get();

        return view('home');
    }

    public function blogView($id)
    {
        $blog=Blogs::find($id);

        return view('view',['blog'=>$blog]);
    }

    public function blogCreate()
    {
        $blogCategory= \App\Models\BlogCategory::all();

        if (!empty($_POST))
        {
            $user = Auth::user();
            $blog= new \App\Models\Blogs();

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
                $destinationPath = 'images/blog'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = str_random(30).'.'.$extension; // renaming image

                $blog->image=$fileName;
                $blog->save();

                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                flash('Your article was created successfully!', 'success');
                return redirect('/');
            }

        }

        return view('create',['category' => $blogCategory]);
    }

}