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
}
