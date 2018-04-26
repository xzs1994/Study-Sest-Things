<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
//    public $timestamps = false;

    public function hasManyComments()
    {
        return $this->hasMany('App\Comment', 'article_id', 'id');
    }
}
