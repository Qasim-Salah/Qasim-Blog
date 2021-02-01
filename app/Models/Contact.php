<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Contact extends Model
{


    protected $table = 'contacts';
    protected $guarded = [];

    public function status()
    {
        return $this->status == 1 ? 'Read' : 'New';
    }

}
