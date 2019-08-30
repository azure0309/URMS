<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class threshold extends Model
{
  protected $table = 'REFERENCE_TRESHOLD';
  public $primaryKey = 'GROUP_ID';
  public $timestamps = false;
}
