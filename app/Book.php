<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BookCategory;
use App\Author;
use App\Category;

class Book extends Model
{
    protected $table = "books";
    protected $guarded = [];
    protected $appends = ['categories','author_name'];


    public function categoryReferences()
    {
      return $this->hasMany('App\BookCategory','book_id','id');
    }

    public function author()
    {
      return $this->belongsTo('App\Author','author_id','id');
    }


    public static function store(Array $data)
    {
      $author_names = explode(" ",$data['author']);

      $first_name = array_shift($author_names);
      $surname = implode(" ",$author_names);

      $author = Author::firstOrCreate(['first_name' => $first_name],['surname' =>
    $surname]);

    $book = Book::create(
    ['title' => $data['title'],
    'isbn' => $data['isbn'],
    'author_id' => $author->id,
    'price' => $data['price']
    ]);

    $book->linkCategories($data['categories']);

    return $book->fresh();

    }

    public function getCategoriesAttribute()
    {
      $categories = [];
       $this->categoryReferences->each(function($reference) use(&$categories){
      $categories[] = $reference->category->name;
      });

      return $categories;
  }

  public function getAuthorNameAttribute()
  {
    return $this->author->name ?? "NO AUTHOR";
  }


    public function linkCategories($categories)
    {
      foreach($categories as $category_name){
        $category = Category::firstOrCreate(['name' => $category_name]);
        BookCategory::firstOrCreate(['category_id' => $category->id,
      'book_id' => $this->id]);
      }
    }
}
