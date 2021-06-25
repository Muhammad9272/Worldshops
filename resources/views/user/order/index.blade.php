@extends('front.layouts.app')
@section('pagelevel_css')

@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-user-dashboard" style="min-height: 350px;">
        <div class="container ls-content-2">
           <div class="row user-orders-pg">
              <div class="col-xl-4 col-lg-4 col-md-6 pdc-40">
                @include('includes.front.user-dashboard-sidebar')
              </div>
              <div class="col-xl-8 col-lg-8 col-md-12">
                 <div class="mt-10">
                   <h4>Your Orders</h4>
                   <p class="text-dark">View your order to see what you have purchased or track their delivery</p>
                   <hr>
                   <h5 class="mb-20 mt-20">Recent Orders({{count( $orders->where('status','pending') )}})</h5>
                   <p><span>Showing {{count( $orders->where('status','pending') )}}   orders</span></p>

                   <div class="row mt-20">
                    {{-- @foreach($orders->where('status','pending') as $order)
                     <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                       <div class="ls-user-order-card">
                          <div class="upper-or-card">
                            @php
                            $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
                            @endphp

                              @foreach($cart->items as $product)

                                @if($product['item']['user_id'] != 0)
                                    @php
                                    $user = App\Models\User::find($product['item']['user_id']);
                                    @endphp

                                    @break

                                @endif
                                  

                              @endforeach
                            @if(isset($user))
                                <div class="or-st-img">
                                  <img src="{{asset('assets/images/vendor/'.$user->shop_image)}}">
                                </div>
                                <p class="d-inline-flex">{{$user->shop_name}} ({{$user->IsStoreOpen()?'Open':'Closed'}})</p>
                            @endif
                          </div>
                          <div class="content-or-card">
                            <ul>
                              <li><strong>Order : </strong>{{$order->order_number}}</li>
                              <li><strong>Date : </strong>{{date('d M Y',strtotime($order->created_at))}}</li>
                              <li><strong>Total : </strong>{{$order->currency_sign}}{{ number_format($order->pay_amount * $order->currency_value , 2) }}</li>
                              <li class="ls-ch"><strong><a href="javascript:;" data-title="{{$order->status}}" class="track-mod-show"  data-toggle="modal" data-target="#trackmodal">Track My Order</a></strong></li>
                              <li class="ls-ch"><strong><a href="{{route('user-order',$order->id)}}">View Details</a></strong></li>
                            </ul>
                          </div>
                       </div>
                     </div>
                    @endforeach --}}


                    @foreach($orders->where('status','pending') as $key=>$order)
                      @php
                      $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
                      @endphp

                      <div class="ws-prod-usorder mb-20">
                        <div class="dpsame frorder">
                          <div class="col-md-6 ">
                            <h4>Order No: {{$order->order_number}}</h4>
                          </div>
                          <div class="col-md-6 text-right">
                            <h4>Total: <span class="tprice">{{$order->currency_sign}}{{ number_format($order->pay_amount * $order->currency_value , 2) }}</span></h4>
                          </div>
                        </div>
                        <div class="dpsame srorder mt-20">
                          <div class="col-md-4 d-inline-flex mbal">
                            <div class="iconicd">
                              <i class="fa fa-globe"></i>
                            </div>
                            <div class="contdi ml-10">
                              <p class="mb-0"><strong>Store :</strong> </p>
                              @foreach($cart->items as $product)

                                    @if($product['item']['user_id'] != 0)
                                    @php
                                    $user = App\Models\User::find($product['item']['user_id']);
                                    @endphp

                                    @break

                                @endif
                               @endforeach
                               @if(isset($user))
                                <p>{{$user->shop_name}}
                                  <br>
                                  <a href="javascript:;" data-toggle="modal" class="text-underline text-red vdrmsgbtn" data-target="#vendormsgmodal" data-store="{{$user->shop_name}}" data-order="{{$order->order_number}}" data-id="{{$user->id}}" data-phone="{{$user->shop_number}}" >Contact Seller</a> 
                                  
                                </p>
                                @endif
                            </div>
                          </div>
                          <div class="col-md-4 text-center mbal">
                            <div class="d-inline-flex">
                              <div class="iconicd">
                                <i class="fa fa-map-marker"></i>
                              </div>
                              <div class="contdi ml-10 text-justify">
                                <p class="mb-0"><strong>Delivery Address:</strong> </p>
                                <p>{{$order->customer_address_1}}</p>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-4  text-right mbal">
                             <div class="show-d-btn">
                               <a class="ws-btn showorder-detail" data-id="metal{{$key}}" href="">Show Details 
                                <span class="or-angle ml-10">
                                  <i class="fa fa-angle-right"></i>
                                  <i class="fa fa-angle-down no-display"></i>
                                </span> </a>
                             </div>
                          </div>
                        </div>

                        <div class="orders show-orderdetail no-display" id="metal{{$key}}">
                          <div class="prod-order-r">                              
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th class="fw-bold"></th>
                                    <th class="fw-bold" >Quantity</th>
                                    <th class="fw-bold text-center" >Cost</th>
                                    <th class="fw-bold text-center">Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php
                                  $subtotal = 0;  
                                  @endphp                                
                                  @foreach($cart->items as $product)
                                  <tr class="bb-in-tb">
                                    <th > {{-- <img src="{{ asset('assets/images/icons/prod.png') }}"> --}} 
                                    
                                      {{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}
                                    </th>
                                    <td>  {{$product['qty']}} </td>
                                    <td class="text-center">{{number_format($product['item']['price'] * $order->currency_value,2)}}</td>
                                    <td class="text-center">{{$order->currency_sign}}{{number_format($product['price'] * $order->currency_value,2)}}</td>
                                  </tr>

                                    @php
                                    $subtotal += number_format($product['price'] * $order->currency_value, 2);
                                    @endphp
                                  @endforeach
                                </tbody>
                              </table>
                          </div>
                          <div class="ttl-summary">
                            <div class="row">
                              <div class="col-7"></div>
                              <div class="col-5">
                               <div class="row">

                                 <div class="col-6"><p class="headt">Item Subtotal </p> </div> 
                                 <div class="col-6"><p>{{$order->currency_sign}}{{ number_format($subtotal, 2) }}</p></div>

                                 <div class="col-6"><p class="headt">Service Charges</p> </div> 
                                 <div class="col-6">
                                    @php
                                    $tax = ($subtotal / 100) * $order->tax;
                                    @endphp
                                   <p>{{$order->currency_sign}} {{ number_format($tax , 2) }}</p>
                                 </div>

                                 {{-- <div class="col-6"><p class="headt">Govt Bag Charges </p> </div> 
                                 <div class="col-6">
                                   <p>{{$order->currency_sign}} {{ number_format($order->gov_bag_charges , 2) }}</p>
                                 </div> --}}
                                 
                                 @if($order->shipping_cost != 0)
                                 <div class="col-6"><p class="headt">Delivery Cost</p> </div> 
                                 <div class="col-6"><p>{{$order->currency_sign}} {{ number_format($order->shipping_cost , 2) }}</p></div>
                                 @endif

                                @if($order->coupon_discount != null)
                                 <div class="col-6"><p class="headt">{{ __('Coupon Discount') }}</p> </div> 
                                 <div class="col-6"><p>{{$order->currency_sign}} {{number_format($order->coupon_discount, 2)}}</p></div>
                                 @endif

                                 <div class="col-6"><p class="headt">Total </p> </div> 
                                 <div class="col-6"><p>{{$order->currency_sign}}{{ number_format($order->pay_amount * $order->currency_value , 2) }}</p></div>
                                 
                               </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach


                     
                   </div>


                    <h5 class="mb-20 mt-40">Delivered Orders({{count( $orders->where('status', '!=' ,'pending') )}})</h5>
                    <hr>
                    <p><span>Showing {{count( $orders->where('status', '!=' ,'pending') )}}  orders</span></p>


                   <div class="row mt-20">
                    @foreach($orders->where('status', '!=' ,'pending') as $key=>$order)
                      @php
                      $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
                      @endphp
                      <div class="ws-prod-usorder mb-20">
                        <div class="dpsame frorder">
                          <div class="col-md-6 ">
                            <h4>Order No: {{$order->order_number}}</h4>
                          </div>
                          <div class="col-md-6 text-right">
                            <h4>Total: <span class="tprice">{{$order->currency_sign}}{{ number_format($order->pay_amount * $order->currency_value , 2) }}</span></h4>
                          </div>
                        </div>
                        <div class="dpsame srorder mt-20">
                          <div class="col-md-4 d-inline-flex mbal">
                            <div class="iconicd">
                              <i class="fa fa-globe"></i>
                            </div>
                            <div class="contdi ml-10">
                              <p class="mb-0"><strong>Store :</strong> </p>
                              @foreach($cart->items as $product)

                                @if($product['item']['user_id'] != 0)
                                    @php
                                    $user = App\Models\User::find($product['item']['user_id']);
                                    @endphp

                                    @break

                                @endif
                               @endforeach
                               @if(isset($user))
                                <p>{{$user->shop_name}}
                                  <br>
                                  <a href="javascript:;" data-toggle="modal" class="text-underline text-red vdrmsgbtn" data-target="#vendormsgmodal" data-store="{{$user->shop_name}}" data-order="{{$order->order_number}}" data-id="{{$user->id}}" >Contact Seller</a> 
                                  
                                </p>
                                @endif
                            </div>
                          </div>
                          <div class="col-md-4 text-center mbal">
                            <div class="d-inline-flex">
                              <div class="iconicd">
                                <i class="fa fa-map-marker"></i>
                              </div>
                              <div class="contdi ml-10 text-justify">
                                <p class="mb-0"><strong>Delivery Address:</strong> </p>
                                <p>{{$order->customer_address_1}}</p>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-4  text-right mbal">
                             <div class="show-d-btn">
                               <a class="ws-btn showorder-detail" data-id="metal1{{$key}}" href="">Show Details 
                                <span class="or-angle ml-10">
                                  <i class="fa fa-angle-right"></i>
                                  <i class="fa fa-angle-down no-display"></i>
                                </span> </a>
                             </div>
                          </div>
                        </div>

                        <div class="orders show-orderdetail no-display" id="metal1{{$key}}">
                          <div class="prod-order-r">                              
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th class="fw-bold"></th>
                                    <th class="fw-bold" >Quantity</th>
                                    <th class="fw-bold text-center" >Cost</th>
                                    <th class="fw-bold text-center">Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php
                                  $subtotal = 0;  
                                  @endphp                                
                                  @foreach($cart->items as $product)
                                  <tr class="bb-in-tb">
                                    <th > {{-- <img src="{{ asset('assets/images/icons/prod.png') }}"> --}} 
                                    
                                      {{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}
                                    </th>
                                    <td>  {{$product['qty']}} </td>
                                    <td class="text-center">{{number_format($product['item']['price'] * $order->currency_value,2)}}</td>
                                    <td class="text-center">{{$order->currency_sign}}{{number_format($product['price'] * $order->currency_value,2)}}</td>
                                  </tr>

                                    @php
                                    $subtotal += number_format($product['price'] * $order->currency_value, 2);
                                    @endphp
                                  @endforeach
                                </tbody>
                              </table>
                          </div>
                          <div class="ttl-summary">
                            <div class="row">
                              <div class="col-7"></div>
                              <div class="col-5">
                               <div class="row">

                                 <div class="col-6"><p class="headt">Item Subtotal </p> </div> 
                                 <div class="col-6"><p>{{$order->currency_sign}}{{ number_format($subtotal, 2) }}</p></div>

                                 <div class="col-6"><p class="headt">Service Charges</p> </div> 
                                 <div class="col-6">
                                    @php
                                    $tax = ($subtotal / 100) * $order->tax;
                                    @endphp
                                   <p>{{$order->currency_sign}} {{ number_format($tax , 2) }}</p>
                                 </div>

                                 {{-- <div class="col-6"><p class="headt">Govt Bag Charges </p> </div> 
                                 <div class="col-6">
                                   <p>{{$order->currency_sign}} {{ number_format($order->gov_bag_charges , 2) }}</p>
                                 </div> --}}
                                 
                                 @if($order->shipping_cost != 0)
                                 <div class="col-6"><p class="headt">Delivery Cost</p> </div> 
                                 <div class="col-6"><p>{{$order->currency_sign}} {{ number_format($order->shipping_cost , 2) }}</p></div>
                                 @endif

                                @if($order->coupon_discount != null)
                                 <div class="col-6"><p class="headt">{{ __('Coupon Discount') }}</p> </div> 
                                 <div class="col-6"><p>{{$order->currency_sign}} {{number_format($order->coupon_discount, 2)}}</p></div>
                                 @endif

                                 <div class="col-6"><p class="headt">Total </p> </div> 
                                 <div class="col-6"><p>{{$order->currency_sign}}{{ number_format($order->pay_amount * $order->currency_value , 2) }}</p></div>
                                 
                               </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach                    
                   </div>


                 </div>
              </div>
           </div>
        </div>  
      </div> 
    </div>   





    <!--Track Modal -->
    <div class="modal fade" id="trackmodal" tabindex="-1" role="dialog" aria-labelledby="trackm" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-size: 18px;padding: 5px;" id="trackm">Track Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 80px; text-align: center;font-size: 25px;font-weight: 600;    text-transform: capitalize;">
           Your order is in delivery mode
          </div>
         
        </div>
      </div>
    </div>

    <!--Message Modal -->
    <div class="modal" id="vendormsgmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="font-size: 18px;padding: 5px;">Send Message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid p-0">
              <div class="row">
                <div class="col-md-12">
                  <div class="cutvndmsg-upr contact-form">
                    <form class="cutvndmsg" method="post" action="{{ route('customer.vendor.contact') }}" id="emailreply1">
                      {{csrf_field()}}
                      <ul>
                        <li>
                          <input  class="form-control cust-ine eml-val ordrn1" id="ordrn1" name="order_no" placeholder=" " value="" readonly="">
                        </li>
                        <li>
                          <input class="form-control cust-ine strnm1"  name="store_name" placeholder=" " value="" readonly="">
                          <input type="hidden" name="strnmid" class="strnmid1">
                        </li>
                        <li>
                          <input  class="form-control cust-ine store_contact" id="" name="" placeholder=" " value="" readonly="">
                        </li>

                        <li>
                          <input type="text" class="form-control cust-ine" name="subject" placeholder="{{ __("Subject") }} *" required="">
                        </li>
                        <li>
                          <textarea class="form-control cust-ine textarea" name="message" id="msg1" placeholder="{{ __("Your Message") }} *" required=""></textarea>
                        </li>
                      </ul>
                      <button class="submit-btn ws-btn ws-btn-lg mybtn1" id="emlsub1" type="submit">
                       <i class="fa fa-refresh fa-spin" style="display: none"></i> {{ __("Send Message") }}</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
         
        </div>
      </div>
    </div>


@endsection
@section('pagelevel_scripts')
<script type="text/javascript">
  $(document).on('click','.track-mod-show',function(event){

      $('#trackmodal').find('.modal-body').html("You Order Status : "+$(this).attr('data-title') );

    });
   
   $(document).on('click','.showorder-detail',function (e) {
    e.preventDefault();
     $(this).find('.fa').toggle();
     var id=$(this).attr('data-id');
     $('#'+id).slideToggle();
   })




$(document).on('click','.vdrmsgbtn',function(){
    
    var id=$(this).attr('data-id');
    var store_name=$(this).attr('data-store');
    var store_contact=$(this).attr('data-phone');
    var order_no=$(this).attr('data-order');


    $('#vendormsgmodal .cutvndmsg .ordrn1').val(order_no);
    $('#vendormsgmodal .cutvndmsg .strnm1').val(store_name);
    $('#vendormsgmodal .cutvndmsg .store_contact').val(store_contact)
    $('#vendormsgmodal .cutvndmsg .strnmid1').val(id);

});



</script>
@endsection