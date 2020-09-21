<?php

namespace App;
use App\Comments;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

/**
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 * @property Comment[] $comments
 */
class Blog extends Model
{
    use Likeable;
    /**
     * @var array
     */
    protected $fillable = ['category_id', 'user_id', 'title', 'slug', 'description', 'created_at', 'updated_at'];
    protected $appends = array('comment_count');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getCommentCountAttribute()
    {
        $count = Comment::where('blog_id', $this->id)->count();
        return  $count;
    }
}
