    <header class="header header--photo post-unset box-shadow" data-sticky="false">
      <div class="ps-logo"><a href="{{route('front.index')}}"> <img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a></div>
      <div class="header__content">
        <div class="header__actions">
           @if($gs->is_contact == 1)
          <p class="menu-s"><a href="{{route('front.contact')}}"><strong class="text-dark">Contact us</strong></a></p>
          @endif

          {{-- <div class="header__language">
            <div class="h_btn_style">
               <button class="ps-btn shop-now-g"  data-toggle="modal" data-target="#ShopNowModal"  >Shop Now</button>
            </div>
          </div> --}}
          <div class="ps-cart--mini">
            <a class="header__extra wsn-cart-logo" href="{{route('front.cart')}}">
              {{-- <div class="minicart">
                 <img src="{{asset('assets/images/icons/cart.png')}}">
              </div> --}}
              <i class="fa fa-shopping-cart"></i>
              <span><i class="cart-quantity" id="cart-count"> {{ Session::has('cart') ? Session::get('cart')->totalQty: 0 }} </i></span></a>
          </div>
          <div class="ps-block--user-header">
            <div class="ps-block__left">
              @if(Auth::guard('web')->check()) 
                <div class="ps-dropdown">
                  <a href="javascript:;"> 
                  @if(Auth::user()->is_provider == 1)
                  <img class="user-img-avt" src="{{Auth::user()->photo?Auth::user()->photo:asset('assets/images/'.$gs->user_image)}}" alt="No Image">
                  @else
                  <img class="user-img-avt" src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo):asset('assets/images/'.$gs->user_image) }}" alt="No Image">
                  @endif
                  </a>

                    <ul class="ps-dropdown-menu">
                        <li><a href="{{ route('user-dashboard') }}">{{ $langg->lang221 }}</a></li>
                        @if(Auth::user()->IsVendor())
                        <li><a href="{{ route('vendor-dashboard') }}">{{ $langg->lang222 }}</a></li>
                        @endif
                        <li>
                            <a href="{{route('user-profile')}}"> {{ $langg->lang205 }}</a>
                        </li>
                        <li>
                            <a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>
                        </li>
                    </ul>
                </div>
              @else
              <button class="user-login-btn wsn-us-avatar" data-toggle="modal" data-target="#LoginModal">
              {{-- <i class="icon-user"></i> --}}<i class="fa fa-user"></i>
               </button>     
              @endif          
            </div>
          </div>
        </div>
      </div>
    </header>
    <header class="header header--mobile header--mobile-photo" data-sticky="true">
      <div class="navigation--mobile">

        <div class="navigation__left">
          <div class="nv-menu-c"><a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu" ></i></a></div>
          <a class="ps-logo" href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
        </div>
        <div class="navigation__right">
          <div class="header__actions">
            
            <div class="header__language mr-0">
              <div class="ps-cart--mini">
                <a class="header__extra wsn-cart-logo" href="{{route('front.cart')}}">
               {{--  <div class="minicart">
                   <img src="{{asset('assets/images/icons/cart.png')}}">
                </div> --}}
                <i class="fa fa-shopping-cart"></i>
                  <span><i class="cart-quantity" id="cart-count"> {{ Session::has('cart') ? Session::get('cart')->totalQty: 0 }} </i></span></a>
              </div>
              {{-- <div class="h_btn_style">
                 <button class="ps-btn shop-now-g"  data-toggle="modal" data-target="#ShopNowModal" >Shop</button>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </header>

    
    <!--include search-sidebar-->
    <div class="ps-panel--sidebar" id="menu-mobile">
      <div class="ps-panel__header">
        <h3>Menu</h3>
        <a class="ps-btn--close ps-btn--no-boder" id="custom-close" href="#menu-mobile"></a>
      </div>
      <div class="ps-panel__content">
        <ul class="menu--mobile">
           @if($gs->is_contact == 1)
          <li><a href="{{route('front.contact')}}"><strong>Contact us</strong></a></li>
          @endif
          <li><a href="{{route('front.cart')}}">Cart</a></li>
          <li><a href="{{route('user.login')}}">Login</a></li>
          <li><a href="{{route('user-register')}}">Register</a></li>
        </ul>
      </div>
    </div>