<?php


namespace App\Models;

use Mindscms\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\Role','role_id','id');
    }

}
