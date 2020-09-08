<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualityindex extends Model
{
    //
    protected $table = "Qualityindex";
    protected $fillable = ['name', 'belowvalue', 'abovevalue', 'colorcode', 'purpose'];

    public $timestamps = false;
}
