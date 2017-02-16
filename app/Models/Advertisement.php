<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Advertisement
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $website
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement whereWebsite($value)
 * @mixin \Eloquent
 */
class Advertisement extends Model
{
    const UPDATED_AT = NULL;
}
