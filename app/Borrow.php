<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    protected $dates = ['deleted_at'];
    public function book(){
      return $this->belongsTo('App\Book');
    }

    public function member(){
      return $this->belongsTo('App\Member');
    }
}
