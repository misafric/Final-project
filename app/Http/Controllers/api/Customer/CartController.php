<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use App\Models\Tag;
use App\Models\TagCategory;

class CartController extends Controller
{

    private $added_article = null;

    public function index(Request $request) {
        if (!$request->session()->has('cart_items')) {
            $request->session()->put('cart_items', []);
        }

        $current_session = $request->session()->all();

        return $current_session;
    }

    public function add(Request $request)
    {
        if (!$request->session()->has('cart_items')) {
            $request->session()->put('cart_items', []);
        }

        $this->added_article = $request['article_id'];

        $article = Article::with('product:id,name')
        ->with(['tags' => function ($query) {
            $query->whereHas('tag_category', function ($query) {
                $query->where('is_identifier', 1);
            })
            ;
        }])
        ->with('images')
        ->findOrFail($request['article_id']);

        // dd($article);

        $identifiers_array = [];

        foreach ($article['tags'] as $tag) {
            $identifiers_array[] = $tag['name']; 
        }

        $identifiers = implode(', ',$identifiers_array);

        $request->session()->push('cart_items', [ 
                'product_id' => $request['product_id'],
                'product_name' => $article['product']['name'],
                'identifiers' => $identifiers,
                'image_url' => $article['images'][0]['url'],
                'article_id' => $request['article_id'],
                'order_qty' => $request['order_qty'],
                'order_unit_price' => $request['order_unit_price'],
            ] 
        );

        // $current_session = $request->session()->all();

        return redirect()->back()->with('status', $article['product']['name'].' '. $identifiers.' successfully added to cart');
    }

    public function remove(Request $request)
    {
        $request->session()->forget('cart_items.'.$request["cart_item_id"]);

        if(count($request->session()->get('cart_items')) === 0) {
            $request->session()->flush();
            return redirect(route('cart'));
        } else {
            $new_cart = [];
            $old_cart = $request->session()->all();
            foreach ($old_cart['cart_items'] as $old_item) {
                $new_cart[] = $old_item;
            };
        }

        $request->session()->flush();

        $request->session()->put('cart_items', $new_cart);

        // $current_session = $request->session()->all();

        return redirect(route('cart'));
    }

    public function edit(Request $request)
    {
        $request->session()->forget('cart_items.'.$request["cart_item_id"]);

        if(count($request->session()->get('cart_items')) === 0) {
            $request->session()->flush();
            return redirect(route('cart'));
        } else {
            $new_cart = [];
            $old_cart = $request->session()->all();
            foreach ($old_cart['cart_items'] as $old_item) {
                $new_cart[] = $old_item;
            };
        }

        $request->session()->flush();

        $request->session()->put('cart_items', $new_cart);

        // $current_session = $request->session()->all();

        return redirect(route('cart'));
    }

    public function empty(Request $request)
    {
        $request->session()->flush();

        return redirect(route('cart'));
    }
}