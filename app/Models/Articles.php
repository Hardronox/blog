<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticsearch\ClientBuilder;
use Illuminate\Database\Query\Builder;


/**
 * App\Models\Articles
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property bool $category_id
 * @property int $views
 * @property string $image
 * @property string $status
 * @property bool $premium_content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\ArticleCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Likes[] $likes
 * @method static Builder|\App\Models\Articles whereCategoryId($value)
 * @method static Builder|\App\Models\Articles whereCreatedAt($value)
 * @method static Builder|\App\Models\Articles whereDescription($value)
 * @method static Builder|\App\Models\Articles whereId($value)
 * @method static Builder|\App\Models\Articles whereImage($value)
 * @method static Builder|\App\Models\Articles wherePremiumContent($value)
 * @method static Builder|\App\Models\Articles whereStatus($value)
 * @method static Builder|\App\Models\Articles whereText($value)
 * @method static Builder|\App\Models\Articles whereTitle($value)
 * @method static Builder|\App\Models\Articles whereUpdatedAt($value)
 * @method static Builder|\App\Models\Articles whereUserId($value)
 * @method static Builder|\App\Models\Articles whereViews($value)
 * @mixin \Eloquent
 */
class Articles extends Model
{
    protected $fillable = ['title', 'text', 'description', 'category_id','image'];

    /**
     * relations
     */
    public function category()
    {
        return $this->hasOne('App\Models\ArticleCategory','id', 'category_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes','type_id', 'id')->where('type','=','Blog');
    }


    public static function editElastic($id, $src, $fileName)
    {
        $client = ClientBuilder::create()->build();

        switch($src['category'])
        {
            case 1:
                $category='Backend';
                break;
            case 2:
                $category='Frontend';
                break;
            case 3:
                $category='Design';
                break;
        }

        if($fileName=='')
        {
            $params = [
                'index' => 'myblogs',
                'type' => 'myblogs',
                'id' => $id,
                'body' => [
                    'doc' => [
                        'title'=>$src['title'],
                        'description'=>$src['desc'],
                        'text'=>$src['text'],
                        'category'=>$category
                    ]
                ]
            ];
        }
        else
        {
            $params = [
                'index' => 'myblogs',
                'type' => 'myblogs',
                'id' => $id,
                'body' => [
                    'doc' => [
                        'title'=>$src['title'],
                        'description'=>$src['desc'],
                        'text'=>$src['text'],
                        'category'=>$category,
                        'image' =>str_replace('public/', '', $fileName)
                    ]
                ]
            ];
        }


        $client->update($params);
    }
}
