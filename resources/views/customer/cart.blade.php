@extends('layouts.main')

@section('content')

<div id="cart-app"></div>

<hr>

<section class='cart-content'>
</section>

@include('customer/order')

<script src="{{mix('js/cart-app.js')}}"></script>

@endsection
