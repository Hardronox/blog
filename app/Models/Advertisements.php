<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Advertisement
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $website
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @mixin \Eloquent
 */
class Advertisements extends Model
{
    const UPDATED_AT = NULL;
}
