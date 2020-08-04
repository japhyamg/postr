<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['slug','title','body','user_id','coverimage'];


    public function author()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
