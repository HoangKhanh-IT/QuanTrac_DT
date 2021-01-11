<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_permission extends Model
{
    //
    protected $table = "role_permission";

    protected $fillable = [
            'id', 'role_id', 'permission_id'
        ];
}
