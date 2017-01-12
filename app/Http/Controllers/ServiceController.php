<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\Articles;
use App\Models\Comments;
use App\Models\Likes;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\DB;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ServiceController extends Controller
{

    public static function views($source)
    {
        //increments views in DB
        $source->views+=1;
        $source->save();

        //increments views in elastic
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'myblogs',
            'type' => 'myblogs',
            'id' => $source->id,
            'body' => [
                'doc' => [
                    'views' => $source->views
                ]
            ]
        ];

        $client->update($params);
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
        if (Request::ajax())
        {
//            $user = Auth::user();
//
//            $type=$_GET['type'];
//            $type_id=intval($_GET['id']);
//            $user_id=$user['id'];
//            $results = DB::select("select type_id from likes where type='$type' AND type_id=$type_id AND user_id=$user_id");

//            var_dump('<pre>', $results, '</pre>');
//            exit;
//
//            $likes=Likes::where(
//                [
//                    ['type','=',$_GET['type']],
//                    ['type_id','=',$_GET['id']],
//                    ['user_id','=',$user['id']]
//                ])->first();
//
////            var_dump('<pre>', $likes, '</pre>');
////            exit;
//
//            if ($likes===NULL)
//            {
//                $like= new Likes();
//                $like->type=$_GET['type'];
//                $like->type_id=$_GET['id'];
//                $like->user_id=$user['id'];
//                $like->save();
//            }
//            else
//            {
//                $likes->delete();
//            }
//
//            $likes = Likes::where(
//                [
//                    ['type','=',$_GET['type']],
//                    ['type_id','=',$_GET['id']]
//                ])->count();




            return rand(0,2);
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
        if (Request::ajax())
        {
            $comments = Comments::with(['commentAuthor','likes'])->where('article_id','=',$_POST['article_id'])
                                ->orderBy('created_at', 'asc')->get();

            return $comments;
        }
    }

    /**
     * onclick saves comment by ajax and shows it
     */
    public function saveComment()
    {
        if (Request::ajax())
        {
            $user = Auth::user();

            $comment = new Comments();
            $comment->comment_text=$_POST['text'];
            $comment->article_id=$_POST['id'];
            $comment->author_id=$user['id'];
            $comment->created_at=Carbon::now('Europe/Kiev');
            $comment->save();

            $response_comment = Comments::with(['commentAuthor','likes'])->where('id','=',$comment->id)->first();

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
                'description'=>$src->description,
                'text'=>$src->text,
                'category'=>$src->category->name,
                'views'=>(int)$src->views,
                'image'=>$src->image ? $src->image : NULL,
                'status'=>'Published',
                'created_at'=>$src->created_at
            ]
        ];
        $client->index($params);
        

    }

    /**
     * filters inputs
     */
    public static function filter($text)
    {
        $out = strip_tags(Html::decode($text));
        $out = preg_replace('#<script[^>]*>.*?</script>#is', '', $out);
        $out = trim(html_entity_decode($out), chr(0xC2).chr(0xA0));

        return $out;
    }

    /**
     * filters inputs
     */
    public static function filterMainText($text)
    {
        $main_text = preg_replace('#<script[^>]*>.*?</script>#is', '', $text);

        return $main_text;
    }


}