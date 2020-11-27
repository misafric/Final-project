<?php

namespace App\Http\Controllers\Admin;

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

        $articles = Article::where('product_id',$id)->with('tags.tag_category')->get();

        foreach ($articles as $article) {
            $tag_array = [];
            foreach ($article->tags as $tag) {
                $tag_array[] = $tag->id;
            }
            $article->tag_array = $tag_array;
        }

        $product_tag_categories = TagCategory::where('tag_categories.is_product_level',1)->with('tags')->get();

        $current_product_tag_ids = [];
        foreach ($product->tags as $tag) {
            $current_product_tag_ids[] = $tag->id;
        }

        foreach ($product_tag_categories as $tag_category) {
            foreach ($tag_category->tags as $tag) {
                // foreach ($tags as $tag) {
                // var_dump($tag->id);
                $tag->checked = in_array($tag->id,$current_product_tag_ids) ? 'checked' : '';
                // echo 1;
                // }
            }
        }

        // dd($product_tag_categories);

        $article_tag_categories = TagCategory::where('tag_categories.is_product_level',0)->with('tags')->get();

        $current_article_tag_ids = [];
        foreach ($product->tags as $tag) {
            $current_article_tag_ids[] = $tag->id;
        }

        foreach ($article_tag_categories as $tag_category) {
            foreach ($tag_category->tags as $tag) {
                // foreach ($tags as $tag) {
                // var_dump($tag->id);
                $tag->checked = in_array($tag->id,$current_article_tag_ids) ? 'checked' : '';
                // echo 1;
                // }
            }
        }
        
        // dd($article_tag_categories);

        // $categories = CategoryController::categories();

        return view('admin.product-detail',compact('product','articles','product_tag_categories','article_tag_categories'));

        return view('admin.product-detail',compact('product','articles','categories'));
    }
}