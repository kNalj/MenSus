<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    //

    public function users () {
        return $this->belongsToMany('App\users', 'users_classes');
    }
}
