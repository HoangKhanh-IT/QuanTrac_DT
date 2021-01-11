<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;

class Menus extends Model
{
    //
    protected $table = "menus";

    protected $fillable = [
        'id', 'name', 'title', 'parent_id','description','oder','code','Link',
    ];
    public $timestamps = false;

    public function childs()
    {
        return $this->hasMany('App\Menus', 'parent_id', 'id');
    }

    public function Menus(){
        return $this->hasMany('App\permission','menus_id','id');
    }

    public function Permissions()
    {
        return $this->hasMany('App\permission', 'menus_id', 'id');
    }
}
