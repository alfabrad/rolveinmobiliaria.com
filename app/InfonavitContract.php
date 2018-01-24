<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfonavitContract extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'type',
    'certified_birth_certificate',
    'official_ID',
    'curp',
    'rfc',
    'spouses_birth_certificate',
    'official_identification_of_the_spouse',
    'marriage_certificate',
    'credit_simulator',
    'credit_application',
    'tax_valuation',
    'bank_statement',
    'workshop_knowing_how_to_decide',
    'retention_sheet',
    'credit_activation',
    'credit_maturity',
    'complete',
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
  protected $dateFormat = 'Y-m-d h:i:s';

  public function contract ()
  {
    return $this->hasOne('App\SaleContract', 'id');
  }
}
