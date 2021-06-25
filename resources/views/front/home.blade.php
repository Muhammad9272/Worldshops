<!DOCTYPE html>
<html lang="en">
  <head>
   @include('front.layouts.head')
   <link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/custom2.css')}}">
  </head>
  <body>
    <header class="header header--photo" data-sticky="true">
      <div class="ps-logo"><a href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
      </div>
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
                {{-- <div class="minicart">
                   <img src="{{asset('assets/images/icons/cart.png')}}">
                </div> --}}
                <i class="fa fa-shopping-cart"></i>
                  <span><i class="cart-quantity" id="cart-count"> {{ Session::has('cart') ? Session::get('cart')->totalQty: 0 }} </i></span></a>
              </div>
             {{--  <div class="h_btn_style">
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
    <main id="homepage-photo">
      
      <div class="ps-home-search bg--cover" data-background="{{asset('assets/images/banners/'.$large_banner->photo)}}">
        <div class="ps-section__wrapper">
           <form action="{{route('front.location.set')}}" id="search-store-home" method="get">
                              {{-- <div class="from-group shn-g-mar">
                                <input type="text" class="form-control shn-form-control" placeholder="Enter Your Post Code" onfocus="initUGoogleAddress()" name="ulocation"  id="location_name" name="location" required="">

                                <button class="shn-btn" id="btn-lc-s">Search</button>
                              </div> --}}
                    <div class="form-group gnrl-searchbar-parent">
                       <input class="form-control wsp-store-inp gnrl-searchbar" type="text"  placeholder="Enter Your Postcode" onfocus="initUGoogleAddress()" name="ulocation"  id="location_name" name="location" required="">
                       <button class="gnrl-searchbar-btn" id="btn-lc-s"> Search</button>
                    </div>


            </form>
          {{-- <div class="ps-section__header">
            <p class="nor-font"><img class="s-bn-img" src="{{asset('assets/front/img/clk.png')}}"><span class="s-bn-t ">
            Delivery from as little as 30 minutes</span></p>

           
            <h2>{!! $large_banner->head_desc !!} </h2>
          </div> --}}
          {{-- <div class="mt-40">
            <button class="ps-btn shop-now-g" data-toggle="modal" data-target="#ShopNowModal" >Shop Now</button>
          </div> --}}
        </div>       
      </div>
    
    <div class="bg-home11">  
      <div class="container wsn-container-pd" >
        <h2 class="mb-40 text-center text-red mobile-txt">Local shopping in 4 easy steps</h2>
        <div class="row">
          <div class="pay-secure ws-pc-v">
            <div class="pay-ccl-m">
              <div class="pay-ccl pay-1" >
                <img src="{{ asset('assets/images/icons/6.png') }}">              
              </div>
              <p>1. Find a store</p>
            </div>
            <div class="pay-ccl-m">
              <div class="pay-ccl pay-1" >
                <img src="{{ asset('assets/images/icons/8.png') }}">              
              </div>
              <p>2. Select your items</p>
            </div>
            <div class="pay-ccl-m">
              <div class="pay-ccl pay-1" >
                <img src="{{ asset('assets/images/icons/4.png') }}">              
              </div>
              <p>3. Checkout securely </p>
            </div>
            <div class="pay-ccl-m">
              <div class="pay-ccl pay-1" >
                <img src="{{ asset('assets/images/icons/5.png') }}">              
              </div>
              <p>4. Receive your goods </p>
            </div>
          </div>

          <div class="ps-section__content container ws-mobile-v" >
            <div class="ps-carousel--nav owl-slider pay-secure" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="2" data-owl-item-lg="3" data-owl-item-xl="4" data-owl-duration="1000" data-owl-mousedrag="on">

              <div class="pay-ccl-m">
                <div class="pay-ccl pay-1" >
                  <img src="{{ asset('assets/images/icons/6.png') }}">              
                </div>
                <p>1. Find a store</p>
              </div>
              <div class="pay-ccl-m">
                <div class="pay-ccl pay-1" >
                  <img src="{{ asset('assets/images/icons/8.png') }}">              
                </div>
                <p>2. Select your items</p>
              </div>
              <div class="pay-ccl-m">
                <div class="pay-ccl pay-1" >
                  <img src="{{ asset('assets/images/icons/4.png') }}">              
                </div>
                <p>3. Checkout securely </p>
              </div>
              <div class="pay-ccl-m">
                <div class="pay-ccl pay-1" >
                  <img src="{{ asset('assets/images/icons/5.png') }}">              
                </div>
                <p>4. Receive your goods </p>
              </div>
            </div>
          </div>



        </div>
      </div>
    </div>





    <div>
      <img src="{{ asset('assets/images/icons/ban11.png') }}">
    </div>


    <div class="bg-home11">  
      <div class="container wsn-container-pd" >
        <div class="row">
          <div class="pay-secure2 ws-pc-v">            
            <div class="pay-ccl-m2">
              <div class="pay-ccl2 pay-1" >
                <img src="{{ asset('assets/images/icons/1.png') }}">              
              </div>
              <p class="fc"><strong>100% Satisfaction</strong></p>
              <p>Shop with peace of mind thanks to our 100% satisfaction guarantee!</p>
            </div>
            <div class="pay-ccl-m2">
              <div class="pay-ccl2 pay-1" >
                <img src="{{ asset('assets/images/icons/2.png') }}">              
              </div>
              <p class="fc"><strong>Secure checkout</strong></p>
              <p>We utilise SSL-encrypted technology, ensuring secure checkout every time. </p>
            </div>
            <div class="pay-ccl-m2">
              <div class="pay-ccl2 pay-1" >
                <img src="{{ asset('assets/images/icons/3.png') }}">              
              </div>
              <p class="fc"><strong>Fast delivery</strong></p>
              <p>Our dedicated delivery drivers mean your goods will arrive in as little as 30 minutes!</p>
            </div>
          </div>

          <div class="ps-section__content container ws-mobile-v" >
            <div class="ps-carousel--nav owl-slider pay-secure2" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="2" data-owl-item-lg="3" data-owl-item-xl="4" data-owl-duration="1000" data-owl-mousedrag="on"> 

              <div class="pay-ccl-m2">
                <div class="pay-ccl2 pay-1" >
                  <img src="{{ asset('assets/images/icons/1.png') }}">              
                </div>
                <p class="fc"><strong>100% Satisfaction</strong></p>
                <p>Shop with peace of mind thanks to our 100% satisfaction guarantee!</p>
              </div>
              <div class="pay-ccl-m2">
                <div class="pay-ccl2 pay-1" >
                  <img src="{{ asset('assets/images/icons/2.png') }}">              
                </div>
                <p class="fc"><strong>Secure checkout</strong></p>
                <p>We utilise SSL-encrypted technology, ensuring secure checkout every time. </p>
              </div>
              <div class="pay-ccl-m2">
                <div class="pay-ccl2 pay-1" >
                  <img src="{{ asset('assets/images/icons/3.png') }}">              
                </div>
                <p class="fc"><strong>Fast delivery</strong></p>
                <p>Our dedicated delivery drivers mean your goods will arrive in as little as 30 minutes!</p>
              </div>

            </div>
          </div>


        </div>
      </div>
    </div>

      {{-- <div class="container mt-100">
        <div class="lsm-features">
          <div class="row">

            <div class="col-md-4">
              <div class="lsm-feature-card">
                <div class="d-inline-flex">
                  <div class="f-iconi">
                    <img src="{{asset('assets/front/img/new/lsm-icon3.png')}}">
                  </div>
                  <div>
                    <h4>100% Satisfaction</h4>
                    <p>Quality Guaranteed Every Time, Shop With Peace of mind</p>
                  </div>
                </div>

              </div>
            </div>


            <div class="col-md-4">
              <div class="lsm-feature-card">
                <div class="d-inline-flex">
                  <div class="f-iconi">
                   <img src="{{asset('assets/front/img/new/lsm-icon2.png')}}">
                  </div>
                  <div>
                    <h4>Secure Payment</h4>
                    <p style="    width: 260px;padding-right: 20px">Pay safely with SSL encrypted security </p>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-md-4">
              <div class="lsm-feature-card">
                <div class="d-inline-flex">
                  <div class="f-iconi">
                    <img src="{{asset('assets/front/img/new/lsm-icon1.png')}}">
                  </div>
                  <div>
                    <h4>Fast Shipping</h4>
                    <p>Click & Collect or Same Day Delivery* Cut off times apply</p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        
      </div> --}}
     
{{--      <div class="wsn-lg-banner1">
       <div class="">
         <img src="{{ asset('assets/images/icons/ban12.png') }}">
       </div>
     </div> --}}

     <div class="wsn-lg-banner2 mb-50">
       <div class="mt-50 text-center">
         <img src="{{ asset('assets/images/icons/ban14.png') }}">
       </div>
     </div>

      {{-- <div class="container mt-100">
        <div class="row">
          <div class="col-md-6">
            <div class="" ><img  src="{{asset('assets/images/banners/'.$mid_small_banner->photo)}}"></div>

          </div>
          <div class="col-md-6 sec-vid-2 align-self-center">
            <h2 class="">World Shops for Business</h2>
            <div class="content-2">
              <p class="font-16 text-dark">{!! $mid_small_banner->head_desc !!}</p>
              
            </div>
            <div class="">
              <a class="ls-md-btn round" href="{{route('front.contact')}}">Enquire</a>
            </div>
          </div>
        </div>
      </div> --}}



      {{-- <div class="container mt-30 mb-30  app_banner">
        <img src="{{asset('assets/front/img/new/appbanner.png')}}" alt="Snow" style="width:1200px;border-radius: 30px;">
        <div class="links" style="">
              <p class="download-link">
                <a href="{{route('front.coming-soon')}}"><img src="{{asset('assets/front/img/google-play.png')}}" alt=""></a>
                <a href="{{route('front.coming-soon')}}"><img src="{{asset('assets/front/img/app-store.png')}}" alt=""></a>
              </p>
        </div>
      </div> --}}
{{--       <div class="wsn-work-w-us">
        <div class="container bck-cl">
          <h2 class="text-center mb-30">Work with us</h2>

          <div class="row" style="margin: 0 40px">
            <div class="col-lg-4 col-md-6">
              <div class="lsm-work-card">
                <img src="{{asset('assets/images/icons/w1.png')}}">
                <div class="text-center">
                  <p class="fw-bold lsm-w-h">Riders</p>
                  <p class="mb-30">Become a Rider and support your local community, Enjoy Endless Benefits</p>
                </div>
                <div class=" lsm-work-bt">
                  <a href="{{route('front.contact')}}" class="ls-md-btn round">Ride with Us</a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="lsm-work-card">
                <img src="{{asset('assets/images/icons/w2.png')}}">
                <div class="text-center">
                  <p class="fw-bold lsm-w-h ">Local Shops</p>
                  <p class="mb-30">Partner with World Shops and reach more customers on a day to day basis</p>
                </div>
                <div class=" lsm-work-bt">
                  <a href="{{route('front.contact')}}" class="ls-md-btn round">Partner with Us</a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="lsm-work-card">
                <img src="{{asset('assets/images/icons/w3.png')}}">
                <div class="text-center">
                  <p class="fw-bold lsm-w-h">Careers</p>
                  <p class="mb-30">Our goal is to support local communities by encouraging local shopping.</p>
                </div>
                <div class="lsm-work-bt">
                  <a href="{{route('front.contact')}}" class="ls-md-btn round">Join us now</a>
                </div>
                
              </div>
            </div>          
          </div>

        </div>
      </div>
 --}}





      @include('front.layouts.footer')
    </main>

     @include('includes.front.modals')





   @include('front.layouts.scripts')

  <script type="text/javascript">
    
    @if (\Session::has('session_msg'))
         var msg="{!! \Session::get('session_msg') !!}";
         toastr.info(msg); 
    @endif

  </script>
   
  </body>
</html>