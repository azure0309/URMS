<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reference extends Model
{
  protected $table = 'REFERENCE_BACKUP';
  public $primaryKey = 'TADIG';
  public $incrementing = false;
  public $timestamps = false;
}
