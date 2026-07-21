<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Group;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->load('category', 'tags', 'colors', 'group');

        $categories = Category::all();
        $tags = Tag::all();
        $colors = Color::all();
        $groups = Group::all();

        return view('product.edit', compact('product', 'categories', 'tags', 'colors', 'groups'));
    }
}
