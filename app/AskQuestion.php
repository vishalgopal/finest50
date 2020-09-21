<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $fullname
 * @property string $phone
 * @property string $question
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 * @property User $user
 */
class AskQuestion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'category_id', 'fullname', 'phone', 'question', 'created_at', 'updated_at'];

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
}
