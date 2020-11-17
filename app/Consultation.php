<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $member_id
 * @property int $comment
 * @property string $consultation_datetime
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 */
class Consultation extends Model
{
    /**
     * @var array
     */
    public $timestamps = true;
    protected $fillable = ['user_id', 'member_id', 'comment', 'consultation_datetime', 'created_at', 'updated_at'];

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
    public function member()
    {
        return $this->belongsTo('App\User', 'member_id');
    }
}
