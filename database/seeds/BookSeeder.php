<?php

use Illuminate\Database\Seeder;

use App\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $book_references = [];

      $book_references[] = ['title' => "Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5",
      'author' => 'Robin Nixon',
      'categories' => ['PHP','Javascript'],
      'isbn' => "978-1491918661",
      'price' => 9.99 ];

      $book_references[] = [
        'title' => "Ubuntu: Up and Running: A Power User's Desktop Guide",
        'author' => 'Robin Nixon',
        'categories' => ['Linux'],
        'isbn' => "978-0596804848",
        'price' => 12.99];

        $book_references[] = [
          'title' => 'Linux Bible',
          'author' => 'Christopher Negus',
          'categories' => ['Linux'],
          'isbn' => "978-1118999875",
          'price' => 19.99
        ];

        $book_references[] = [
          'title' => 'JavaScript: The Good Parts',
          'author' => 'Douglas Crockford',
          'categories' => ['Javascript'],
          'isbn' => "978-0596517748",
          'price' => 8.99
        ];

      foreach($book_references as $book_reference){
        $book = Book::store(
        ['title' => $book_reference['title'],
        'isbn' => $book_reference['isbn'],
        'author' => $book_reference['author'],
        'price' => $book_reference['price'],
        'categories' => $book_reference['categories']
      ]);

}
}
}
