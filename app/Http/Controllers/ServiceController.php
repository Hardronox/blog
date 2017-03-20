<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use App\Models\Articles;
use App\Models\Comments;
use App\Models\Likes;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Redis;
use Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ServiceController extends Controller
{
    /**
     * when someone opens /blog/123 page - he increments number of views
     */
    public static function views($source)
    {
		Redis::incr("article/{$source->id}/views");

        //increments views in elastic
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'myblogs',
            'type' => 'myblogs',
            'id' => $source->id,
            'body' => [
                'doc' => [
                    'views' => Redis::get("article/{$source->id}/views")
                ]
            ]
        ];

        $client->update($params);

		return Redis::get("article/{$source->id}/views");
    }


    /**
     * allows to like some content
     * onclick by ajax checks if current user liked content before
     * if yes - decreases number of like by 1
     * if no - increases by 1
     * updates it in DB and elastic
     */
    public function likes()
    {
        if (Request::ajax()) {

            $user = Auth::user();

            $likes=Likes::where(
                [
                    ['type','=',$_GET['type']],
                    ['type_id','=',$_GET['id']],
                    ['user_id','=',$user['id']]
                ])->first();

            if (!isset($likes)) {

                $like= new Likes();
                $like->type=$_GET['type'];
                $like->type_id=$_GET['id'];
                $like->user_id=$user['id'];
                $like->save();
            } else {
                $likes->delete();
            }

            $likes = Likes::where([
                    ['type','=',$_GET['type']],
                    ['type_id','=',$_GET['id']]
                ])->count();

            return $likes;
        }
    }


    /**
     * returns array of categories for Select in create and update actions
     */
    public static function getCategories()
    {
        $categoriesSelect=[];

        $categoryDb= ArticleCategory::get(['name'])->toArray();

        $category=array_flatten($categoryDb);

        foreach ($category as $key=> $cat) {
            $categoriesSelect[$key+1]=$cat;
        }
        return $categoriesSelect;
    }


    /**
     * on page load, by ajax shows comments of users if exists
     */
    public function showComments()
    {
        if (Request::ajax()) {
            $comments = Comments::with(['authorProfile','likes'])
								->where('article_id','=',ServiceController::getArticleBySlug($_POST['slug']))
                                ->orderBy('created_at', 'asc')
								->get();

            return $comments;
        }
    }

    /**
     * onclick saves comment by ajax and shows it
     */
    public function saveComment()
    {
        if (Request::ajax()) {

            $user = Auth::user();

            $comment = new Comments();
            $comment->text=$this->filterComment($_POST['text']);
            $comment->article_id=ServiceController::getArticleBySlug($_POST['slug']);
            $comment->author_id=$user['id'];
            $comment->created_at=Carbon::now('Europe/Kiev');
            $comment->save();

            $response_comment = Comments::with(['authorProfile','likes'])->where('id','=',$comment->id)->first();

            return $response_comment;
        }
    }

    /**
     * saves single article in elastic
     */
    public static function uploadToElastic($src)
    {
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'myblogs',
            'type' => 'myblogs',
            'id' => (int)$src->id,
            'body' => [
                'id'=>(int)$src->id,
                'title' => $src->title,
                'slug' => $src->slug,
                'description'=>$src->description,
                'text'=>$src->text,
				'premium'=>$src->premium,
				'category'=>$src->category->name,
                'views'=>0,
                'image'=>str_replace('public/', '', $src->image),
                'status'=>$src->status,
                'created_at'=>$src->created_at
            ]
        ];
        $client->index($params);
    }

    /**
     * filters comment input
     */
    public static function filterComment($text)
    {
        $first = preg_replace('/<script/', '&lt;script', $text);
        $final = strip_tags(preg_replace('/<\/script>/', '&lt;/script>', $first));

        return $final;
    }

	public static function getArticleBySlug($slug)
	{
		$article= Articles::where('slug','=',$slug)->first();

		return $article->id;
	}
}