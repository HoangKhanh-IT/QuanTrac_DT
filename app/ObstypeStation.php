<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObstypeStation extends Model
{
    //
    protected $table = "ObstypeStation";
    protected $fillable = ['id', 'stationid', 'obstypesid'];

    public $timestamps = false;
}
