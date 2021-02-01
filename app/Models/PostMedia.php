<?php

namespace App\Models;

use App\Scopes\GlobalScopeID;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalScopeID);
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post','post_id','id');
    }
}
