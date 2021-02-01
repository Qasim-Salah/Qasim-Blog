<?php

namespace App\Models;

use App\Scopes\GlobalScope;
use App\Scopes\GlobalScopeID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,  Notifiable,EntrustUserWithPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     *
     *
     * @var array
     */
    protected $table = 'users';
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GlobalScope);
        static::addGlobalScope(new GlobalScopeID);
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.' . $this->id;
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }

    public function status()
    {
        return $this->status == '1' ? 'Active' : 'Inactive';
    }

    public function userImage()
    {
        return $this->user_image != '' ? asset('assets/users/' . $this->user_image) : asset('assets/users/default.png');
    }

}
