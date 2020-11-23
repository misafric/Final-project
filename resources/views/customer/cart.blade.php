@extends('layouts.main')

@section('content')

<section class='cart-content'>

    @if (Session::get('cart_items') !== null)
        
        @foreach (Session::get('cart_items') as $i => $cart_item)
            Ordered article {{$i+1}}: <br>
            Product ID: {{$cart_item['product_id']}} <br>
            Article ID: {{$cart_item['article_id']}} <br>
            Order Qty: {{$cart_item['order_qty']}}
            <form action="/api/cart/remove" method="post">
                @csrf
                <input type="hidden" name="cart_item_id" value="{{$i}}">
                <input type="submit" value="Remove from Cart">
            </form>
            <br><br>
        @endforeach

        <form action="/api/cart/empty" method="post">
            @csrf
            <input type="submit" value="Empty Cart">
        </form>
    
    @else
        Your cart is empty!
    @endif
    
</section>



@endsection
