@extends('layouts.main')

@section('meta')
    <meta name='product_id' content="<?=$product["id"] ?>">
@endsection

@section('content')

<section class='product-detail'>

    <form action="/api/cart/add" method="post" id="order_form">
        @csrf
        <input type="hidden" name="order_unit_price" value="{{$product["unit_price"]}}">
    </form>
    
    
    <h2>{{$product["name"]}}</h2>
    <h3>{{$product["unit_price"]}}CZK</h3>
    <p>{{$product["description_long"]}}</p>
    
    @foreach ($product->tags as $product_tag)
        @if ($product_tag->tag_category->is_visible == 1)
            {{$product_tag->name}}
        @endif
    @endforeach

    <div id="app"></div>

    @if (session('status'))
    <div id="success-message">
        {{ session('status') }}
    </div>
    @endif

    <script src="{{mix('js/product-detail-app.js')}}"></script>

</section>

@endsection