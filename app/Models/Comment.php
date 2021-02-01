<?php

namespace App\Models;

use App\Scopes\GlobalScope;
use App\Scopes\GlobalScopeID;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Comment extends Model
{

    protected $table = 'comments';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GlobalScope);
        static::addGlobalScope(new GlobalScopeID);
    }


    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

}
