{{-- <div class="nav-container">
    <a href="{{ action('Product\ProductController@index', 1) }}">|men|</a>
    <a href="{{ action('Product\ProductController@index', 2) }}">|women|</a>
    <a href="{{ action('Product\ProductController@index', 3) }}">|children|</a>
    <a href="{{ action('Product\ProductController@index', 4) }}">|equipment|
    </a>
</div> --}}

<div class="nav-container">
@foreach ($categories->tags as $tag)
    <a href="{{ action('Product\ProductController@index', $tag->id) }}">|{{$tag->slug}}|</a>
@endforeach
</div>
