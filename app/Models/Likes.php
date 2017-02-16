<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Likes
 *
 * @property int $id
 * @property string $type
 * @property int $type_id
 * @property int $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Likes whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Likes whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Likes whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Likes whereUserId($value)
 * @mixin \Eloquent
 */
class Likes extends Model
{
    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;
}
