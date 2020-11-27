<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Customer\CartController;
use App\Models\Order;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class AddController extends Controller
{
    public function add(Request $request)
    {      

        $order_hash = 'notAnActualHashYet';

        // dd($request->input('article_id')[0]);

        // Validator::make($request->all(), [
        //     'quantity' => 'required|numeric|min:1'
        // ], [
        //     'quantity.required' => 'Hey, don\'t forget the quantity!',
        //     'quantity.min' => 'Value is too low! Go higher!'
        // ])->validateWithBag('addtoorder'); 

        $order = new Order;

        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->zip = $request->input('zip');
        $order->street = $request->input('street');
        $order->city = $request->input('city');
        $order->country_id = $request->input('country_id');
        $order->note = $request->input('note');
        $order->user_id = 1;
        $order->order_date_time = Carbon::now();
        $order->order_hash = $order_hash;

        $order->save(); // asign an id to an order

        $actual_hash = hash('ripemd160', $order->id);

        $order->order_hash = $actual_hash;

        $order->update();

        foreach ($request->input('article_id') as $i => $article) {
            $article_id = $article;
            $order_qty = $request->input('order_qty')[$i];
            $order_unit_price = $request->input('order_unit_price')[$i];
            $order->articles()->attach($article_id, compact ('order_qty', 'order_unit_price' ));
            $article_record = Article::findOrFail($article);
            $article_old_stock = $article_record->stock_qty;
            $article_new_stock = $article_old_stock - $order_qty;
            $article_record->stock_qty = $article_new_stock;
            $article_record->update();
        }

        

        $order_url = route('customer.order.show',$actual_hash);

        // dd($order_url);

        CartController::empty_static($request);

        session()->flash('order_success_message', $order_url);
        session()->flash('order_created',true);
        session()->flash('order_url', $order_url);

        

        return redirect(route('customer.order.show',$actual_hash));

    }
}
//         // $this->validate($request, [
//         Validator::make($request->all(), [
//             'quantity' => 'required|numeric|min:1'
//         ], [
//             'quantity.required' => 'Hey, don\'t forget the quantity!',
//             'quantity.min' => 'Value is too low! Go higher!'
//         ])->validateWithBag('addtoorder'); // adds all potential errors to MessageBag named 'addtoorder'
//         // ])->validate();                 // adds all potential errors to MessageBag named 'default'


//         // handle the submission
//         $order = new Order;
//         // TODO: attach user_id to this order
//         // $order->user_id = \Auth::id();
//         $order->save(); // assign an id to the order
        
//         $article = Article::findOrFail($article_id);

//         $quantity = $request->input('quantity');

//         $order->article()->attach($article, ['quantity' => $quantity]);

//     //     // flash the success message
//     //     session()->flash('order_success_message', 'Book '. $book->title .' was added to the cart');

//     //     // redirect somewhere (with GET)
//     //     return redirect()->route('books.show', $book->id);
//     // }
// }
// }
