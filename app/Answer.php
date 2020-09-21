<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

/**
 * @property int $id
 * @property int $question_id
 * @property int $user_id
 * @property string $answer
 * @property Question $question
 * @property User $user
 */
class Answer extends Model
{
    use Likeable;
    /**
     * @var array
     */
    protected $fillable = ['question_id', 'user_id', 'answer'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
