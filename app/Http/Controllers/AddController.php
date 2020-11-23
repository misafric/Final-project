<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Article;
use Illuminate\Http\Request;


class AddController extends Controller
{
    public function add(Request $request)
    {

        $order = new Order;
        $order->name = $request->input('first_name');
        $order->middle_name = $request->input('middle_name');
        $order->last_name = $request->input('last_name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->zip = $request->input('zip');
        $order->street = $request->input('street');
        $order->city = $request->input('city');
        $order->note = $request->input('note');

        $order->save(); // asign an id to an order

        // A teď vytvoř zaznam v article_order a prepis tam to ID z order tabulky

        // $book = Book::findOrFail($book_id) - v tomto pripade by byla kniha uz v databazi, nebyl by to input

        // INSERT INTO `article_order` (`id`, `order_id`, ... ) VALUES (1,1,...) - takto s query, ale budu pouzivat vztahy

        // Posledni ID (id=order save)
        $order = Order::findOrFail($id);

        $article_id = $request->input('article_id');
        $order_qty = $request->input('order_qty');
        $order_unit_price = $request->input('order_unit_price');


        // $order = App\Models\Order::find();

        $order->articles()->attach($order, compact ('article_id, order_qty, order_unit_price' ));

        

        session()->flash('order_success_message', 'Article '. $article->title .' was added');

        return view('/api');




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
