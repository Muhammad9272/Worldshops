@extends('layouts.vendor')
@section('content')
<div class="content-area">
   <div class="mr-breadcrumb">
      <div class="row">
         <div class="col-lg-12">
            <h4 class="heading">{{ $langg->lang586 }} <a class="add-btn" href="{{ route('vendor-order-show',$order->order_number) }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang550 }}</a></h4>
            <ul class="links">
               <li>
                  <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
               </li>
               <li>
                  <a href="javascript:;">{{ $langg->lang443 }}</a>
               </li>
               <li>
                  <a href="javascript:;">{{ $langg->lang586 }}</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <div class="order-table-wrap">
      <div class="invoice-wrap">
         <div class="invoice__title">
            <div class="row">
               <div class="col-sm-6">
                  <div class="invoice__logo text-left">
                     <img src="{{ asset('assets/images/'.$gs->invoice_logo) }}" alt="woo commerce logo">
                  </div>
               </div>
               <div class="col-lg-6 text-right">
                  <a class="btn  add-newProduct-btn print" href="{{route('vendor-order-print',$order->order_number)}}"
                     target="_blank"><i class="fa fa-print"></i> {{ $langg->lang607 }}</a>
               </div>
            </div>
         </div>
         <br>
         <div class="row invoice__metaInfo mb-4">
            <div class="col-lg-6">
               <div class="invoice__orderDetails">
                  <p><strong>{{ $langg->lang601 }} </strong></p>
                  <span><strong>{{ $langg->lang588 }} :</strong> {{ sprintf("%'.08d", $order->id) }}</span><br>
                  <span><strong>{{ $langg->lang589 }} :</strong> {{ date('d-M-Y',strtotime($order->created_at)) }}</span><br>
                  <span><strong>{{  $langg->lang590 }} :</strong> {{ $order->order_number }}</span><br>
                  @if($order->dp == 0)
                  <span> <strong>{{ __('Shipping Method') }} :</strong>
                  @if($order->methodofcollect == 0)
                  {{ __('Pick Up') }}
                  @else
                  {{ __('Ship To Address') }}
                  @endif
                  </span><br>
                  @endif
                  <span> <strong>{{ $langg->lang605 }} :</strong> {{$order->method}}</span>
               </div>
            </div>
         </div>
         <div class="row invoice__metaInfo">

            <div class="col-lg-6">
               <div class="buyer">
                  <p><strong>{{ __('Billing Details') }}</strong></p>
                  <span><strong>{{ __('Customer Name') }}</strong>: {{ $order->customer_name}}</span><br>
                  <span><strong>{{ __('Phone') }}</strong>: {{ $order->customer_phone }}</span><br>
                  <span><strong>{{ __('Email') }}</strong>: {{ $order->customer_email }}</span><br>
                  <span><strong>{{ __('Flat no') }}</strong>: {{ $order->customer_address }}</span><br>
                  <span><strong>{{ __('Street address') }}</strong>: {{ $order->customer_address_1 }}</span>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="invoice_table">
                  <div class="mr-table">
                     <div class="table-responsive">
                        <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                           width="100%" >
                           <thead>
                              <tr>
                                 <th>{{ $langg->lang591 }}</th>
                                 <th>{{ $langg->lang539 }}</th>
                                 <th>{{ $langg->lang600 }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @php
                              $subtotal = 0;
                              $data = 0;
                              $tax = 0;
                              @endphp
                              @foreach($cart->items as $product)
                              @if($product['item']['user_id'] != 0)
                              @if($product['item']['user_id'] == $user->id)
                              <tr>
                                 <td width="50%">
                                    @if($product['item']['user_id'] != 0)
                                    @php
                                    $user = App\Models\User::find($product['item']['user_id']);
                                    @endphp
                                    @if(isset($user))
                                    <a target="_blank"
                                       href="{{ route('front.product', $product['item']['slug']) }}">{{ $product['item']['name']}}</a>
                                    @else
                                    <a href="javascript:;">{{$product['item']['name']}}</a>
                                    @endif
                                    @else
                                    <a href="javascript:;">{{ $product['item']['name']}}</a>
                                    @endif
                                 </td>
                                 <td>
                                    @if($product['size'])
                                    <p>
                                       <strong>{{ $langg->lang312 }} :</strong> {{$product['size']}}
                                    </p>
                                    @endif
                                    @if($product['color'])
                                    <p>
                                       <strong>{{ $langg->lang313 }} :</strong> <span
                                          style="width: 40px; height: 20px; display: block; background: #{{$product['color']}};"></span>
                                    </p>
                                    @endif
                                    <p>
                                       <strong>{{ $langg->lang754 }} :</strong> {{$order->currency_sign}}{{ number_format($product['item']['price'] * $order->currency_value , 2) }}
                                    </p>
                                    <p>
                                       <strong>{{ $langg->lang595 }} :</strong> {{$product['qty']}} {{ $product['item']['measure'] }}
                                    </p>
                                    @if(!empty($product['keys']))
                                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)
                                    <p>
                                       <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} 
                                    </p>
                                    @endforeach
                                    @endif
                                 </td>
                                 <td>{{$order->currency_sign}}{{ number_format($product['price'] * $order->currency_value , 2) }}</td>
                                 @php
                                 $subtotal += number_format($product['price'] * $order->currency_value, 2);
                                 @endphp
                              </tr>
                              @endif
                              @endif
                              @endforeach
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="2">{{ $langg->lang597 }}</td>
                                 <td>{{$order->currency_sign}}{{ number_format($subtotal, 2) }}</td>
                              </tr>
                              {{-- @if(Auth::user()->id == $order->vendor_shipping_id) --}}
                              @if($order->shipping_cost != 0)
                              <tr>
                                 <td colspan="2">Delivery Cost ({{$order->currency_sign}})</td>
                                 <td>{{ number_format($order->shipping_cost , 2) }}</td>
                              </tr>
                              @php 
                              $data +=  number_format($order->shipping_cost , 2);
                              @endphp
                              @endif
                              {{-- @endif --}}
                              @if(Auth::user()->id == $order->vendor_packing_id)
                              @if($order->packing_cost != 0)
                              <tr>
                                 <td colspan="2">{{ $langg->lang596 }}({{$order->currency_sign}})</td>
                                 <td>{{ number_format($order->packing_cost , 2) }}</td>
                              </tr>
                              @php 
                              $data +=  number_format($order->packing_cost , 2);
                              @endphp
                              @endif
                              @endif
                              @if($order->tax != 0)
                              <tr>
                                 <td colspan="2">Service Charges({{$order->currency_sign}})</td>
                                 @php
                                 $tax = ($subtotal / 100) * $order->tax;
                                 $subtotal =  $subtotal + $tax;
                                 @endphp
                                 <td>{{number_format($tax, 2)}}</td>
                              </tr>
                              @endif
                              {{-- <tr>
                                 <td colspan="2">{{ __('Gov bag Charges') }}</td>
                                 <td>{{$order->currency_sign}} {{ number_format($order->gov_bag_charges , 2) }}</td>
                              </tr> --}}
                              @if($order->coupon_discount != null)
                              <tr>
                                 <td colspan="2">{{ __('Coupon Discount') }}({{$order->currency_sign}})</td>
                                 <td>{{number_format($order->coupon_discount, 2)}}</td>
                              </tr>
                              @endif
                              <tr>
                                 <td colspan="1"></td>
                                 <td>{{ $langg->lang600 }}</td>
                                 <td>{{$order->currency_sign}}
                                    {{-- {{ number_format(($subtotal + $data), 2) }} --}}
                                    {{ number_format($order->pay_amount * $order->currency_value , 2) }}
                                 </td>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Main Content Area End -->
</div>
</div>
</div>
@endsection