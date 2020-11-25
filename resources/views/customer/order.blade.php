<form method="post" action="{{ action('AddController@add') }}" id="order_form">

    @csrf
    <p>
        <label for="name">Name:</label>
        <input id="name" type="text" name="name" required/>
    </p>

    <p>
        <label for="phone">Phone:</label>
        <input id="phone" type="tel" name="phone"  required/>
    </p>

    <p>
        <label for="email">Email:</label>
        <input id="email" type="text" name="email" required/>
    </p>

    <p>
        <label for="zip">Zip:</label>
        <input id="zip" type="text" name="zip" required/>
    </p>

    <p>
        <label for="street">Street:</label>
        <input id="street" type="text" name="street" required/>
    </p>

    <p>
        <label for="city">City:</label>
        <input id="city" type="text" name="city" required/>
    </p>
    {{-- <p>
        <label for="user">User:</label>
        
    </p> --}}
    <p>
        Country:
        <label for="country_id">Czechia:</label>
        <input id="1" type="radio" name="country_id" value="1" required/>
        <label for="country_id">Slovakia:</label>
        <input id="2" type="radio" name="country_id" value="2" required/>
    </p>

        <p>
        <label for="note">Note:</label>
        {{-- <input id="note" type="text" name="note"/> --}}
        <textarea name="note" cols="60" rows="7"></textarea>
    </p>

    <input id="user_id" type="hidden" name="user" value="1" required/>
    {{-- <p>
        <label>Article id:</label>
        <input type="number" name="article_id" min="1"/>
    </p>

    <p>
        <label>Order quantity:</label>
        <input type="number" name="order_qty" min="1"/>
    </p>

    <p>
        <label>Order unit price:</label>
        <input type="number" name="order_unit_price"/>
    </p> --}}
    
    <input type="submit" name="">

    @if (Session::has('order_success_message'))

        <div class="alert alert--success">{{ Session::get('order_success_message') }}</div>

    @endif

    @if ($errors->addtoorder->count())

        @foreach ($errors->addtoorder->all() as $error)

            <div class="alert alert--error">{{ $error }}</div>

        @endforeach

    @endif




</form>