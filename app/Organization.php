<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    protected $table = "Organization";
    protected $fillable = ['name', 'description'];

    public $timestamps = false;
}
