<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StdStation extends Model
{
    //
    protected $table = "StdStation";
    protected $fillable = ['id','stationid', 'standardParameterid'];
    public $timestamps = false;
}
