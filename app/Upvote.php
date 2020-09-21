<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $typeid_id
 * @property int $user_id
 */
class Upvote extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['typeid_id', 'user_id'];

}
