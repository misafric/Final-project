@extends('layouts.main')

@section('content')

<?php
if (empty($active_filters)) {
    $active_filters = [];
}

function find_default_pic ($product) {
    foreach ($product->articles as $article) {
        if($article['selected']) {
            $result = '';
            if (count($article->images) > 0) {
                $result = $article->images[0]->url;
            }            
            return $result;
        } 
    };
    $result = '';
    if (count($product->articles[0]->images) > 0) {
        $result = $product->articles[0]->images[0]->url;
    }
    return $result;
}

function find_default_link ($product) {
    foreach ($product->articles as $article) {
        if($article['selected']) {
            $link_array = [];
            foreach ($article['tags'] as $tag) {
                if ($tag->tag_category['is_identifier'] === 1) {
                    array_push($link_array,$tag['id']);
                }
            }
            return implode('-',$link_array);
        } 
    };
    $link_array = [];
    foreach ($product->articles[0]['tags'] as $tag) {
        if ($tag->tag_category['is_identifier'] === 1) {
            array_push($link_array,$tag['id']);
        }
    }
    $result = (count($link_array)>0) ? implode('-',$link_array) : '0';
    return $result;
}
?>

<div class="category-container">
<div class="filters-container">

<form action="{{ action('Product\ProductController@filter',[$category_id]) }}" method="get">
    @foreach ($filters as $filter)
        <div class="filter">
            <h3>{{$filter['name']}}</h3>
            @foreach ($filter['tags'] as $filter_value)
                <input type="checkbox" name="{{$filter['is_product_level'].'-'.$filter['id'].'-'.$filter_value['id']}}"
                {{in_array($filter['is_product_level'].'-'.$filter['id'].'-'.$filter_value['id'],$active_filters) ? 'checked' : ''}}
                >
                <label>{{$filter_value['name']}}</label>
            @endforeach
        </div>
    @endforeach

    <input class="filter-button" type="submit" value="Filter">

</form>

<a href="{{ action('Product\ProductController@index',[$category_id]) }}"><button class="clear-button">Clear filters</button></a>


</div>

@foreach ($products as $p)

<article class="product">
    <div>
        <a class="product__link" href="{{ route('customer.product.show',[$p->id,find_default_link($p)]) }}" alt="">
        <img class="product__img" src="/img/goods/{{ find_default_pic($p)}}" alt="{{ $p->name }}"/>
        </a><br>
        <h2 class="product__name">{{ $p->name }}</h2>
    </div>

    <div>
        <span class="product__price">Price: {{$p->unit_price}}CZK</span>
        <p class="product__description">{{$p->description_short}}</p>
        
    </div>
</article>
</div>

@endforeach
    
@endsection
