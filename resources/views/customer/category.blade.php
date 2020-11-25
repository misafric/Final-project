@extends('layouts.main')

@section('content')

@foreach ($products as $p)

<article class="product">
    <div>
        <a class="product__link" href="{{ route('customer.product.show',[$p->id,'5-7']) }}" alt="">
        <img class="product__img" src="/img/{{ $p->articles[0]->images[0]->url}}" alt="{{ $p->name }}"/>
        </a>
        <h2 class="product__name">{{ $p->name }}</h2>
    </div>

    <div>
        <span class="product__price">Price: {{$p->unit_price}}CZK</span>
        <p class="product__description">{{$p->description_short}}</p>
        
    </div>
</article>

@endforeach
    
@endsection
