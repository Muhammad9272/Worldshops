@extends('front.layouts.app')
@section('pagelevel_css')

@endsection
@section('page_content')

<div class="preloader" id="preloader" style="background: url({{asset('assets/images/spinner.gif')}}) no-repeat scroll center center #80808069;display: none;"></div>
    <div class="ls-content-bg">
      <div class="section-product" style="min-height: 350px;">
        <div class="container ls-content-2 mt-50">
          @if(Session::has('cart'))
            @if(Auth::check())
             {{--  <h2 class="text-center mb-30 ">Secure Checkout</h2> --}}
              <div class="row">

                <div class="col-lg-8">
                  <div class="ws-sc-new">
                   <form  id="checkoutform" action="{{ route('stripe.submit') }}" method="POST" class="checkoutform">


                      @include('includes.form-success')
                      @include('includes.form-error')
                      <div id="cpointed-area">
                       @include('includes..admin.form-both')
                      </div>

                      {{ csrf_field() }}

                        <div class="checkout-left-cont pills-tab active" id="pills-step1-tab" >

                          <div class="col-md-6 pl-0 chkout-rw mt-20">
                            <label  class="chk-label">Schedule Your Delivery</label>
                            <div class="mt-10">
                              <div class="form-check d-inline-flex" >
                                <input class="form-check-input time_check"  type="radio" name="time_check" id="timecheck0" value="0"  checked="">
                                <label class="form-check-label" for="timecheck0">
                                  Now 
                                </label>
                              </div>
                              <div class="form-check d-inline-flex ml-10">
                                <input class="form-check-input time_check" type="radio" name="time_check" id="timecheck1"  value="1">
                                <label class="form-check-label" for="timecheck1">
                                  Later
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6"></div>
                        
                          <div class="" id="pick_time" style="display: none">
                              <div class="row ml-10" >
                                <div class="col-md-6 chkout-rw">
                                 <label  class="chk-label">Date</label>
                                 <input type="date" id="post-schedule" name="date" class="form-control chkout-form-control" >                                
                                </div>                                
                               <div class="col-md-6 chkout-rw">
                                 <label  class="chk-label">Time</label>                                
                                 <select  name="time" required="" class="form-control chkout-form-control">
                                   <option value="8:00am to 10:00am">8:00am to 10:00am </option>
                                   <option value="10:00am to 12:00pm">10:00am to 12:00pm </option>
                                   <option value="12:00pm to 2:00pm">12:00pm to 2:00pm </option>
                                   <option value="2:00pm to 4:00pm">2:00pm to 4:00pm</option>
                                   <option value="4:00pm to 6:00pm ">4:00pm to 6:00pm </option>
                                   <option value="6:00pm to 8:00pm ">6:00pm to 8:00pm  </option>

                                 </select>
                                </div>

                              </div>
                          </div>
                          @if(Session::has('shop_name'))
                            @php
                            $seller_store=App\Models\User::where('shop_name',Session::get('shop_name') )->where('ban','!=',1)->first();
                            @endphp
                            @if(!empty($seller_store->lead_time) )
                            <div class="row">
                              <div class="col-md-6">
                                <div class="leading-time alert alert-info">
                                  <p><i class="fa fa-info-circle"></i> {{$seller_store->lead_time}}</p>
                                </div>
                              </div>
                            </div>
                            @endif
                          @endif

                          <h4 class="mt-20 mb-20">Delivery Address</h4>                 
                            <div class="checkout-delivery-from" id="delivery-f">    
                               @if($shipaddress->count()>0)  
                                  @foreach($shipaddress as $key=>$addata)         
                                    <div class="form-check">
                                      <input class="form-check-input deliveryaddress" type="radio" value="{{$addata->id}}" name="deliveryaddress" id="deliveryaddress2{{$key}}" {{$key==0?"checked":''}}>
                                      <label class="form-check-label fm-cir" for="deliveryaddress2{{$key}}">
                                        {{$addata->street_address}}
                                      </label>
                                    </div>
                                  @endforeach
                                @endif
                      
                                <div class="form-check">
                                  <input class="form-check-input deliveryaddress" type="radio" name="deliveryaddress" id="flexRadioDefault2" value="0" {{!$shipadd?'checked':""}} >
                                  <label class="form-check-label fm-cir" for="flexRadioDefault2">
                                    Add New Address
                                  </label>
                                </div>

                                <div class="row mt-40">
                                  <div class="col-md-6 chkout-rw">
                                    {{-- <label class="chk-label">Flat Number / building name</label> --}}
                                    <input type="text" name="flat_no" required="" class="form-control chkout-form-control dflat_no" placeholder="Flat Number / building name" value="{{ $shipadd?$shipadd->flat_no:''}}">
                                  </div>
                                  <input type="hidden" name="address_book_id" value="{{ $shipadd?$shipadd->id:0}}">
                                  <div class="col-md-6"></div>

                                  <div class="col-md-6 chkout-rw">
                                    <label  class="chk-label">{{-- Street Address * --}}</label>
                                    <input type="text" name="street_address" required="" class="form-control chkout-form-control dstreet_address" id="Dgoogle_address" onfocus="initDGoogleAddress()"  placeholder="Address line 1" value="{{ $shipadd?$shipadd->street_address:''}}" >
                                    <span id="error_address"></span>


                                    <input type="hidden" class="dlatitude" id="dlatitude" name="latitude">           
                                    <input type="hidden" class="dlongitude" id="dlongitude" name="longitude"> 

                                  </div>
                                  <div class="col-md-6"></div>

                                  <div class="col-md-6 chkout-rw">
                                   <label class="chk-label">{{-- Postcode --}}</label>
                                   <input type="text" id="postcode" name="zip" required="" class="form-control chkout-form-control dzip" placeholder="Postcode" value="{{ $shipadd?$shipadd->zip:''}}" >
                                  </div>

                                  <div class="col-md-6 chkout-rw">
                                    <label class="chk-label">{{-- Phone --}} </label>
                                    <input type="text" name="phone" required="" class="form-control chkout-form-control dphone" placeholder="Contact Number" value="{{ $shipadd?$shipadd->phone:''}}">
                                  </div>
                                  <div class="col-md-12 chkout-rw">
                                    <label class="chk-label">{{-- Instructions --}} </label>
                                    <textarea class="form-control chkout-form-control" name="instructions" placeholder="Instructions for your courier"></textarea>
                                  </div>


                                </div>
                            </div>



                            <h4 class="mt-30 mb-20">Secure Card Payment</h4>
                              <div class="payment-final-from ml-20  ">

                                  <div class="row lsm-checkout-process">
                                    <div class="payment-information col-md-12">
                                        <div class="end-t-end">
                                          <h4 class="title">
                                              {{ $langg->lang759 }}
                                          </h4>
                                          @if($usercard)
                                          <div class="">
                                            <a href="javascript:;" class="paymentchange"><strong class="text-red">Change</strong></a>
                                          </div>
                                          @endif
                                        </div>
                                        <div class="row">
                                            {{-- <div class="col-lg-12">
                                                <div class="nav flex-column" role="tablist" aria-orientation="vertical">
                                                    @if($gs->paypal_check == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no" data-form="{{route('paypal.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'paypal','slug2' => 0]) }}" id="v-pills-tab1-tab" data-toggle="pill" href="#v-pills-tab1" role="tab" aria-controls="v-pills-tab1" aria-selected="true">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            Paypal

                                                            @if($gs->paypal_text != null)

                                                            <small>
                                                                {{ $gs->paypal_text }}
                                                            </small>

                                                            @endif

                                                        </p>
                                                    </a>
                                                    @endif
                                                    @if($gs->stripe_check == 1)
                                                    <a class="nav-link payment" data-val="" data-show="yes" data-form="{{route('stripe.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'stripe','slug2' => 0]) }}" id="v-pills-tab2-tab" data-toggle="pill" href="#v-pills-tab2" role="tab" aria-controls="v-pills-tab2" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ $langg->lang761 }}

                                                            @if($gs->stripe_text != null)

                                                            <small>
                                                                {{ $gs->stripe_text }}
                                                            </small>

                                                            @endif

                                                        </p>
                                                    </a>
                                                    @endif

                                                    @if($gs->cod_check == 1)
                                                    <a class="nav-link payment" data-val="" data-show="no" data-form="{{route('cash.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'cod','slug2' => 0]) }}" id="v-pills-tab3-tab" data-toggle="pill" href="#v-pills-tab3" role="tab" aria-controls="v-pills-tab3" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            {{ $langg->lang762 }}

                                                            @if($gs->cod_text != null)

                                                            <small>
                                                                {{ $gs->cod_text }}
                                                            </small>

                                                            @endif

                                                        </p>
                                                    </a>
                                                    @endif

                                                  @if($gs->worldpay_check == 1)
                                                    <a class="nav-link payment" data-val="" data-show="yes" data-form="{{route('worldpay.submit')}}" data-href="{{ route('front.load.payment',['slug1' => 'worldpay','slug2' => 0]) }}" id="v-pills-tab4-tab" data-toggle="pill" href="#v-pills-tab4" role="tab" aria-controls="v-pills-tab4" aria-selected="false">
                                                        <div class="icon">
                                                            <span class="radio"></span>
                                                        </div>
                                                        <p>
                                                            WorldPay

                                                            @if($gs->stripe_text != null)

                                                            <small>
                                                                {{ $gs->worldpay_text }}
                                                            </small>

                                                            @endif

                                                        </p>
                                                    </a>
                                                  @endif



                                                </div>
                                            </div> --}}
                                            @if($usercard)
                                            <div class="col-lg-12 wsdpayments1" >
                                              <div class="ws-payment-info">
                                                <img src="{{asset('assets/front/img/visa-logo.png')}}">
                                                <p class="align-self-center ml-10 mb-0">XXXX-XXXX-XXXX {{substr ($usercard->card_no, -4)}}</p>
                                              </div>
                                            </div>
                                            
                                            <div class="otherpaymentsshh no-display">
                                              @foreach($usercards as $key=>$othrcards)
                                              <div class="col-lg-12">
                                                 <div class="form-check other_payemntsd" >
                                                    <input data-card-no="{{$othrcards->card_no}}" data-date="{{$othrcards->date}}" data-cvv="{{$othrcards->cvv}}"
                                                     class="form-check-input payments_check"  type="radio" name="paymentscheck" id="paymentscheck{{$key}}" value="0"  {{$othrcards->primary==1?'checked':''}}>

                                                    <label class="form-check-label" for="paymentscheck{{$key}}">
                                                      <div class="d-inline-flex">
                                                        <img src="{{asset('assets/front/img/visa-logo.png')}}">
                                                        <p class="align-self-center ml-10 mb-0">XXXX-XXXX-XXXX {{substr ($othrcards->card_no, -4)}}</p>
                                                      </div>
                                                    </label>
                                                  </div>
                                              </div>
                                              @endforeach

                                              <div class="col-lg-12">
                                                <div class="other_payemntsd">
                                                <a href="" id="newpaymentmethod">
                                                  <h5 class="ws-hed"><i class="fa fa-plus "></i> &nbsp; Add Payment Method</h5>
                                                </a>
                                                </div>
                                              </div>
                                            </div>




                                            @endif
                                            <div class="col-lg-12 wsdpayments2 {{$usercard?'no-display':''}}" >  
                                              @if($gs->stripe_check == 1) 
                                              
                                                <input type="hidden" name="method" value="Stripe">
                                                <div class="row payment_inputs" >
                                                   <div class="col-lg-12">
                                                      <input class="form-control card-elements" name="cardNumber" id="cardNumber" type="text" placeholder="Card Number" autocomplete="off"   oninput="validateCard(this.value);" value="{{$usercard?$usercard->card_no:''}}" />
                                                      {{-- <input type="text" class="form-control card-elements" autocomplete="off"  autofocus  id="giveme" name="cardNumber" oninput="validateCard(this.value);" placeholder="Enter Card Number"  value="{{$usercard?$usercard->card_no:''}}" > --}}

                                                      <span id="errCard"></span>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <input class="form-control card-elements" name="cardDate" value="{{$usercard?$usercard->date:''}}" id="cardDate" type="text" placeholder="Expiry Date MM/YY"  />
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <input class="form-control card-elements" name="cardCVC" id="cardCVC" type="text" placeholder="CVV" value="{{$usercard?$usercard->cvv:''}}" autocomplete="off"  oninput="validateCVC(this.value);" />
                                                      <span id="errCVC"></span>
                                                   </div>
                                                   {{-- <div class="col-lg-6">
                                                      <input class="form-control card-elements" name="month" value="{{$usercard?$usercard->month:''}}" type="text" placeholder="Enter Expiry Month"  />
                                                   </div> --}}
                                                   
                                                </div>

                                              @endif
                                            </div>


                                            {{-- <div class="col-lg-12">
                                                <div class="pay-area d-none">
                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        @if($gs->paypal_check == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1-tab">

                                                        </div>
                                                        @endif
                                                        @if($gs->stripe_check == 1)
                                                        <div class="tab-pane fade" id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2-tab">
                                                        </div>
                                                        @endif
                                                        @if($gs->cod_check == 1)                                                      
                                                        <div class="tab-pane fade" id="v-pills-tab3" role="tabpanel" aria-labelledby="v-pills-tab3-tab">
                                                        </div>
                                                        @endif
                                                        @if($gs->worldpay_check == 1)                                                      
                                                        <div class="tab-pane fade" id="v-pills-tab4" role="tabpanel" aria-labelledby="v-pills-tab4-tab">
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>




                                    <p><span>Total Payable : </span> <span id="tincheck" class="text-dark bold-label"> {{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice + App\Models\Product::servicecharges() ) : '0.00' }} </span> </p>



                                  </div>
                              </div>
                            <h4 class="mt-20 mb-20">Do You have a Discount Code ?</h4>
                              <div class="payment-coupon-from ml-20">
                                  <div class="row ">
                                    <div class="col-md-8">
                                     <div class="from-group gnrl-searchbar-parent pmt-grp-1 ">
                                       <input type="text" class="form-control gnrl-searchbar coupon-v bg-cl-in" name="coupon" value="" >
                                       <a href="javascript:;"  class="gnrl-searchbar-btn hm-btn-st-search" id="chkoutcoupon">Apply</a>
                                     </div>
                                    </div>
                                  </div>
                              </div>                              

              
                        </div> 



                      <input type="hidden" id="shipping-cost" name="shipping_cost" value="{{ Session::has('cart') ? Session::get('cart')->sshipping_cost : '0' }}">
                      <input type="hidden" id="packing-cost" name="packing_cost" value="0">
                      <input type="hidden" name="dp" value="0">
                      <input type="hidden" name="tax" value="{{$gs->tax}}">
                      <input type="hidden" name="totalQty" value="{{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }}">

                      <input type="hidden" name="gov_bag_charges" value="{{$gs->gov_bag_charges }}">
                      <input type="hidden" name="service_charges" value="{{ $gs->service_charges }}">

                      <input type="hidden" name="vendor_shipping_id" value="198677">
                      <input type="hidden" name="vendor_packing_id" value="198677">


                      @if(Session::has('coupon_total'))

                      <input type="hidden" name="total" id="grandtotal" value="{{ Session::has('cart') ? Session::get('cart')->totalPrice : '0' }}">

                     {{--  <input type="hidden" id="tgrandtotal" value="{{round(Session::get('coupon_total') * $curr->value,2)}}"> --}}
                      @else
                      <input type="hidden" name="total" id="grandtotal" value="{{ Session::has('cart') ? Session::get('cart')->totalPrice : '0' }}">
                      @endif


                      <input type="hidden" name="coupon_code" id="coupon_code" value="{{ Session::has('coupon_code') ? Session::get('coupon_code') : '' }}">
                      <input type="hidden" name="coupon_discount" id="coupon_discount" value="{{ Session::has('coupon') ? Session::get('coupon') : '' }}">
                      <input type="hidden" name="coupon_id" id="coupon_id" value="{{ Session::has('coupon') ? Session::get('coupon_id') : '' }}">
                      <input type="hidden" name="user_id" id="user_id" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->id : '' }}">

                      <div class="col-md-12 end-t-end mt-30 ">
                        <button type="submit"  class="ws-btn submit-btn">Place Your Order</button>
                      </div>




                    </form>
                  </div>
                </div>


                <div class="col-lg-4 col-md-6 sticky-bucket">
                    @include('includes.front.bucket')
                </div>
              </div>
            @else
             <h3 class="text-center">Please Login First !</h3>
            @endif
          @else
             <h3 class="text-center">Cart is empty</h3>
          @endif
        </div>  
      </div>
    </div> 

  @if(isset($checked))
    <!---- Login Modal ------>
    <div class="modal  ls-modal" id="CMLoginModal" tabindex="-1" data-keyboard="false" data-backdrop="static"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered  ls-login-content" role="document">
        <div class="modal-content ">

          <div class="modal-header1 mb-20">
            <h2 class="modal-title text-center mt-30" >
              Welcome back to
            </h2>  
            <div class="ps-logo text-center"><a href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
            </div>                
          </div>

          <div class="modal-body ls-content">


            <div class="ls-login-form signin-form">
              @include('includes.admin.form-login')
              <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
                {{ csrf_field() }}
                <div class="from-group ls-lg-grp">
                  <i class="fa fa-envelope-o"></i>
                  <input type="email" class="form-control ls-lg-form-control" name="email" placeholder="Email">
                </div>
                <div class="from-group ls-lg-grp">

                  <i class="fa fa-key"></i>
                  <input type="password" class="form-control ls-lg-form-control" name="password" placeholder="Password">

                </div>
                <input type="hidden" name="modal" value="1">
                <input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
                <div class="form-group end-t-end">
                    <div class="ps-checkbox">
                        <input class="form-control"  type="checkbox" name="remember" id="mrp" {{ old('remember') ? 'checked' : '' }}>
                        <label for="mrp">Rememeber me</label>
                    </div>
                    <div>
                      <a href="#" class="ls-link ls-modal-close" data-toggle="modal" data-target="#ForgotModal">Forgot Password ?</a>
                    </div>                  
                </div>
                

                <div class="from-group ls-btn-login">
                  <button class="ws-btn ws-btn-lg submit-btn">Login</button>
                </div>
                
                <div class="ls-login-footer text-center">
                  <p>Not Registered ? <span class="text-red"><a href="#" class="ls-modal-close" data-toggle="modal" data-target="#CMRegisterModal" >Join Now</a></span></p>
                </div>
              </form>

              <p class="text-center text-dark mt-20"><strong>OR</strong></p>
              @if(App\Models\Socialsetting::find(1)->f_check == 1)
                <div class="form-group mb-10">
                  <a class="ws-btn-social facebooks" href="{{ route('social-provider','facebook') }}"><i style="width: 45px;" class="fa fa-facebook"></i>Continue with facebook</a>
                </div>
              @endif
              @if(App\Models\Socialsetting::find(1)->g_check == 1)
                <div class="form-group">
                  <a class="ws-btn-social googles"  href="{{ route('social-provider','google') }}">
                    <span class="pr-10">
                      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg>
                    </span>
                    Continue with Google
                  </a>
                </div>
              @endif

            </div>

          </div>
         
        </div>
      </div>
    </div>
    <!-- Login Modal End ---->

    <!-- Register Modal  ---->
    <div class="modal ls-modal" id="CMRegisterModal" tabindex="-1" data-keyboard="false" data-backdrop="static"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered  ls-login-content ls-reg"  role="document">
        <div class="modal-content ">
        <div class="modal-header1 mb-20">
          <h2 class="modal-title text-center mt-30" >
            Welcome back to
          </h2>    
          <div class="ps-logo text-center"><a href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
          </div>                
        </div>
          <div class="modal-body ls-content">            
            <div class="ls-login-form signup-form">
              @include('includes.admin.form-login')
              <form class="mregisterform" action="{{route('user-register-submit')}}"
                      method="POST">
                      {{ csrf_field() }}

              <div class="row">
                <div class="col-6 ls-lg-grp pr-5">
                  <i class="icon-user"></i>
                  <input type="text" class="form-control ls-lg-form-control" name="name" placeholder="First Name" required="">
                </div>
                <div class="col-6 ls-lg-grp pl-5">
                  <i class="icon-user"></i>
                  <input type="text" class="form-control ls-lg-form-control" name="lname" placeholder="Last Name">
                </div>                                
              </div>            
                <div class="from-group ls-lg-grp">
                  <i class="fa fa-envelope-o"></i>
                  <input type="email" class="form-control ls-lg-form-control" required="" name="email" placeholder="Email">
                </div>
              <div class="from-group ls-lg-grp">
                <i class="fa fa-phone"></i>
                <input type="text"  class="form-control ls-lg-form-control" required="" name="phone" placeholder="Phone format eg +447244012333 ">
              </div>

                <div class="from-group ls-lg-grp">
                  <i class="fa fa-key"></i>
                  <input type="password" class="form-control ls-lg-form-control" required="" name="password" placeholder="Password">
                </div>


                <div class="from-group ls-lg-grp">
                  <i class="fa fa-key"></i>
                  <input type="password" class="form-control ls-lg-form-control" name="password_confirmation" placeholder="Confirm Password" required="">
                </div>
                <input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
                <input type="hidden" name="modal" value="1">

                <p class="mt-10">By joining us You agree to the our <a href="#" class="ls-link-no-border">User Agreement, </a> <a href="#" class="ls-link-no-border">Privacy Policy,</a> and 
                  <a href="#" class="ls-link-no-border">Cookie Policy</a>.</p>
                <div class="from-group ls-btn-login">
                  <button class="ws-btn ws-btn-lg submit-btn">Agree & join</button>
                </div>
                

              </form>
              <p class="text-center text-dark mt-20"><strong>OR</strong></p>
              @if(App\Models\Socialsetting::find(1)->f_check == 1)
                <div class="form-group mb-10">
                  <a class="ws-btn-social facebooks" href="{{ route('social-provider','facebook') }}"><i style="width: 45px;" class="fa fa-facebook"></i>Continue with facebook</a>
                </div>
              @endif
              @if(App\Models\Socialsetting::find(1)->g_check == 1)
              <div class="form-group">
                <a class="ws-btn-social googles"  href="{{ route('social-provider','google') }}">
                  <span class="pr-10">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg>
                  </span>
                  Continue with Google
                </a>
              </div>
              @endif 

                <div class="ls-login-footer text-center">
                  <p>Already Registered ? <span class="text-red"><a href="#" class="ls-modal-close" data-toggle="modal" data-target="#CMLoginModal"  >Sign In</a></span></p>
                </div>

            </div>

          </div>
         
        </div>
      </div>
    </div>
    <!-- Register Modal End ---->
  @endif


@endsection
@section('pagelevel_scripts')
<script type="text/javascript">


$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);

    // alert(maxDate);
    $('#post-schedule').attr('min', maxDate);
});




  $(function(){

   @if(isset($checked))
    $('#CMLoginModal').modal('show');
   @endif



    $('.time_check').on('change',function() {
      var flag=$(this).val();
      if(flag==1){
              $('#pick_time').show();

              $('#pick_time input').attr('required',true);
      }
      else{
             $('#pick_time').hide();
             $('#pick_time input').attr('required',false);
      }
    });


 
  });


</script>




<script type="text/javascript">

  $(function(){
    $('.deliveryaddress').change(function() {
        if (this.value == 0) {
            $("#delivery-f input[type=text]").val('');
            $("#delivery-f input[name=address_book_id]").val(0);
        }
        else {
            var address_id=this.value;
            if(address_id){
                $.ajax({
                   type:"GET",
                   url:"{{url('get-uaddress-list')}}?address_id="+address_id,
                   success:function(res){               
                    if(res){
                         console.log(res);

                         $("#delivery-f input[type=text]").val('');
                         $("#delivery-f .dflat_no").val(res.flat_no);
                         $("#delivery-f .dstreet_address").val(res.street_address);
                         $("#delivery-f .dzip").val(res.zip);
                         $("#delivery-f .dphone").val(res.phone);

                         $("#delivery-f input[name=address_book_id]").val(res.id);

                         $("#delivery-f .dlongitude").val(res.longitude);
                         $("#delivery-f .dlatitude").val(res.latitude);
                                      
                    }else{
                       $("#delivery-f input[type=text]").val('');
                    }
                   }
                });
            }else{
               $("#delivery-f input[type=text]").val('');
            }  

        }
    });

    $('.payments_check').change(function() {

         $('#cardNumber').val($(this).attr('data-card-no'));
         $('#cardDate').val($(this).attr('data-date'));
         $('#cardCVC').val($(this).attr('data-cvv'));
    });


  });
</script> 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">

     
      
{{--     $('#Dgoogle_address').blur(function(){

      var lat=$('#dlatitude').val();
      var long=$('#dlongitude').val();

      $.ajax({
             type:"GET",
             url:"{{url('validate-location')}}/"+lat+'/'+long,
             success:function(res)
             {               
              if(res==1)
              {     

                    var form = $(".checkoutform");
                    form.validate();

                    $('#error_address').html('');
                    $('#error_address').html('<label class="text-success">Delivery Available!</label>');
                   $('#Dgoogle_address').removeClass('has-error');
                 
              }
              else 
              {    
                   $('#error_address').html('');
                   $('#error_address').html('<label class="text-danger">Delivery is not not available in that area !</label>');
                   $('#Dgoogle_address').addClass('has-error');


                  $('#Dgoogle_address').focus();
              }
            }
      });

       



    }); --}}






{{--   $('.checkoutform').on('submit',function(e){
      e.preventDefault(); 
      if( $(this).attr('action')==''){

      toastr.error('Please select payment method !');
      return;
      }
      $('.checkoutform')[0].submit();
      $('#preloader').show();
  
      $('#pills-step2-tab').removeClass('active');
      $('#step2-btn').click();

      $('#preloader').show();
      $('#pills-step1-tab').addClass('active');

  }); --}}



  {{--$('.payment').on('click',function(){
        if($(this).data('val') == 'paystack'){
            $('.checkoutform').prop('id','step1-form');
        }
        else {
            $('.checkoutform').prop('id','');
        }
        $('.checkoutform').prop('action',$(this).data('form'));
        $('.pay-area #v-pills-tabContent .tab-pane.fade').not($(this).attr('href')).html('');
        var show = $(this).data('show');
        if(show != 'no') {
            $('.pay-area').removeClass('d-none');
        }
        else {
            $('.pay-area').addClass('d-none');
        }
        $($(this).attr('href')).load($(this).data('href'));
    });--}}

</script>



<script>

    var autocomplete_origin;
    var autocomplete_destination;


    function initDGoogleAddress()
    {
        autocomplete_origin = new google.maps.places.Autocomplete(
            document.getElementById("Dgoogle_address"),
            {              
                types: ["geocode"],
                componentRestrictions:
                {
                    country: "UK"
                } 
            }
        );

        autocomplete_origin.addListener("place_changed", DfillInAddress_origin);
    }

    function DfillInAddress_origin()
    {
        // Get the place details from the autocomplete object.
        const place = autocomplete_origin.getPlace();
        
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        

        $('#dlongitude').val(lng);
        $('#dlatitude').val(lat);


        for (const component of place.address_components)
        {
 

                const addressType = component.types[0];
                if(componentForm[addressType])
                {
                    const val = component[componentForm[addressType]];    
                     if(addressType=="postal_code")
                    {
                        console.log(val);
                        document.getElementById("postcode").value=val;
                        
                    }

                }


        }
        
    }



</script>

<script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>
<script type="text/javascript">
  var cnstatus = false;
  var dateStatus = false;
  var cvcStatus = false;

  function validateCard(cn) {
  cnstatus = Stripe.card.validateCardNumber(cn);
  if (!cnstatus) {
  $("#errCard").html('{{ $langg->lang781 }}');
  } else {
  $("#errCard").html('');
  }



  }

  function validateCVC(cvc) {
  cvcStatus = Stripe.card.validateCVC(cvc);
  if (!cvcStatus) {
  $("#errCVC").html('{{ $langg->lang782 }}');
  } else {
  $("#errCVC").html('');
  }

  }



$('#checkoutform input').on('keyup keypress', function(e) {
    return e.which !== 13;
});


   $(document).on('click','.paymentchange',function (e) {
    e.preventDefault();
     $('.wsdpayments1').hide();
     $('.otherpaymentsshh').show();
     // $(".payment_inputs input").val('');
    
     $(this).hide();
   });
  $(document).on('click','#newpaymentmethod',function (e) {
    e.preventDefault();
    $('.otherpaymentsshh').hide();
     $('.wsdpayments2').show();
     $(".payment_inputs input").val('');         
   })


   
</script>
@endsection      
