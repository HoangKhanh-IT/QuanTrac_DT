<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\Menus;

class Permission extends Model
{
    //
    protected $table = "permissions";
    protected  $fillable = ['id','name','display_name','menus_id'];
    public function Roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }

    public function Menu()
    {
        return $this->belongsTo(Menus::class, 'menus_id','id');
    }

}
