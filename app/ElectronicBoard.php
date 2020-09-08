<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElectronicBoard extends Model
{
    //
    protected $table = "ElectronicBoard";
    protected $fillable = ['name', 'stationid', 'coordx', 'coordy', 'note',];

    public $timestamps = false;

    public function Observationstation()
    {
        return $this->belongsTo(Observationstation::class, 'stationid', 'id');
    }
}
