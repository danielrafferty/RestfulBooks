<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class CategoryTest extends TestCase
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
    public function testGetListOfCategories()
    {
      $this->json('GET', '/api/categories', [], $this->headers)
          ->assertStatus(200)
          ->assertJsonFragment(['name' => 'PHP'])
          ->assertJsonFragment(['name' => 'Javascript'])
          ->assertJsonFragment(['name' => 'Linux']);
    }
}
