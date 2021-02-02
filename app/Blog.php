<?php

namespace App;
use App\Comments;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;


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
class Blog extends Model implements Viewable
{
    use Likeable;
    use Searchable;
    use Sluggable;
    use SoftDeletes;
    use InteractsWithViews;
    use Favoriteable;
    
    protected $touches = ['category'];
    // public $asYouType = true;
    public $timestamps = true;
    /**
     * @var array
     */
    protected $fillable = ['category_id', 'trending', 'featured', 'status', 'user_id', 'title', 'slug','image', 'description', 'created_at', 'updated_at'];
    protected $appends = array('comment_count');

        /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        // $array = $this->transform($array);

        // $array['category_name'] = $this->category['name'];
        // $array['category_slug'] = $this->category->slug;
        return $array;
    }
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
