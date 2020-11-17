<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $blog_id
 * @property int $user_id
 * @property string $comment
 * @property int $parent_comment
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Blog $blog
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['blog_id', 'user_id', 'comment', 'parent_id', 'created_at', 'updated_at'];
    protected $appends = array('userinfo');
    public $timestamps = true;
    public function getUserinfoAttribute()
    {
        $user = User::select('name','slug','id','avatar')->where('id', $this->user_id)->first();
        return  $user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }

    public function children() {
        return $this->hasMany(Comment::class,'parent_id');
    }
    public function parent() {
        return $this->belongsTo(Comment::class,'parent_id');
    }
}
