<?php

namespace App\Models;

use App\Scopes\GlobalScope;
use App\Scopes\GlobalScopeID;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use Sluggable;

    protected $table = 'categories';
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
                'source' => 'name'
            ]
        ];
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'category_id', 'id');
    }


    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }


    public function scopeActive($query)
    {

        return $query->where('status', 1);
    }

}
