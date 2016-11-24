<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticsearch\ClientBuilder;


class Blog extends Model
{
    protected $fillable = ['title', 'text', 'description', 'category_id','image'];

    /**
     * relations
     */
    public function category()
    {
        return $this->hasOne('App\Models\BlogCategory','id', 'category_id');
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
                    'image' =>$fileName
                ]
            ]
        ];

        $client->update($params);
    }
}
