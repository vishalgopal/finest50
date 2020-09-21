<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Overtrue\LaravelLike\Traits\Likeable;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $question
 * @property string $category
 * @property User $user
 * @property Answer[] $answers
 */
class Question extends Model
{
    use Sluggable;
    use Likeable;
    /**
     * @var array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = ['user_id', 'title', 'question', 'category'];

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
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
