<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phone_code
 * @property string $phone
 * @property string $subject
 * @property int $category_id
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 */
class Lead extends Model
{
    public $timestamps = true;
    /**
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'email', 'phone_code', 'phone', 'subject', 'category_id', 'message', 'created_at', 'updated_at'];

}
