<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Category\CategoryController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Article;
use App\Models\Tag;


class OrderController extends Controller
{
    public function show(Request $request, $order_hash)
    {
        
        if($request->session()->has('order_url')) {
            $request->session()->flash('order_success_message',
                'Thank you for shopping with us, you can track your order status at '.$request->session()->get('order_url'));
        }
        // dd($request);
        $order = Order::
        with('articles.product:id,name')
        ->with(['articles.tags' => function ($query) {
                $query->whereHas('tag_category', function ($query) {
                    $query->where('is_identifier', 1);
                })
                ;
            }])
        ->where('order_hash',$order_hash)
        ->first();

            // foreach ($order->articles as $article) {
            //     echo $article->pivot->order_qty;
            // }

        // if($request->session()->has('order_url')) {
        //     $request->session()->flash('order_success_message',
        //         'Thank you for shopping with us, you can track your order status at '.$request->session()->get('order_url'));
        // }

        $categories = CategoryController::categories();

        return (view('customer.order-view',compact('order','categories')));
        // dd($order->articles);
    }

}
