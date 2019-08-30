<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roaming_active_user extends Model
{
    protected $table = 'T_ROAMING_ACTIVE_USERS';
    public $primaryKey = 'TADIG';
    public $incrementing = false;
    public $timestamps = false;
}
