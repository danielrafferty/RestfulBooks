<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = "authors";
    protected $guarded = [];


    public function books()
    {
      return $this->hasMany('App\Book','author_id','id');
    }

    public function getNameAttribute()
    {
      return $this->first_name." ".$this->surname;
    }
}
