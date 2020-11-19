<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use App\Models\TagCategory;

class CartController extends Controller
{

    public function add(Request $request)
    {
        if (!$request->session()->has('cart_items')) {
            $request->session()->put('cart_items', []);
        }

        $request->session()->push('cart_items', [ 
                'product_id' => $request['product_id'],
                'article_id' => $request['article_id'],
                'order_qty' => $request['order_qty'] 
            ] 
        );

        return redirect(route('cart'));
    }

    public function remove(Request $request)
    {
        $request['cart_item_id'];

        $request->session()->forget('cart_items.'.$request["cart_item_id"]);

        if(count($request->session()->get('cart_items')) === 0) {
            $request->session()->flush();
        }

        return redirect(route('cart'));
    }

    public function empty(Request $request)
    {
        $request->session()->flush();

        return redirect(route('cart'));
    }
}