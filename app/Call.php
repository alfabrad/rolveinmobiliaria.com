<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Call extends Model
{
  use SoftDeletes;

  /**
   * The attributes that represents the models who has relationship with
   *
   * @var array
   */
  protected $with = ['internal_expedient', 'user', 'state'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'type_of_operation',
    'internal_expedient_id',
    'address',
    'state_id',
    'observations',
    'status',
    'priority',
  ];

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];

  /**
   * The storage format of the model's date columns.
   *
   * @var string
   */
  protected $dateFormat = 'Y-m-d H:i:s';

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'created_at' => 'datetime:Y-M-d h:i a',
    'updated_at' => 'datetime:Y-M-d h:i a',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function client()
  {
    return $this->belongsTo('App\Client');
  }

  public function state()
  {
    return $this->belongsTo('App\State');
  }

  public function internal_expedient()
  {
    return $this->belongsTo('App\InternalExpedient');
  }

  public function getHourAttribute()
  {
    $date = $this->created_at->format('h:i');

    return $date.' hrs';
  }
}
