@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')

    <div class="ls-content-bg mt-100">
      <div class="section-product" style="min-height: 350px;">
        <div class="container ls-content-2">
           <div class="row mb-50">
             <div class="col-12">
                <div class="text-center">
                  {{-- @if(!empty($tempcart)) --}}
                  <img class="mb-30" src="{{asset('assets/front/img/payment-success.png')}}">
                  

                  <h4>Order Placed Successfully</h4>
                  <p>Order Number : {{$order->order_number}}</p>
                  <p>Date : {{date('d-M-Y',strtotime($order->created_at))}}</p>
                  <div class="d-inline-flex mt-20">


                    <img class="ls-img-width" src="{{asset('assets/images/vendor/'.$vend_dat->shop_image)}}">

                    <p class="text-dark mt-10">{{$vend_dat->shop_name}} ({{$vend_dat->IsStoreOpen()?'Open':'Closed'}})</p>
                  </div>
                  <div class="mt-40">
                    <a href="{{route('front.index')}}" class="ws-btn">Continue</a>
                  </div>
                  {{-- @endif --}}

                </div>
             </div>
           </div>
        </div>  
      </div> 
    </div>   
@endsection
@section('pagelevel_scripts')
@endsection


      