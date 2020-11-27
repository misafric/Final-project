<header class="header-wrap">

                <div class="selected">
                <a href='/'><img class="logo" src="/img/transparent_trees.png" alt="logo"></a>
                </div>

                <input class="input-search-bar" type="search" name="query">

                <div class="cart-check" style="color:red">
                        
                </div>


                <div class="header-icons-wrap">
                        
                        {{-- <div>
                        <img class="icons-right" src="/img/menu_icon.jpg" alt="menu">
                        </div> --}}
                        
                        
                        <div class="header-right-icons-wrap">
                                {{-- <img class="icons-right" src="/img/person_icon.png" alt="person">
                                <img class="icons-right" src="/img/magnifying_glass_icon.jpg" alt="magnifying_glass"> --}}

                                @if (session('cart_items'))
                                        <a href="{{route('cart')}}"><img class="icons-right" src="/img/transparent_cart_{{count(session('cart_items'))}}.png" alt="cart"></a>
                                @else
                                        <a href="{{route('cart')}}"><img class="icons-right" src="/img/transparent_cart_0.png" alt="cart"></a>
                                @endif
                                
                        </div>

                        
                </div>

                @if (session('cart_items'))
                        <a href="{{route('cart')}}"><img class="cart" src="/img/transparent_cart_{{(count(session('cart_items'))<=4) ? (count(session('cart_items'))): '4_plus'}}.png" alt="cart"></a>
                @else
                        <a href="{{route('cart')}}"><img class="cart" src="/img/transparent_cart_0.png" alt="cart"></a>
                @endif

                {{-- <a href="{{route('cart')}}"><img class="cart" src="/img/transparent_cart.png" alt="cart"></a> --}}

                {{-- <img class="forest_img" src="/img/background_forest.jpg" alt="background_forest"> --}}

</header>