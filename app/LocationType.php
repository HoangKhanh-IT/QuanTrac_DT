<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationType extends Model
{
    //
    protected $table = "LocationType";

    protected $fillable = [
        'id', 'name'
    ];

    public $timestamps = false;

    public function Locations(){
        return $this->hasMany(Location::class,'locationtypeid','id');
    }
}
