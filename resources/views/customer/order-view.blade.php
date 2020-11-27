@extends('layouts.main')

@section('content')

<div class="view-container">
   <p class="summary"><strong>Order summary: <br></strong></p>
@foreach ($order->articles as $article)
    {{$article->product->name}}
    @foreach ($article->tags as $tag)
        {{' '.$tag->name}}
    @endforeach
    , {{$article->pivot->order_qty}}x,
    {{$article->pivot->order_unit_price}}CZK<br>
    <br>
@endforeach

<br>
<hr>
<br>
@if (Session::has('order_success_message'))
    <div id="alert" class="alert alert--success">{{ Session::get('order_success_message') }}</div>
@endif
</div>

@endsection