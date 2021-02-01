<?php

namespace App\Models;

use App\Scopes\GlobalScope;
use App\Scopes\GlobalScopeID;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use Sluggable;

    protected $table = 'posts';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GlobalScope);
        static::addGlobalScope(new GlobalScopeID);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopePost($query)
    {
        return $query->where('post_type', 'post');
    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function categoryOut()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id')->withoutGlobalScope(GlobalScope::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function userOut()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withoutGlobalScope(GlobalScope::class);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }

    public function approved_comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id')->whereStatus(1);
    }

    public function media()
    {
        return $this->hasMany('App\Models\PostMedia', 'post_id', 'id');
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }


}
