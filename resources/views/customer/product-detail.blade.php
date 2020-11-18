@extends('layouts.main')

@section('meta')
    <meta name='product_id' content="<?=$product["id"] ?>">
    {{-- <meta name='initial_selection' content="<?=$initial_selection_string ?>"> --}}
@endsection

@section('content')

<form action="/api/order/add" method="post" id="order_form">
    @csrf
</form>

<div><?=$product["name"] ?></div>
<div><?=$product["unit_price"] ?>CZK</div>
<hr>
<div id="app">

</div>

<script src="{{mix('js/product-detail-app.js')}}"></script>

@endsection