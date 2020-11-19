<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;
use App\Models\Tag;
use App\Models\TagCategory;

class ProductController extends Controller
{

    public function show($id,$init = 0)
    {
        $product = Product::with('tags')->find($id);

        $articles = Article::where('product_id',$id)->get();

        $tag_categories = TagCategory::where('tag_categories.is_identifier',1)->get();

        $tag_categories_names = [];

        foreach ($tag_categories as $tag_category) {
            $tag_categories_names[$tag_category['id']] = $tag_category['name'];
        }

        // dd($tag_categories_names);

        $initial_selection_string = '2-3_3-6';

        // $initial_selection = explode('_',$initial_selection_string);

        // foreach ($initial_selection as $i=>$initial_selection_item) {
        //     $initial_selection[$i] = explode('-',$initial_selection_item);
        // }

        // // dd($initial_selection);

        // // $initial_selection = [[2,3],[3,5]];

        // // $initial_selection_final = [];
        // $initial_selection_values = [];

        // foreach ($initial_selection as $initial_selection_array) {
        //     // $initial_selection_final[$tag_categories_names[$initial_selection_array[0]]]=$initial_selection_array[1];
        //     $initial_selection_values[] = $initial_selection_array[1];
        // }

        // $initial_selection_string = implode('-',$initial_selection_values);

        // dd(compact('initial_selection_string'));

        return view('customer/product-detail',compact('product','articles','initial_selection_string'));
    }

    public function prepare($id,$init)
    {
        $product = Product::with('tags')->find($id);

        $articles = Article::where('product_id',$id)->get();

        $tag_categories = TagCategory::where('tag_categories.is_identifier',1)->get();

        $tag_categories_names = [];

        foreach ($tag_categories as $tag_category) {
            $tag_categories_names[$tag_category['id']] = $tag_category['name'];
        }

        // dd($tag_categories_names);

        $initial_selection_string = '2-3_3-5';

        $initial_selection = explode('_',$initial_selection_string);

        foreach ($initial_selection as $i=>$initial_selection_item) {
            $initial_selection[$i] = explode('-',$initial_selection_item);
        }

        // dd($initial_selection);

        // $initial_selection = [[2,3],[3,5]];

        // $initial_selection_final = [];
        $initial_selection_values = [];

        foreach ($initial_selection as $initial_selection_array) {
            // $initial_selection_final[$tag_categories_names[$initial_selection_array[0]]]=$initial_selection_array[1];
            $initial_selection_values[] = $initial_selection_array[1];
        }

        $initial_selection_string = implode('-',$initial_selection_values);

        // dd(compact('initial_selection_string'));

        // return view('customer/product-detail',compact('product','articles','initial_selection_string'));

        return redirect(action('ProductController@show_2',compact('id','product','articles','initial_selection_string')));
    }

    // public function show_2($id,$product,$articles,$initial_selection_string)
    // {
    //     return view('customer/product-detail',compact('product','articles','initial_selection_string'));
    // }

}