<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reference extends Model
{
  protected $table = 'REFERENCE_RP_CURRENT';
  public $primaryKey = 'TADIG';
  public $incrementing = false;
  public $timestamps = false;
}
