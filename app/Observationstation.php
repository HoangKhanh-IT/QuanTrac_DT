<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ObstypeStation;
use App\ObservationType;
use App\Location;
use App\Enterprise;
use App\Organization;
use App\Basin;
use App\StdStation;

class Observationstation extends Model
{
    //
    protected $table = "Observationstation";
    protected $primaryKey = 'id';
    protected $fillable = ['id','code','name', 'organizationid', 'categoryid', 'coordx', 'coordy', 'basinid', 'enterpriseid', 'districtid', 'locationid', 'establishdate', 'terminatedate', 'maintenance', 'note', 'active', 'ftpusername', 'ftppassword'];

    public $timestamps = false;

    public function ObservationTypes(){
        //return $this->hasMany(ObstypeStation::class, 'stationid','id');
        return $this->belongsToMany(ObservationType::class, 'ObstypeStation', 'stationid', 'obstypesid');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'categoryid', 'id');
    }

    public function Location(){
        return $this->belongsTo(Location::class,'locationid','id');
    }

    public function District(){
        return $this->belongsTo(District::class,'districtid','id');
    }

    public function Enterprise()
    {
        return $this->belongsTo(Enterprise::class, 'enterpriseid', 'id');
    }

    public function Organization()
    {
        return $this->belongsTo(Organization::class, 'organizationid', 'id');
    }

    public function Basin()
    {
        return $this->belongsTo(Basin::class, 'basinid', 'id');
    }

    public function StandardParameters()
    {
        return $this->belongsToMany(StandardParameter::class, 'StdStation', 'stationid', 'standardparameterid');
    }

    public function Observations(){
        return $this->hasMany(Observation::class, 'stationid','id');
    }

    public function Cameras(){
        return $this->hasMany(Camera::class, 'stationid','id');
    }

    public function ElesctronicBoards(){
        return $this->hasMany(ElectronicBoard::class, 'stationid','id');
    }


}
