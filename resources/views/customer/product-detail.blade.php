@extends('layouts.main')

@section('meta')


    {{-- <div class="image-product-detail"> --}}

    {{-- </div> --}}

    <meta name='product_id' content="<?=$product["id"] ?>">
@endsection



@section('content')

<section class='product-detail'>


<div class="product-info">
    <h2>{{$product["name"]}}</h2>
    <h3>{{$product["unit_price"]}} CZK</h3>
    {{-- <a href="">{{$product["description_long"]}}</p> --}}
</div>    

    <form action="/api/cart/add" method="post" id="order_form">
        @csrf
        <input type="hidden" name="order_unit_price" value="{{$product["unit_price"]}}">
    </form>
    
    

    


    <div id="app"></div>

    @if (session('status'))
    <div class="sentence-green" id="success-message">
        {{ session('status') }}
    </div>
    @endif

    <script src="{{mix('js/product-detail-app.js')}}"></script>

</section>

@endsection