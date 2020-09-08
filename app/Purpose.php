<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StandardParameter;

class Purpose extends Model
{
    //
    protected $table= "Purpose";
    protected $fillable = ['id','name', 'description'];

    public $timestamps = false;
    public function standardParameters()
    {
        return $this->hasMany(StandardParameter::class, 'purposeid', 'id');
    }
}
