<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{

  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public function theme()
  {
      return $this->belongsTo('App\Theme');
  }

  public function borrows()
  {
      return $this->HasMany('App\Borrow');
  }

  public function reservations()
  {
      return $this->HasMany('App\Reservation');
  }

}
