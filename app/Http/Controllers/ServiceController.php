<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Elasticsearch\ClientBuilder;
use Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller {


    public function index()
    {
        return view('home');
    }

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
    public function actionLike()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {

            $owner_name=$_POST['type'];
            $owner_id=$_POST['id'];
            $user_id=Yii::$app->user->id;


            if (empty($query =Yii::$app->db->createCommand("SELECT * FROM tbl_rating WHERE owner_name='$owner_name' AND owner_id=$owner_id AND user_id=$user_id")->queryAll()))
            {
                Yii::$app->db->createCommand("INSERT INTO tbl_rating (owner_name, owner_id, user_id)
                                            VALUES ('$owner_name', $owner_id, $user_id)")->execute();


                $model=EventElastic::find()->where(['id'=>$owner_id])->one();
                $model->rating+=1;
                $model->update();


            }
            else
            {
                Yii::$app->db->createCommand("DELETE FROM tbl_rating WHERE owner_name='$owner_name' AND owner_id=$owner_id AND user_id=$user_id")->execute();

                $model=EventElastic::find()->where(['id'=>$owner_id])->one();
                $model->rating-=1;
                $model->update();

            }

            $likes = Rating::find()->where(['owner_id'=>$owner_id ])->andWhere(['owner_name'=>$owner_name])->count();

            return $likes;
        }
    }


    /**
     * on page load, by ajax shows comments of users if exists
     */
    public function actionShowComment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {

            $post = Yii::$app->request->post();

            $comments = Comment::find()->where(['owner_name'=>$post['type']])
                ->andWhere(['owner_id'=>$post['id']]);

            $comment = $comments->orderBy('created_at')
                ->with('commentAuthor')
                ->with('likes')
                ->asArray()
                ->all();

            return $comment;
        }
    }

    /**
     * onclick saves comment by ajax and shows it
     */
    public function actionSaveComment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {

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