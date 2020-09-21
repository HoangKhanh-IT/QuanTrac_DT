<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    //
    protected $table = "Parameter";
    protected $fillable = ['id','code','name'];

    public $timestamps = false;

    public function standardParameters()
    {
        return $this->hasMany(StandardParameter::class, 'parameterid', 'id');
    }
}
