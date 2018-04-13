<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class FilterTest extends TestCase
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
    public function testFilterByAuthor()
    {
      $first_payload = ['author' => "Robin Nixon"];
      $this->json('GET', '/api/books/filter', $first_payload, $this->headers)
          ->assertStatus(200)
          ->assertJsonFragment(['isbn' => "978-1491918661"])
          ->assertJsonFragment(['isbn' => '978-0596804848']);

      $second_payload = ['author' => "Christopher Negus"];
      $this->json('GET', '/api/books/filter', $second_payload, $this->headers)
          ->assertStatus(200)
          ->assertJsonFragment(['isbn' => '978-1118999875']);

  }

  public function testFilterByCategory()
  {
    $first_payload = ['category' => "Linux"];
    $this->json('GET', '/api/books/filter', $first_payload, $this->headers)
        ->assertStatus(200)
        ->assertJsonFragment(['isbn' => "978-0596804848"])
        ->assertJsonFragment(['isbn' => "978-1118999875"]);

    $second_payload = ['category' => "PHP"];
    $this->json('GET', '/api/books/filter', $second_payload, $this->headers)
        ->assertStatus(200)
        ->assertJsonFragment(['isbn' => '978-1491918661']);
  }

  public function testFilterByAuthorAndCategory()
  {
    $payload = ['author' => "Robin Nixon",'category' => "Linux"];
    $this->json('GET', '/api/books/filter', $payload, $this->headers)
        ->assertStatus(200)
        ->assertJsonFragment(['isbn' => "978-0596804848"]);
  }
    }
