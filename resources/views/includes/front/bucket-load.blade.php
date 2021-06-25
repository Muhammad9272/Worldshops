    
@if(isset($chkoutpg))
  <div class="bucket2">
    @if(Session::has('cart'))   
      {{-- <h3 class="mt-20 text-red">Cart</h3>  --}}
      <h4 class="mt-10">Products</h4>
      <div class="products-in-buck-side" >

          @foreach(Session::get('cart')->items as $product)
          <div class="buck1">
            <div class="end-t-end">

                <input type="hidden" class="prodid" value="{{$product['item']['id']}}">
                <input type="hidden" class="itemid" value="{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                <input type="hidden" class="size_qty" value="{{$product['size_qty']}}">
                <input type="hidden" class="size_price" value="{{$product['item']['price']}}">
              

               @if($product['size_qty'])
                <input type="hidden" class="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['size_qty']}}">
                @elseif($product['item']['type'] != 'Physical')
                <input type="hidden" class="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="1">
                @else
                <input type="hidden" class="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['stock']}}">
                @endif

              
                <div class="lsm-prod-tittle" >
                  <p class="fw-bold text-dark" > {{$product['item']['name']}}
                    {{-- {{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}} --}}</p>

                  @if(!empty($product['size']))
                  <b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{$product['size']}} <br>
                  @endif
                </div>

                <div class="lsm-prod-quantitt" >
                   <p class="text-red price-on-prodpg-buk ">{{ App\Models\Product::convertPrice($product['price']) }}</p>
                   
                    {{-- @if($product['item']['discount_check']==1 && $product['qty']>=$product['item']['buy_quantity'])
                     @php 
                     $free_quant=(int)($product['qty']/$product['item']['buy_quantity']);
                     $free_quant=$free_quant*$product['item']['get_quantity'];
                     @endphp
                     <p class="free-product"><i class="fa fa-gift"></i> + {{$free_quant}} Free Item</p>
                     <input type="hidden" name="free_products" value="{{$free_quant}}">
                   @endif --}}

                </div>

                


            </div>
          </div>
         {{--  <hr> --}}
          @endforeach
        
      </div>
      <br>
      @if(Session::has('coupon'))
        <h4 class="mt-20">{{ $langg->lang129 }}</h4>
        <div class="end-t-end">
          <p class="fw-bold text-black"> {{ $langg->lang129 }} </p>
            @if(Session::has('coupon'))
              @if(Session::get('coupon_type')==0)
                <p class="discount fw-bold text-black">{{ Session::get('coupon_percentage') }}</p>
                <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(Session::get('coupon') )}}">
              @elseif(Session::get('coupon_type')==1)
                   <p class="discount fw-bold text-black">
                   {{ App\Models\Product::convertPrice( Session::get('coupon') )}}</p>
                  <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice( Session::get('coupon') )}}">
              @else
                   <b class="discount ">Free Delivery</b>
                   <input type="hidden" id="d-val" value="Free Delivery">
              @endif
            @else
             <b class="discount fw-bold text-black">{{ App\Models\Product::convertPrice(0)}}</b>
             <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}">
            @endif
        </div>        
      @endif


      {{-- <h4 class="mt-20">Charges</h4> --}}
      
      <div class="end-t-end">
        <p class="fw-bold text-black">Service Charges</p>
         <p class="fw-bold text-black">{{ Session::has('cart') ? App\Models\Product::convertPrice(  App\Models\Product::servicecharges()  ) : '0.00' }}</p>
      </div>
      {{-- <hr> --}}
     
      {{-- <div class="end-t-end">
        <p class="fw-bold">Gov bag Charges</p>
         <p class="text-red price-on-prodpg">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->gov_bag_charges) : '0.00' }}</p>
      </div>
      <hr> --}}
      @if(Session::get('cart')->methodofcollect==1)
        <div class="end-t-end">
          <p class="fw-bold text-black">Delivery Charges</p>
           @if(Session::has('coupon') && Session::get('coupon_type')==2)

                <p class="fw-bold text-black">{{ App\Models\Product::convertPrice(0) }}</p>
           @else
               <p class="fw-bold text-black">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->sshipping_cost) : '0.00' }}</p>
           @endif

          
        </div>
      @endif
      <hr>
      <div class="end-t-end">
        <h4 class="mt-5 text-red">Total</h4>
         <p class="text-red price-on-prodpg main-total">
          {{ Session::has('cart') ? App\Models\Product::convertPrice(
            Session::get('cart')->totalPrice + App\Models\Product::servicecharges() ) : '0.00' }}
        </p>
      </div>
      <hr>
    @else
      <h3 class="mt-20 text-red">Cart</h3> 
      <p class="mt-1 pl-3 ">{{ $langg->lang8 }}</p>    
    @endif 
  </div>
@else

  
  @if(Session::has('cart'))
    <div class="bucket2">
      {{-- <h3 class="mt-20 text-red">Cart</h3>  --}}
      <h4 class="mt-10">Products</h4>
      <div class="products-in-buck-side" >
          @foreach(Session::get('cart')->items as $product)
          <div class="buck1">
            <div class="d-inline-flex">

                <div class="qty mt-5 prod-qty-4" style="width: 35%" >
                    <span class="minus spn reducing">-</span>
                    <input type="number" disabled="true" class="count inp qttotal qty{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}"  min="0"name="qty" value="{{$product['qty']}}" >
                  
                    <span class="plus spn adding">+</span>
                </div>


                <input type="hidden" class="prodid" value="{{$product['item']['id']}}">
                <input type="hidden" class="itemid" value="{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                <input type="hidden" class="size_qty" value="{{$product['size_qty']}}">
                <input type="hidden" class="size_price" value="{{$product['item']['price']}}">
              

               @if($product['size_qty'])
                <input type="hidden" class="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['size_qty']}}">
                @elseif($product['item']['type'] != 'Physical')
                <input type="hidden" class="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="1">
                @else
                <input type="hidden" class="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['stock']}}">
                @endif

              
                <div class="lsm-prod-tittle" style="width: 40%">
                  <p class="fw-bold text-dark mb-0" >{{$product['item']['name']}}
                    {{-- {{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}} --}}</p>
                  @if(!empty($product['size']))
                  <div class="mb-10">
                    <b class="">{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{$product['size']}}
                  </div>
                  
                  @endif

                </div>

                <div class="lsm-prod-quantitt" style="width: 20%">
                   <p class="text-red price-on-prodpg-buk ">{{-- {{$product['qty']}} x --}} {{ App\Models\Product::convertPrice($product['price']) }}</p>
                   

                </div>

                <div class="lsm-prod-quantitt-del" style="width: 5%">
                  <a href="#" data-id="qty{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" data-class="cremove{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" 
                     data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product" class="cart-remove delete-prod-buck trash-font">
                    <i class="fa fa-trash-o"></i>
                  </a>
                </div>



            </div>
          </div>
         {{--  <hr> --}}
          @endforeach
        
      </div>
      
      <br>
      @if(Session::has('coupon'))
        <h4 class="mt-20">{{ $langg->lang129 }}</h4>
        <div class="end-t-end">
          <p class="fw-bold text-black"> {{ $langg->lang129 }} </p>
            @if(Session::has('coupon'))
              @if(Session::get('coupon_type')==0)
                <p class="discount fw-bold text-black">{{ Session::get('coupon_percentage') }}</p>
                <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(Session::get('coupon') )}}">
              @elseif(Session::get('coupon_type')==1)
                   <p class="discount fw-bold text-black">
                   {{ App\Models\Product::convertPrice( Session::get('coupon') )}}</p>
                  <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice( Session::get('coupon') )}}">
              @else
                   <b class="discount ">Free Delivery</b>
                   <input type="hidden" id="d-val" value="Free Delivery">
              @endif
            @else
             <p class="discount text-red price-on-prodpg">{{ App\Models\Product::convertPrice(0)}}</p>
             <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}">
            @endif
        </div>
        
      @endif
    
     {{--  <h4 class="mt-20">Charges</h4> --}}

      <div class="end-t-end">
        <p class="fw-bold text-black">Service Charges</p>
         <p class="fw-bold text-black">{{ Session::has('cart') ? App\Models\Product::convertPrice(  App\Models\Product::servicecharges()  ) : '0.00' }}</p>
      </div>
      {{-- <hr>

      <div class="end-t-end">
        <p class="fw-bold">Gov bag Charges</p>
         <p class="text-red price-on-prodpg">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->gov_bag_charges) : '0.00' }}</p>
      </div>
      <hr> --}}
      @if(Session::get('cart')->methodofcollect==1)
        <div class="end-t-end">
          <p class="fw-bold text-black">Delivery Charges</p>
           @if(Session::has('coupon') && Session::get('coupon_type')==2)

                <p class="fw-bold text-black">{{ App\Models\Product::convertPrice(0) }}</p>
           @else
               <p class="fw-bold text-black">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->sshipping_cost) : '0.00' }}</p>
           @endif

          
        </div>
      @endif

      <hr>
      <div class="end-t-end">
        <h4 class="mt-5 text-red">Total</h4>
         <p class="text-red price-on-prodpg main-total">
          {{ Session::has('cart') ? App\Models\Product::convertPrice(
            Session::get('cart')->totalPrice + App\Models\Product::servicecharges() ) : '0.00' }}
        </p>
      </div>
    </div>



    <div class="display-on-other bucket3">
      <h4 class="mt-20">Apply Coupon Code</h4>                  
      <div class="coupon-on-prod-pg form-group">
        <form id="coupon-form" class="coupon gnrl-searchbar-parent">
           <input  class="form-control prod-coupon-inp gnrl-searchbar" type="text" placeholder="{{ $langg->lang133 }}" id="code" required="" autocomplete="off">
           <input type="hidden" class="coupon-total" id="grandtotal" value="{{ Session::has('cart') ? App\Models\Product::convertPrice(0) : '0.00' }}">


           <button class="coupn-prod gnrl-searchbar-btn"> Apply</button>
        </form>
      </div>
      <h4>Leave a note for the store</h4> 
      <div>
        <form action="{{route('front.checkoutnote')}}" id="" method="post">
          {{csrf_field()}}
          <div class="form-group">
             <textarea class="form-control text-ar-note" name="checkout_note" placeholder="Enter your note here..."></textarea>
           </div>
           <div class="form-group">
             <button class="ws-btn ws-btn-lg">Checkout</button>
           </div>
        </form>                   
      </div>
    </div> 
  @else
  <div class="bucket2">
    <h3 class="mt-20 text-red">Cart</h3> 
    <p class="mt-1 pl-3">{{ $langg->lang8 }}</p>
  </div>    
  @endif

@endif