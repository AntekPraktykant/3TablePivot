<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
