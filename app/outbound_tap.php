<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class outbound_tap extends Model
{
    protected $table = 'ABA_RM_OUB_USAGE';
    // public $primaryKey = 'id';
    public $timestamps = false;
}
