<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $contact
 * @property string $source
 * @property int $subscribed
 * @property string $created_at
 * @property string $updated_at
 */
class Newsletter extends Model
{
    /**
     * @var array
     */
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'contact', 'source', 'subscribed', 'created_at', 'updated_at'];

}
