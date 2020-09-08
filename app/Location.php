<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table ="Location";
    protected $fillable = ['id','name','locationtypeid','note'];

    public $timestamps = false;

    public function LocationType(){
        return $this->belongsTo(LocationType::class,'locationtypeid','id');
    }
}
