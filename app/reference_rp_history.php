<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reference_rp_history extends Model
{
      protected $table = 'REFERENCE_RP_HISTORY';
      public $primaryKey = 'TADIG';
      public $timestamps = false;
      public $incrementing = false;
}
