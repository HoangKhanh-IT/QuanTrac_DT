<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observationstation;

class Category extends Model
{
    //
    protected $table = "Category";

    protected $fillable = [
        'id', 'name'
    ];

    public $timestamps = false;

    public function Observationstations(){
        return $this->hasMany(Observationstation::class, 'categoryid','id');
    }
}
