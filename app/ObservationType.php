<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Standard;
use App\ObstypeStation;

class ObservationType extends Model
{
    //
    protected $table = "ObservationType";

    protected $fillable = [
        'id', 'name', 'code', 'parentid'
    ];

    public $timestamps = false;

    public function ObstypeStations()
    {
        return $this->hasMany(ObstypeStation::class, 'obstypesid','id');
    }
    public function childrenObservationTypes()
    {
        return $this->hasMany(ObservationType::class)->with('ObservationType');
    }

    public function Standards(){
        return $this->hasMany(Standard::class, 'obstypeid','id');
    }
}
