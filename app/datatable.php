<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datatable extends Model
{
    protected $table = 'DB_TEST';
    public $primaryKey = 'id';
    public $timestamps = false;
}
