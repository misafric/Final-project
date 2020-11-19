@extends('layouts.main')

@section('meta')
    <meta name='product_id' content="<?=$product["id"] ?>">
@endsection

@section('content')

<section class='product-detail'>

    <form action="/api/cart/add" method="post" id="order_form">
        @csrf
    </form>
    
    
    <h2>{{$product["name"]}}</h2>
    <h3>{{$product["unit_price"]}}CZK</h3>
    <p>{{$product["description_long"]}}</p>
    
    <div id="app"></div>

    <script src="{{mix('js/product-detail-app.js')}}"></script>

</section>

@endsection