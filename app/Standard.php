<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ObservationType;
use App\StandardParameter;


class Standard extends Model
{
    //
    protected $table = "Standard";
    protected $fillable =['id','name', 'symbol', 'obstypeid', 'dateoflssue','organization','attachment'];

    public $timestamps = false;

    public function observationType(){
        return $this->belongsTo(ObservationType::class, 'obstypeid','id');
    }
    public function standardParameters(){
        return $this->hasMany(StandardParameter::class, 'standardid','id');
    }
}
