<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Enquiry extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'address', 'status', 'phone_code', 'document_of_experience', 'certificate', 'created_at', 'updated_at'];

}
