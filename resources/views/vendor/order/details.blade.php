@extends('layouts.vendor')
@section('styles')
@endsection
@section('content')
<div class="content-area">
   <div class="mr-breadcrumb">
      <div class="row">
         <div class="col-lg-12">
            <h4 class="heading">{{ $langg->lang549 }} <a class="add-btn" href="{{ route('vendor-order-index') }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang550 }}</a></h4>
            <ul class="links">
               <li>
                  <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
               </li>
               <li>
                  <a href="javascript:;">{{ $langg->lang443 }}</a>
               </li>
               <li>
                  <a href="javascript:;">{{ $langg->lang549 }}</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <div class="order-table-wrap">
      @include('includes.admin.form-both')
      <div class="row">
         <div class="col-md-6">
             <div class="col-lg-12">
               <div class="special-box">
                  <div class="heading-area">
                     <h4 class="title">
                       {{ $langg->lang549 }}
                     </h4>
                  </div>
                  <div class="table-responsive-sm">
                     <table class="table">
                        <tbody>
                           <tr>
                              <th width="45%">{{ $langg->lang551 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->order_number}}</td>
                           </tr>
                           <tr>
                              <th width="45%">{{ $langg->lang552 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->vendororders()->where('user_id','=',$user->id)->sum('qty')}}</td>
                           </tr>
                           <tr>
                              <th width="45%">{{ $langg->lang553 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->currency_sign}}
                                 {{ round($order->pay_amount * $order->currency_value , 2) }}</td>
                           </tr>
                           <tr>
                              <th width="45%">Order Date</th>
                              <th width="10%">:</th>
                              <td width="45%">{{date('d-M-Y H:i:s a',strtotime($order->created_at))}}</td>
                           </tr>
                           <tr>
                              <th width="45%">{{ __('Delivery Schedule') }}</th>
                              <th width="10%">:</th>
                              <td width="45%"> 
                                 @if($order->time_check==0)
                                 Urgent
                                 @else
                                 {{$order->time}} <br> {{date('d-M-Y',strtotime($order->date)) }}
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <th width="45%">{{ __('Shipping Method') }}</th>
                              <th width="10%">:</th>
                              <td width="45%">
                                 @if($order->methodofcollect == 0)
                                 {{ __('Pick Up') }}
                                 @else
                                 {{ __('Ship To Address') }}
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <th width="45%">{{ $langg->lang795 }}</th>
                              <td width="10%">:</td>
                              <td width="45%">{{$order->method}}</td>
                           </tr>
                           @if($order->method != "Cash On Delivery")
                           @if($order->method=="Stripe")
                           <tr>
                              <th width="45%">{{$order->method}} {{ $langg->lang796 }}</th>
                              <td width="10%">:</td>
                              <td width="45%">{{$order->charge_id}}</td>
                           </tr>
                           @endif
                           <tr>
                              <th width="45%">{{$order->method}} {{ $langg->lang797 }}</th>
                              <td width="10%">:</td>
                              <td width="45%">{{$order->txnid}}</td>
                           </tr>
                           @endif

                           <tr>
                              <th width="45%">{{ $langg->lang798 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>". $langg->lang799 ."</span>":"<span class='badge badge-success'>". $langg->lang800 ."</span>" !!}</td>
                           </tr>
                           <tr>
                              @if(!empty($order->order_note))
                              <th width="45%">{{ $langg->lang801 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->order_note}}</td>
                              @endif
                           </tr>
                        </tbody>
                     </table>
                  </div>
                   <div class="footer-area">
                     <a href="{{ route('vendor-order-invoice',$order->order_number) }}" class="mybtn1"><i class="fas fa-eye"></i> {{ $langg->lang555 }}</a>

                     
                     <a class="btn sendEmail mybtn1 send" href="javascript:;" class="send" data-email="{{ $order->customer_email }}" data-toggle="modal" data-target="#vendorform">
                     <i class="fa fa-send"></i> {{ $langg->lang576 }}
                     </a>
              

                  </div>
               </div>
            </div>
           
            <div class="col-lg-12">
               <div class="special-box">
                  <div class="heading-area">
                     <h4 class="title">
                        {{ __('Billing details ') }}
                     </h4>
                  </div>
                  <div class="table-responsive-sm">
                     <table class="table">
                        <tbody>
                           <tr>
                              <th width="45%">{{ $langg->lang557 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->customer_name}}</td>
                           </tr>
                           <tr>
                              <th width="45%">{{ $langg->lang558 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->customer_email}}</td>
                           </tr>
                           <tr>
                              <th width="45%">{{ $langg->lang559 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->customer_phone}}</td>
                           </tr>
                           <tr>
                              <th width="45%">Flat no</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->customer_address}}</td>
                           </tr>
                           <tr>
                              <th width="45%">Street Address</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->customer_address_1}}</td>
                           </tr>

                           <tr>
                              <th width="45%">{{ $langg->lang563 }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->customer_zip}}</td>
                           </tr>
                           <tr>
                              <th width="45%">Instructions for rider</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->instructions}}</td>
                           </tr>

                           @if($order->coupon_code != null)
                           <tr>
                              <th width="45%">{{ __('Coupon Code') }}</th>
                              <th width="10%">:</th>
                              <td width="45%">{{$order->coupon_code}}</td>
                           </tr>
                           @endif
                           @if($order->coupon_discount != null)
                           <tr>
                              <th width="45%">{{ __('Coupon Discount') }}</th>
                              <th width="10%">:</th>
                              @if($gs->currency_format == 0)
                              <td width="45%">{{ $order->currency_sign }}{{ $order->coupon_discount }}</td>
                              @else 
                              <td width="45%">{{ $order->coupon_discount }}{{ $order->currency_sign }}</td>
                              @endif
                           </tr>
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

         </div>
         <div class="col-md-6">
            <div class="row">
               <div class="col-lg-12 order-details-table">
                 
                <div class="vnprod-invoice">
                   <h3>Products Ordered</h3>
                   <br>
                   <h4 class="mb-15">Products</h4>
                   <div class="vproduct-list">
                     @foreach($cart->items as $key => $product)
                        @if($product['item']['user_id'] != 0)
                        @if($product['item']['user_id'] == $user->id)
                        
                           <div class="vproduct-row">
                              <div class="row">
                                 <div class="col-md-9">
                                    <p class="vprod-title">
                                       
                                    @if($product['item']['user_id'] != 0)
                                    @php
                                    $user = App\Models\User::find($product['item']['user_id']);
                                    @endphp
                                    @if(isset($user))
                                    <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}</a>
                                    @else
                                    <a href="javascript:;">{{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}</a>
                                    @endif
                                    @endif


                                    </p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <p class="vprod-price"> {{$order->currency_sign}}{{ round($product['price'] * $order->currency_value , 2) }} </p>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-12 d-inline-flex extras">
                                   <p>
                                       <strong>{{ $langg->lang311 }} :</strong> {{$product['qty']}} {{ $product['item']['measure'] }}
                                    </p>
                                    <p>
                                       <strong>{{ $langg->lang754 }} :</strong> {{$order->currency_sign}}{{ round($product['item']['price'] * $order->currency_value , 2) }}
                                    </p>
                                     @if($product['size'])
                                    <p>
                                       <strong>{{ $langg->lang312 }} :</strong> {{$product['size']}}
                                    </p>
                                    @endif

                                 </div>
                              </div>                      
                           </div>
                        @endif
                        @endif
                     @endforeach


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
{{-- LICENSE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header d-block text-center">
            <h4 class="modal-title d-inline-block">{{ $langg->lang577 }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p class="text-center">{{ $langg->lang578 }} :  <span id="key"></span> <a href="javascript:;" id="license-edit">{{ $langg->lang577 }}</a><a href="javascript:;" id="license-cancel" class="showbox">{{ $langg->lang584 }}</a></p>
            <form method="POST" action="{{route('vendor-order-license',$order->order_number)}}" id="edit-license" style="display: none;">
               {{csrf_field()}}
               <input type="hidden" name="license_key" id="license-key" value="">
               <div class="form-group text-center">
                  <input type="text" name="{{ $langg->lang585 }}" placeholder="{{ $langg->lang579 }}" style="width: 40%; border: none;" required=""><input type="submit" name="submit" value="Save License" class="btn btn-primary" style="border-radius: 0; padding: 2px; margin-bottom: 2px;">
               </div>
            </form>
         </div>
         <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $langg->lang580 }}</button>
         </div>
      </div>
   </div>
</div>
{{-- LICENSE MODAL ENDS --}}
{{-- MESSAGE MODAL --}}
<div class="sub-categori">
   <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="vendorformLabel">{{ $langg->lang576 }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="container-fluid p-0">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="contact-form">
                           <form id="emailreply">
                              {{csrf_field()}}
                              <ul>
                                 <li>
                                    <input type="email" class="input-field eml-val" id="eml" name="to" placeholder="{{ $langg->lang583 }} *" value="" required="">
                                 </li>
                                 <li>
                                    <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ $langg->lang581 }} *" required="">
                                 </li>
                                 <li>
                                    <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ $langg->lang582 }} *" required=""></textarea>
                                 </li>
                              </ul>
                              <button class="submit-btn" id="emlsub" type="submit">{{ $langg->lang576 }}</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- MESSAGE MODAL ENDS --}}
@endsection
@section('scripts')
<script type="text/javascript">
   $('#example2').dataTable( {
     "ordering": false,
         'lengthChange': false,
         'searching'   : false,
         'ordering'    : false,
         'info'        : false,
         'autoWidth'   : false,
         'responsive'  : true
   } );
</script>
<script type="text/javascript">
   $(document).on('click','#license' , function(e){
       var id = $(this).parent().find('input[type=hidden]').val();
       var key = $(this).parent().parent().find('input[type=hidden]').val();
       $('#key').html(id);  
       $('#license-key').val(key);    
   });
   $(document).on('click','#license-edit' , function(e){
       $(this).hide();
       $('#edit-license').show();
       $('#license-cancel').show();
   });
   $(document).on('click','#license-cancel' , function(e){
       $(this).hide();
       $('#edit-license').hide();
       $('#license-edit').show();
   });
   
   $(document).on('submit','#edit-license' , function(e){
       e.preventDefault();
     $('button#license-btn').prop('disabled',true);
         $.ajax({
          method:"POST",
          url:$(this).prop('action'),
          data:new FormData(this),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
             if ((data.errors)) {
               for(var error in data.errors)
               {
                   $.notify('<li>'+ data.errors[error] +'</li>','error');
               }
             }
             else
             {
               $.notify(data,'success');
               $('button#license-btn').prop('disabled',false);
               $('#confirm-delete').modal('toggle');
   
              }
          }
           });
   });
</script>
@endsection