<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $country_id
 * @property string $country
 * @property string $nationality
 * @property boolean $is_default
 * @property boolean $is_active
 * @property int $sort_order
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 */
class Country extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['country_id', 'country', 'nationality', 'is_default', 'is_active', 'sort_order', 'lang', 'created_at', 'updated_at'];

}
