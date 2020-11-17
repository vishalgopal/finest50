<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $state_id
 * @property string $state
 * @property int $cl
 * @property int $pl
 * @property int $sl
 * @property int $country_id
 * @property int $is_default
 * @property int $is_active
 * @property int $sort_order
 * @property string $lang
 * @property string $active_for_register
 * @property string $govt_type
 * @property string $pt_applicable
 * @property string $lwf_applicable
 * @property string $created_at
 * @property string $updated_at
 */
class State extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['state_id', 'state', 'cl', 'pl', 'sl', 'country_id', 'is_default', 'is_active', 'sort_order', 'lang', 'active_for_register', 'govt_type', 'pt_applicable', 'lwf_applicable', 'created_at', 'updated_at'];

}
