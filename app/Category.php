<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $guarded = [];


    public function books()
    {
      return $this->hasManyThrough('App\Book','App\BookCategory','book_id','id','id');
    }
}
