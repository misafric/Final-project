<h1>Order confirmation</h1>

<h2>Order creating - personal details</h2>

{{-- @foreach ($errors->all() as $error)
    <div class="error">{{ $error }}</div>
@endforeach --}}
 
<form action="{{ action('AddController@add') }}" method="post">
    @csrf
    <p>
        <label for="first_name">First name:</label>
        <input id="first_name" type="text" name="first_name" required/>
    </p>

    <p>
        <label for="middle_name">Middle name:</label>
        <input id="middle_name" type="text" name="middle_name"/>
    </p>

    </p>
        <label for="last_name">Last name:</label>
        <input id="last_name" type="text" name="last_name" required/>
    </p>

    <p>
        <label for="phone">Phone:</label>
        <input id="phone" type="number" name="phone" required/>
    </p>

    <p>
        <label for="email">Email:</label>
        <input id="email" type="text" name="email" required/>
    </p>

    <p>
        <label for="zip">Zip:</label>
        <input id="zip" type="number" name="zip" required/>
    </p>

    <p>
        <label for="street">Street:</label>
        <input id="street" type="text" name="street" required/>
    </p>

    <p>
        <label for="city">City:</label>
        <input id="city" type="text" name="city" required/>
    </p>

        <p>
        <label for="note">Note:</label>
        <input id="note" type="text" name="note" required/>
    </p>

</form> --}}


{{-- @extends('layouts.main')

@section('content')



{{-- @endsection --}}

<hr>

<h2>Create new product</h2>

{{-- @if ($errors->count())
    @foreach ($errors->all() as $error)
        <div class="alert alert-error">{{ $error }}</div>
    @endforeach
@endif --}}

<form method="post" action="{{ action('AddController@add') }}">
    @csrf
    <p>
        <label>Article id:</label>
        <input type="number" name="article_id"/>
    </p>
    <p>
        <label>Order quantity:</label>
        <input type="number" name="order_qty"/>
    </p>
        <p>
        <label>Order unit price:</label>
        <input type="number" name="order_unit_price"/>
    </p>
    <input type="submit">
</form>

<hr>




