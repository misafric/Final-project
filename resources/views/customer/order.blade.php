<form method="post" action="{{ action('AddController@add') }}" id="order_form">

    @csrf
    <div class="container">
    <p>
        <label for="name">Name:</label><br>
        <input id="name" type="text" name="name" required/>
    </p>

    <p>
        <label for="phone">Phone:</label><br>
        <input id="phone" type="tel" name="phone"  required/>
    </p>

    <p>
        <label for="email">Email:</label><br>
        <input id="email" type="text" name="email" required/>
    </p>

    <p>
        <label for="zip">Zip:</label><br>
        <input id="zip" type="text" name="zip" required/>
    </p>

    <p>
        <label for="street">Street:</label><br>
        <input id="street" type="text" name="street" required/>
    </p>

    <p>
        <label for="city">City:</label><br>
        <input id="city" type="text" name="city" required/>
    </p>
    </div>

    <p class="country-input-wrap">
        Country:<br>
        <label for="country_id">Czechia:</label>
        <input id="1" type="radio" name="country_id" value="1" required/>
        <label for="country_id">Slovakia:</label>
        <input id="2" type="radio" name="country_id" value="2" required/>
    </p>

        <p class="note-input-wrap">
        <label for="note">Note:</label><br>
        {{-- <input id="note" type="text" name="note"/> --}}
        <textarea class="textarea" name="note" cols="60" rows="7"></textarea>
    </p>

    <input id="user_id" type="hidden" name="user" value="1" required/>

    
    <div class="confirm-button"><input class="button" type="submit" name="" value="Confirm"></div>

    @if (Session::has('order_success_message'))

        <div class="alert alert--success">{{ Session::get('order_success_message') }}</div>

    @endif

    @if ($errors->addtoorder->count())

        @foreach ($errors->addtoorder->all() as $error)

            <div class="alert alert--error">{{ $error }}</div>

        @endforeach

    @endif




</form>