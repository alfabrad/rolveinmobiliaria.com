<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
  ];

  public function call() {
    return $this->belongsTo('App\Call');
  }
}
