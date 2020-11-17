<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $typeid_id
 * @property int $user_id
 */
class Upvote extends Model
{
    public $timestamps = true;
    /**
     * @var array
     */
    protected $fillable = ['typeid_id', 'user_id'];

}
