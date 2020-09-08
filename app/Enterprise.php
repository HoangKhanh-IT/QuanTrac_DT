<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    //
    protected $table = "Enterprise";
    protected $fillable = ['name', 'address', 'phone', 'type','tin','fax','email', 'accountNumber','active', 'employees', 'totalInvestment', 'profession', 'agent', 'title'];

    public $timestamps = false;
}
