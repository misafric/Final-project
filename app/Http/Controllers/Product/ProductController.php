<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Product;

class ProductController extends Controller
{

    public function index($category_id)
    {
        $products = Product::
        whereHas('tags', function($query) use ($category_id) {
            $query->where('tags.id', $category_id);
        })
        ->with('articles.images')
        ->with('articles.tags')
        ->get();

        return view('customer.category',compact('products'));
    }

    public function filter($category_id)
    {
        $tag_id = 5;
        $products = Product::
        whereHas('tags', function($query) use ($category_id) {
            $query->where('tags.id', $category_id);
        })
        ->whereHas('articles.tags', function($query) use ($tag_id) {
            $query->where('tags.id', $tag_id);
        })
        ->with('articles.images')
        ->with('articles.tags')
        ->get();

        return $products;
    }

}
