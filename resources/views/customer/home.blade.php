@extends('layouts.main')

@section('content')

<div class="nav-container">
@foreach($tags as $t)
        <nav class="nav-{{ $t->name }}">
            <a href="#  {{ $t->name }} ">{{ $t->name }}</a>
        </nav>
@endforeach
</div>

@foreach($tags as $t)
    <div class="img-background img-{{ $t->id }}">	
        <div class="inside">
            <a href="{{ action('Product\ProductController@index', $t->id) }}">Check out our {{ $t->name }} section</a>
        </div>
    </div>
@endforeach

@endsection