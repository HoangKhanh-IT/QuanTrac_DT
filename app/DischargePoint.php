<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DischargePoint extends Model
{
    // 
    protected $table = "DischargePoint";
    protected $fillable = ['id', 'basinid',  'enterpriseid', 'decisionnumber', 'licensedate', 'period', 'establishmentname', 'location', 'operatingtime', 'dischargemethod', 'flowrate', 'coordx', 'coordy', 'sourcereception', 'licensetype', 'licenseterm', 'note', 'standardid'];
    public $timestamps = false;

    public function Basin()
    {
        return $this->belongsTo(Basin::class, 'basinid', 'id');
    }

    public function Enterprise(){
        return $this->belongsTo(Enterprise::class,'enterpriseid','id');
    }

    public function Standard()
    {
        return $this->belongsTo(Standard::class, 'standardid', 'id');
    }

}
