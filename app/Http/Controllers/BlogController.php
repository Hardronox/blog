<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Articles;
use App\Models\ArticleCategory;
use App\Models\Likes;
use Carbon\Carbon;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
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
        return view('/site/home');
    }

    /**
     * displays single article
     */
    public function articleView($slug)
    {
        $blog=Articles::with('likes')->where('slug','=',$slug)->first();

        $ads=Advertisement::get();

        $views=ServiceController::views($blog);

        return view('/site/article-view',[
			'blog'=>$blog,
			'ads'=>$ads,
			'likes'=> sizeof($blog->likes),
			'views'=>$views
		]);
    }

    /**
     * displays create-article page and is form-create action(if $_POST isset)
     */
    public function articleCreate(Request $request)
    {
        if (!empty($_POST)) {

			$image='public/images/articles/no-image.png';

            $blog= new Articles();

            $blog->user_id=Auth::user()->id;
            $blog->title=$_POST['title'];
			$blog->slug=str_slug($_POST['title']);
            $blog->description=$_POST['desc'];
            $blog->text=$_POST['text'];
            $blog->category_id=$_POST['category'];
            $blog->created_at=new Carbon('now');


			if ($request->hasFile('image')){

				$image=$request->image->store('public/images/articles');
			}
			$blog->image=$image;
			$blog->save();

			ServiceController::uploadToElastic($blog);

			// sending back with message
			flash('Your Article was created successfully!', 'success');
			return redirect('/');

        }

        return view('/site/article-write',[
			'categories' =>ServiceController::getCategories()
        ]);
    }

    /**
     * displays edit-article page(just like create above)
     */
    public function articleEdit($id, Request $request)
    {
        $article= Articles::find($id);

        if (!empty($_POST)) {

			$image='';

			$article->update([
				'title'=>$_POST['title'],
				'description'=>$_POST['desc'],
				'text'=>$_POST['text'],
				'category_id'=>$_POST['category'],
				'updated_at'=>Carbon::now('Europe/Kiev')
			]);

			if ($request->hasFile('image')){

				$image=$request->image->store('public/images/articles');

				$article->update([
					'image'=>$image
				]);
			}

			Articles::editElastic($id, $_POST, $image);

			flash('Your Article was edited successfully!', 'success');
			return redirect('/profile/articles');

        }
        return view('/site/article-edit',[
                                    'article' => $article,
                                    'categories' => ServiceController::getCategories()
        ]);
    }

    /**
     * ajax-change status of article in profile/articles
     */
    public function articleStatus()
    {
        if (\Illuminate\Support\Facades\Request::ajax()) {

            $article = Articles::find($_GET['id']);
            $user = Auth::user();

            if ($article['user_id'] == $user['id'])

                if ($article->status == "Draft")
                    $article->status = "Published";
                 else
                    $article->status = "Draft";

                $article->save();


                return $article->status;
            } else {
                abort(403, 'You are not allowed to perform this action');
            }

    }

    /**
     * deletes article(from db and elastic)
     * can be used by both owner of article and an admin
     */
    public function articleDelete($id)
    {
        $article= Articles::find($id);
        $user = Auth::user();

        if ($article['user_id']==$user['id'] || $user->hasRole('admin')) {

            $article->delete();

            $client = ClientBuilder::create()->build();

            $params = [
                'index' => 'myblogs',
                'type' => 'myblogs',
                'id' => $id
            ];
            $client->delete($params);

            flash('Your Article was deleted successfully!', 'success');
            return redirect(url()->previous());
        } else {
            abort(403, 'You are not allowed to perform this action');
        }
    }


    /**
     *  when non-premium user attempts to read premium article - he's redirected to this page
     */
    public function articlePermissions(Request $request, $id)
    {
        $article=Articles::find($id);
        $request->session()->put('article_id', $article->id);

        return view('site.article-permission', ['article'=>$article]);
    }

    /**
     *  adds all articles in elasticSearch
     */
    public static function elastic()
    {
        $blogs=Articles::with('category')->get();

        foreach ($blogs as $blog) {
            ServiceController::uploadToElastic($blog);
        }
    }
}