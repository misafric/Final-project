@extends('layouts.main')

@section('content')

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

@if (Session::has('order_success_message'))
    <div class="alert alert--success">{{ Session::get('order_success_message') }}</div>
@endif

@endsection