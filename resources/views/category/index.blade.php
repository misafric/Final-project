@extends('layouts.main')

@foreach ($categories as $c)

<article class="product">
    <div>
        <img class="product__img" src="" alt="{{ $c->name }}"/>
        <h2 class="product__name">{{ $c->name }}</h2>
    </div>

    <div>
        <span class="product__price">Price</span>
        <p class="product__description">Short description</p>
        <a class="product__link" href="" alt="">Detail (long description)</a>
    </div>
</article>

@endforeach