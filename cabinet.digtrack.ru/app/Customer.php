<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public $timestamps = false;

    public function positionName(){
        return $this->hasOne('App\Position', 'user_id', 'id');
    }

    public function departmentName(){
        return $this->hasOne('App\Department', 'user_id', 'id');
    }
}
