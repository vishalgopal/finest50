<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Laravel\Scout\Searchable;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $parent
 * @property string $description
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property Blog[] $blogs
 * @property User[] $users
 */
class Category extends Model
{
    use Likeable;
    use Searchable;
    public $timestamps = true;
    /**
     * @var array
     */
    protected $fillable = ['title', 'slug', 'parent', 'description', 'image', 'created_at', 'updated_at'];
    protected $appends = ['peers'];
    protected $casts = [
        'peers' => 'array',
    ];
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function children() {
        return $this->hasMany(Category::class,'parent');
    }
   
    public function parent() {
        return $this->belongsTo(Category::class,'parent');
    }

    public function getPeersAttribute($value)
    {
        if ($this->attributes['parent'] == 0){
            $categories = Category::where('parent', $this->attributes['id'])->select('id')->get();
            return ($categories->pluck('id'))->push($this->attributes['id']);
        }
        else{
            $categories = Category::where('parent', $this->attributes['parent'])->select('id')->get();
            return ($categories->pluck('id'))->push($this->attributes['parent']);
        }
        
    }
}
