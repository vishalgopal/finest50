<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $subject_type
 * @property int $subject_id
 * @property string $description
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Flag extends Model
{
    /**
     * @var array
     */
    public $timestamps = true;
    protected $fillable = ['user_id','type', 'subject_type', 'subject_id', 'description', 'status', 'created_at', 'updated_at'];

}
