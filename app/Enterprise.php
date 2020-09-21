<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    //
    protected $table = "Enterprise";
    protected $fillable = ['name', 'address', 'phone', 'type','tin','fax','email', 'accountNumber','active', 'employees', 'totalInvestment', 'profession', 'agent', 'title'];

    public $timestamps = false;

    public function Observationstations(){
        return $this->hasMany(Observationstation::class, 'enterpriseid','id');
    }

    public function DischargePoints(){
        return $this->hasMany(DischargePoint::class, 'enterpriseid','id');
    }
}
