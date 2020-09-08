<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basin extends Model
{
    //
    protected $table = "Basin";
    protected $fillable = ['id', 'riverid', 'name', 'parentriverbasinid', 'master', 'purpose', 'surfaceareanwt', 'netcapacity', 'deadcapacity', 'risingofnormalwaterlevel', 'deadwaterlevel', 'beginning', 'termini', 'length', 'riverbasinarea', 'averageflowrate', 'capacity', 'normalwaterlevel', 'standard', 'description'];
    public $timestamps = false;

    public function Basin()
    {
        return $this->hasMany(Basin::class);
    }
    public function childrenBasins()
    {
        return $this->hasMany(Basin::class)->with('Basin');
    }

}
