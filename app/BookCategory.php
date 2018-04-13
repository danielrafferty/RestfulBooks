<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $table = "book_categories";
    protected $guarded = [];


    public function book()
    {
      return $this->belongsTo('App\Book','book_id','id');
    }

    public function category()
    {
      return $this->belongsTo('App\Category','category_id','id');
    }
}
