<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table = "Unit";
    protected $fillable = ['id','code','name'];

    public $timestamps = false;
}
