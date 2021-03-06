<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function borrows(){
        return $this->hasMany('App\Borrow');
    }

}
