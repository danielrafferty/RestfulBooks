<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class Categories extends Controller
{
    public function index()
    {
      return Category::select('name')->get()->toJson();
    }
}
