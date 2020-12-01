<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property string $details
 * @property string $start_date
 * @property string $end_date
 * @property string $created_at
 * @property string $updated_at
 */
class Promotion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['type','user_id', 'name', 'slug', 'description', 'image', 'details', 'start_date', 'end_date', 'created_at', 'updated_at'];
   /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
