<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parameter;
use App\Standard;
use App\Purpose;
use App\Unit;


class StandardParameter extends Model
{
    //
    protected $table = "StandardParameter";
    protected $fillable = ['id', 'standardid', 'parameterid', 'unitid', 'minvalue', 'maxvalue', 'purposeid', 'analysismethod'];
    public $timestamps = false;

    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standardid', 'id');
    }
    public function parameter()
    {
        return $this->belongsTo(Parameter::class, 'parameterid', 'id');
    }
    public function purpose()
    {
        return $this->belongsTo(Purpose::class, 'purposeid', 'id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unitid', 'id');
    }

    public function Observations(){
        return $this->hasMany(Observation::class, 'standardparameterid','id');
    }


}
