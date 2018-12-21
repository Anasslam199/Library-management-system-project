<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    public function book(){
      return $this->belongsTo('App\Book');
    }

    public function member(){
      return $this->belongsTo('App\Member');
    }
}
