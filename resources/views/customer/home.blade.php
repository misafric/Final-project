@extends('layouts.main')

@section('content')

@foreach($tags as $t)
    <div class="img-background img-{{ $t->id }}">	
        <div class="inside">
            <a href="{{ action('Category\CategoryController@index', $t->id) }}">Check out our {{ $t->name }} section</a>
        </div>
    </div>
@endforeach

@endsection