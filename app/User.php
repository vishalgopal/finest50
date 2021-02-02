<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Permission\Traits\HasRoles;
use Overtrue\LaravelLike\Traits\Liker;
use Overtrue\LaravelFollow\Followable;
use Laravel\Scout\Searchable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Overtrue\LaravelFavorite\Traits\Favoriter;

/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $mobile
 * @property int $otp_mobile
 * @property int $otp_email
 * @property string $email_verified_at
 * @property int $mobile_verified_at
 * @property string $password
 * @property string $avatar
 * @property string $provider
 * @property int $provider_id
 * @property string $access_token
 * @property string $remember_token
 * @property int $followers
 * @property int $stories
 * @property int $answers
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $pincode
 * @property string $address1
 * @property string $address2
 * @property string $short_description
 * @property string $long_description
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 * @property Answer[] $answers
 * @property Comment[] $comments
 * @property Question[] $questions
 */
class User extends Authenticatable implements HasMedia, Viewable
{
    use HasApiTokens, Notifiable;
    use Sluggable;
    use HasRoles;
    use Liker;
    use Followable;
    use Searchable;
    use HasMediaTrait;
    use InteractsWithViews;
    use Favoriter;
    public $timestamps = true;
    public $asYouType = true;
    /**
     * @var array
     */
    protected $fillable = ['latitude','longitude','response_time', 'response_rate', 'responses','display_mobile','display_email', 'images', 'videos','designation', 'company_name', 'qualification' ,'category_id', 'name', 'slug', 'email', 'mobile', 'otp_mobile', 'otp_email', 'email_verified_at', 'mobile_verified_at', 'password', 'avatar', 'provider', 'provider_id', 'access_token', 'remember_token', 'follower', 'stories', 'answers', 'country', 'state', 'city', 'pincode', 'address1', 'address2', 'short_description', 'long_description', 'created_at', 'updated_at','following'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'otp_mobile', 'otp_email', 'email_verified_at', 'mobile_verified_at', 'access_token' , 'created_at', 'updated_at'
    ];
    // TNT Search
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
    // Video Thumbnail Generator for medialibrary 
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
                ->width(480)
                ->height(360)
                ->nonQueued()
                ->performOnCollections('videos','photos');
    }
    // Mutator
    public function getAvatarAttribute($value)
    {
        if ($this->attributes['avatar'] != ''){
            // if not from URL
            if (strpos($this->attributes['avatar'], "http") === false){
                return env('APP_URL') . "/public/img/square/".$value;
            }
            else{
                // if contains URL
                return $value;
            }
        }
        else{
            // if No Image use generator
            return \Avatar::create($this->attributes['name'])->toBase64();
        }
        
    }

    public function getFollowerAttribute($value)
    {
        return thousandsCurrencyFormat($value);
    }

    public function getFollowingAttribute($value)
    {
        return thousandsCurrencyFormat($value);
    }

    public function getStoriesAttribute($value)
    {
        return thousandsCurrencyFormat($value);
    }

    public function getAnswersAttribute($value)
    {
        return thousandsCurrencyFormat($value);
    }

    public function getReviewsAttribute($value)
    {
        return thousandsCurrencyFormat($value);
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
    public function askquestions()
    {
        return $this->hasMany('App\AskQuestion');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
        ];
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // Avatar::create('SAmple NAme')->save('sample.png');
}
