<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryPost;

class Post extends Model
{
    protected $table = "Post";
    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'title','slug','desc','contents','status','metakeywords','image','imagedesc',
        'imagealign', 'imagewidth','imageheight','catepostid','authors','sources','totalviews',
        'priority','isfocus','usercreate', 'createdate','usermodify','editdate'
    ];

    public $timestamps = false;

 	public function CategoryPost()
    {
        return $this->belongsTo(CategoryPost::class, 'catepostid', 'id');
    }
}
