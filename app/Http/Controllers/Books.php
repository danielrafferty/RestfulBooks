<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Category;
use App\BookCategory;

class Books extends Controller
{
    public function index()
    {
      return Book::all();
    }

    public function show(Book $book)
    {
      return response()->json($book,200);
    }

    public function store(Request $request)
    {
      $rules = [
        'title' => 'bail|required|string',
        'isbn' => 'bail|required|string|unique:books',
        'author' => 'bail|required|string',
        'categories.*' => 'bail|required|string',
        'price' => 'bail|required|numeric'
      ];
      $this->validate($request,$rules);

      $test_isbn = preg_replace('/(\s+|:|-)/', '', $request->isbn);
      if ( !preg_match ("/^\d{12}(?:\d|X)$/",$test_isbn)){
    return response()->json(['body' => "Invalid ISBN"],400);
      }

      $book = Book::store($request->all());
      return response()->json($book->load('author'),201);
    }

    public function update(Request $request, Book $book)
    {
      $book->update($request->all());
      return response()->json($book,200);
    }

    public function delete(Book $book)
    {
      $book->delete();
      return response()->json(null,204);
    }

    public function filter(Request $request)
    {
      $books = Book::with('author','categoryReferences');

      if($request->exists('author')){
        $books = $this->filteringAuthor($books,$request->author);
      }

      if($request->exists('category')){
        $books = $this->filteringCategory($books,$request->category);
      }

      return response()->json($books->get(),200);
    }

    private function filteringCategory($query,$category_name)
    {
      $category = Category::where('name',$category_name)->first();

      $book_references = BookCategory::where('category_id',$category->id)->get();

      $book_ids = [];
      foreach($book_references as $book){
        $book_ids[] = $book->book_id;
      }

      return $query->whereIn('id',$book_ids);
    }

    private function filteringAuthor($query,$author_name)
    {
      $author_names = explode(" ",$author_name);
      $first_name = array_shift($author_names);
      $surname = implode(" ",$author_names);

      $author = Author::where('first_name',$first_name)->where('surname',$surname)->first();

      $query->where('author_id',$author->id);

      return $query;
    }
}
