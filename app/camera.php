<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class camera extends Model
{
    //
    protected $table = "Camera";
    protected $fillable  = ['ipaddress', 'name', 'stationid', 'username', 'pass', 'description'];

    public $timestamps = false;

    public function Observationstation()
    {
        return $this->belongsTo(Observationstation::class, 'stationid', 'id');
    }
}
