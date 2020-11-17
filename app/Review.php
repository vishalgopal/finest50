<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $member_id
 * @property float $rating
 * @property string $review
 * @property int $approved
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 */
class Review extends Model
{
    public $timestamps = true;
    /**
     * @var array
     */
    protected $fillable = ['rating', 'review', 'approved', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('App\User', 'member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getRatingAttribute($value)
    {
        $first = floor($value);
        $second = ($value - $first) * 10;
        $third = 5 - ceil($value);
        $star = "";
        for($i = 1; $i<=$first; $i++)
            {
                $star .=  '<i class="icon-star3"></i>';
            }
        if($second >= 1)
            {
                $star .=  '<i class="icon-star-half-full"></i>';
            }
        for($k = 1; $k<=$third; $k++)
            {
                $star .=  '<i class="icon-star-empty"></i>';
            }

        return $star;
    }
}
