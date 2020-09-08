<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    //
    protected $table = "CategoryPost";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'name','slug','desc','status','keywords','order','parentcateid'
    ];

    public $timestamps = false;

    public function CategoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }
    public function childrenCategoryPosts()
    {
        return $this->hasMany(CategoryPost::class)->with('CategoryPost');
    }

}
