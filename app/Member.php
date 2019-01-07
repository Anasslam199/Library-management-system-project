<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $dates = ['deleted_at'];

    public function borrows(){
        return $this->hasMany('App\Borrow');
    }

    public function reservations()
    {
        return $this->HasMany('App\Reservation');
    }

    public function user()
    {
      return $this->hasOne('App\User');
    }

}
