<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    protected $table = "Observation";

    protected $fillable = [
        'id', 'time', 'day', 'stationid', 'sampleid','qualityindexid', 'standardparameterid', 'value','note', 'detail'
    ];

    public $timestamps = false;

    
}
