<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class CreateBookTest extends TestCase
{
  private $headers = [];

  public function setUp()
  {
    parent::setUp();
    $user = factory(User::class)->create(['email' => 'user@test.com']);
    $token = $user->generateToken();
$this->headers = ['Authorization' => "Bearer $token"];
  }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatesValidBook()
    {
      $payload = [
            'title' => 'Modern PHP: New Features and Good Practices',
            'author' => 'Josh Lockhart',
            'categories' => ['PHP'],
            'price' => 18.99,
            'isbn' => "978-1491905012"
        ];

         $this->json('POST', '/api/books', $payload, $this->headers)
            ->assertStatus(201)
            ->assertJson([
              'title' => 'Modern PHP: New Features and Good Practices',
              'isbn' => "978-1491905012",
              'author_name' => 'Josh Lockhart',
              'categories' => ["PHP"],
            'price' => 18.99]);
    }

    public function testRejectsInvalidBook()
    {
      $payload = [
            'title' => 'Modern PHP: New Features and Good Practices',
            'author' => 'Josh Lockhart',
            'categories' => ['PHP'],
            'price' => 18.99,
            'isbn' => '978-INVALID-ISBN-1491905012'
        ];

        $this->json('POST', '/api/books', $payload, $this->headers)
            ->assertStatus(400)
            ->assertJson(['body' => 'Invalid ISBN']);
    }
}
