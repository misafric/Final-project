<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Category\CategoryController;
use App\Models\Product;
use App\Models\Article;
use App\Models\Tag;
use App\Models\TagCategory;

class ProductController extends Controller
{

    public function show($id,$init = 0)
    {
        $product = Product::with('tags.tag_category')->find($id);

        $articles = Article::where('product_id',$id)->get();

        $tag_categories = TagCategory::where('tag_categories.is_identifier',1)->get();

        $tag_categories_names = [];

        foreach ($tag_categories as $tag_category) {
            $tag_categories_names[$tag_category['id']] = $tag_category['name'];
        }

        $categories = CategoryController::categories();

        return view('customer/product-detail',compact('product','articles','categories'));
    }
}