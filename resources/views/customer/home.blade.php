@extends('layouts.main')

@section('content')

@foreach($tags as $t)
    <div class="img-background img-{{ $t->id }}">	
        <div class="inside">
            <a href="{{ action('Product\ProductController@index', $t->id) }}">Check out our {{ $t->name }} section</a>
        </div>
    </div>
@endforeach

@endsection