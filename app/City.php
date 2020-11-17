<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $city_id
 * @property string $city
 * @property int $state_id
 * @property int $is_default
 * @property int $is_active
 * @property int $sort_order
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 */
class City extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['city_id', 'city', 'state_id', 'is_default', 'is_active', 'sort_order', 'lang', 'created_at', 'updated_at'];

}
