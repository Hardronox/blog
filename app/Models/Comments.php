<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comments
 *
 * @property int $id
 * @property int $article_id
 * @property int $author_id
 * @property string $text
 * @property string $created_at
 * @property-read \App\Models\Articles $article
 * @property-read \App\Models\User $author
 * @property-read \App\Models\UsersProfile $authorProfile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Likes[] $likes
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comments whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comments whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comments whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comments whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comments whereText($value)
 * @mixin \Eloquent
 */
class Comments extends Model
{
    const UPDATED_AT = NULL;
    const CREATED_AT = NULL;

    public function article()
    {
        return $this->hasOne('App\Models\Articles','id', 'article_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes','type_id', 'id')->where('type','=','Comment');
    }

    public function author()
    {
        return $this->hasOne('App\Models\User','id', 'author_id');
    }

    public function authorProfile()
    {
        return $this->hasOne('App\Models\UsersProfile','user_id', 'author_id');
    }
}
