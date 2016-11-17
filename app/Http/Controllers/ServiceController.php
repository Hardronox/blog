<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Comments;
use App\Models\Likes;
use Elasticsearch\ClientBuilder;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

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
            $user = Auth::user();

            $likes=Likes::where(
                [
                    ['type','=',$_GET['type']],
                    ['type_id','=',$_GET['id']],
                    ['user_id','=',$user['id']]
                ])->get();

            if (sizeof($likes)===0)
            {
                $like= new Likes();
                $like->type=$_GET['type'];
                $like->type_id=$_GET['id'];
                $like->user_id=$user['id'];
                $like->save();
            }
            else
            {
                Likes::where(
                [
                    ['type','=',$_GET['type']],
                    ['type_id','=',$_GET['id']],
                    ['user_id','=',$user['id']]
                ])->delete();
            }

            $likes = Likes::where(
                [
                    ['type','=',$_GET['type']],
                    ['type_id','=',$_GET['id']]
                ])->count();

            return $likes;
        }
    }


    /**
     * on page load, by ajax shows comments of users if exists
     */
    public function showComments()
    {
        if (Request::ajax())
        {

            $comments = Comments::where('blog_id','=',$_POST['blog_id'])
                                ->orderBy('created_at', 'asc')->get();

            return $comments;
        }
    }

    /**
     * onclick saves comment by ajax and shows it
     */
    public function actionSaveComment()
    {
        if (Request::ajax())
        {
            $post = Yii::$app->request->post();
            if (isset($post['text']))
            {
                $model = new Comment();
                $model->comment_text=$post['text'];
                $model->owner_name=$post['type'];
                $model->owner_id=$post['id'];
                $model->creator_id=Yii::$app->user->id;
                $model->created_at=mktime();
                $model->save();
            }

            $comments = Comment::find()->where(['id'=>$model->id])
                ->andWhere(['owner_id'=>$post['id']]);

            $comment = $comments
                ->with(['likes','commentAuthor'])
                ->asArray()
                ->one();

            return $comment;
        }
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