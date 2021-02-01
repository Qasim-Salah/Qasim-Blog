<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Sluggable;

    protected $table = 'posts';
    protected $guarded = [];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function scopePage($query)
    {
        return $query->where('post_type', 'page');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
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
