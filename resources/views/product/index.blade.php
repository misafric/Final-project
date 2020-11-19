@extends('layouts.main')

@foreach ($products as $p)

<article class="product">
    <div>
        <img class="product__img" src="" alt="{{ $p->name }}"/>
        <h2 class="product__name">{{ $p->name }}</h2>
    </div>

    <div>
        <span class="product__price">Price</span>
        <p class="product__description">Short description</p>
        <a class="product__link" href="" alt="">Detail (long description)</a>
    </div>
</article>

@endforeach