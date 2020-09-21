<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $int
 * @property string $title
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $latitude
 * @property string $longitude
 * @property string $pincode
 * @property string $google_location
 * @property string $created_at
 * @property string $updated_at
 */
class Location extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'int';

    /**
     * @var array
     */
    protected $fillable = ['title', 'city', 'state', 'country', 'latitude', 'longitude', 'pincode', 'google_location', 'created_at', 'updated_at'];

}
