@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
    
      <div class="section-user-dashboard" style="min-height: 350px;">
        <div class="container ls-content-2">
          <div class="row">
            <div class="col-12"> 

                <div class="user-order-details">
                  <div class="ls-user-order-details-head">
                     <h4>Order Details</h4>
                     <p>Your Order No : {{$order->order_number}}{{--  is on the way and was shipped 20 mins before --}}</p>
                     <hr>
                     <h5 class="mt-20">Order Status</h5>
                     <p>{{$order->status}}</p>
                     <hr>
                     <h5 class="mt-20">Your Orders</h5>
                     <div class="ls-order-details-card ">
                       @foreach($cart->items as $product)

                                @if($product['item']['user_id'] != 0)
                                    @php
                                    $user = App\Models\User::find($product['item']['user_id']);
                                    @endphp

                                    @break

                                @endif
                       @endforeach
                       @if(isset($user))
                       <div class="ordtls-head">
                         <img src="{{asset('assets/images/vendor/'.$user->shop_image)}}">
                         <p class="align-self-center">{{$user->shop_name}} ({{$user->IsStoreOpen()?'Open':'Closed'}})</p>
                       </div>
                       @endif

                       <hr>
                       <div class="ordtls-content">
                         <ul class="lst-st">
                          @php
                          $subtotal = 0;
                          @endphp
                          @foreach($cart->items as $product)
                           <li class="end-t-end">
                             <div>
                               <span class="test-dark">{{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}</span>
                               
                             </div>
                             <p>  {{$product['qty']}} *  {{round($product['item']['price'] * $order->currency_value,2)}} = {{$order->currency_sign}}{{round($product['price'] * $order->currency_value,2)}}</p>
                           </li>
                            @php
                            $subtotal += round($product['price'] * $order->currency_value, 2);
                            @endphp
                           @endforeach
                          
                         </ul>
                       </div>
                     </div>
                    <hr>
                      <div class="ls-order-summary mt-30">
                        <h5>Order Summary</h5>
                        <ul class="ul-style">
                          <li class="end-t-end">                            
                             <p class="mt-10 ">Item Subtotal</p>
                             <p>{{$order->currency_sign}}{{ round($subtotal, 2) }}</p>
                          </li>
                          @if($order->tax != 0)
                          <li class="end-t-end">                            
                             <p class="mt-10 ">Service Charges</p>
                              @php
                              $tax = ($subtotal / 100) * $order->tax;
                              @endphp
                             <p>{{$order->currency_sign}} {{ round($tax , 2) }}</p>
                          </li>
                          @endif
                          <li class="end-t-end">                            
                             <p class="mt-10 ">Govt Bag Charges</p>
                             <p>{{$order->currency_sign}} {{ round($order->gov_bag_charges , 2) }}</p>
                          </li>

                            @if($order->shipping_cost != 0)
                            <li class="end-t-end">
                                <p>{{ __('Shipping Cost') }}</p>
                                <p>{{$order->currency_sign}} {{ round($order->shipping_cost , 2) }}</p>
                            </li>
                            @endif
                           
                             @if($order->coupon_discount != null)
                              <li class="end-t-end">
                                  <p>{{ __('Coupon Discount') }}</p>
                                  <p>{{$order->currency_sign}} {{round($order->coupon_discount, 2)}}</p>
                              </li>
                              @endif

                          <hr>
                          <li class="end-t-end">                            
                            <h5>Total</h5>
                            <h5>{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}</h5>
                          </li>                    
                        </ul>
                      </div>

                      <div class="row ls-shipped-orio mt-30">
                        <div class="col-md-2">
                          <h5>Shipped To</h5>
                          <ul class="ul-style">
                            <li><p>{{$order->customer_name}} </p> </li>
                            <li><p>{{$order->customer_address}}</p></li>
                            <li><p>{{$order->customer_email}}</p></li>
                            <li><p>{{$order->customer_country}}</p></li>
                            <li><p>{{$order->customer_city}}</p></li>
                            <li><p>{{$order->customer_zip}}</p></li>

                          </ul>                         
                        </div>
                        <div class="col-md-2">
                          <h5>Billed To</h5>
                          <ul class="ul-style">

                            <li><p>{{$order->shipping_name}} </p> </li>
                            <li><p>{{$order->shipping_address}}</p></li>
                            <li><p>{{$order->customer_email}}</p></li>
                            <li><p>{{$order->shipping_country}}</p></li>
                            <li><p>{{$order->shipping_city}}</p></li>
                            <li><p>{{$order->shipping_zip}}</p></li>

                          </ul>
                        </div>
                        <div class="col-md-2">
                          <h5>{{ __('Shipping Method') }}</h5>
                          <ul class="ul-style">
                            <li>
                              @if($order->methodofcollect == 0)
                                  {{ __('Pick Up') }}
                                  @else
                                  {{ __('Ship To Address') }}
                              @endif
                            </li>
                          </ul>
                        </div>




                      </div>
                        <hr>
                        <div class="back-to-user-dash mt-30">
                          <a href="{{ route('user-orders') }}" class="ls-md-btn">Back</a>
                        </div>                      

                  </div>

                  
                </div>

            </div>
          </div>
        </div>  
      </div>    
@endsection
@section('pagelevel_scripts')
@endsection
  