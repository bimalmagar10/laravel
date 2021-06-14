 
 <div class="top-nav container">
    <div class="top-nav-left">
        <div class="logo"><a href="{{ route('landing-page') }}">Ecommerce</a></div>
                        
    </div>
     <div class="top-nav-right">
        <ul>
            <li><a href="{{ route('shop.index') }}">Shop</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="{{ route('cart.index') }}">Cart <span class="cart-count">
                
               @if(Cart::instance('default')->count() > 0) 
                      <span>{{ Cart::instance('default')->count() }}</span>
                 @endif    
            </span></a>
            </li>

        </ul>
    </div>
</div> <!-- end top-nav -->