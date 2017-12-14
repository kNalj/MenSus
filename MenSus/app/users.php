<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class users extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;

    public function classes () {
        return $this->belongsToMany('App\classes', 'users_classes');
    }
}
