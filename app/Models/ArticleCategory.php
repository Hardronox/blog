<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ArticleCategory
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ArticleCategory whereName($value)
 * @mixin \Eloquent
 */
class ArticleCategory extends Model
{
    protected $table= 'article_category';
}
