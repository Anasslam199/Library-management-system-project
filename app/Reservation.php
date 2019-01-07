<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
      // use Illuminate\Database\Eloquent\SoftDeletes;
      use SoftDeletes;
      protected $dates = ['deleted_at'];

      public function book(){
      return $this->belongsTo('App\Book');
    }

    public function member(){
      return $this->belongsTo('App\Member');
    }
}
