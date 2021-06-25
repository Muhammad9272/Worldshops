

@extends('front.layouts.app')
@section('pagelevel_css')
<style type="text/css">
  .inner-wrapper-sticky{
    top: -1231px !important;
  }
</style>

@endsection
@section('page_content')

    <div class="ls-content-bg mt-100">    
      <div class="section-product" style="min-height: 350px;">
        <div class="container ls-content-2">
           <h1 class="text-center text-red mb-50">PLACE YOUR ORDER</h1>
           <div class="row">
            <div class="col-lg-8 content">
              <div class="prod-left-cont">
                <div class="sticky-header">
                   <div class="mb-30">
                    <form action="javascript:;">

                       <div class="from-group gnrl-searchbar-parent">
                         <input type="text" class="form-control gnrl-searchbar " type="text" id="prod_name" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="off">
                         <div class="autocomplete">
                            <div id="myInputautocomplete-list" class="autocomplete-items">
                            </div>
                          </div>
                         <button class="gnrl-searchbar-btn catsrc name_srch">Search</button>
                       </div>

                    </form>
                   </div>
                   <div class="midl-cont end-t-end mb-20">
                     <h4>
                      {{ !empty($childcat)?$childcat->name: ( !empty($subcat)?$subcat->name:$cat->name) }}
                    </h4>
                      @if(!empty($childcat))
                      <a href=" {{route('front.vendor.subcategory', [Request::route('shop_name'),$cat->slug,$subcat->slug])}} " class="back-to d-inline-flex">
                        <span class="arrow text-red"><i class="fa fa-long-arrow-left"></i></span>
                        <h4> Back to Categories</h4>
                      </a>
                      @elseif(!empty($subcat))
                       <a href="{{route('front.vendor.category', [Request::route('shop_name'),$cat->slug])}}" class="back-to d-inline-flex">
                        <span class="arrow text-red"><i class="fa fa-long-arrow-left"></i></span>
                        <h4> Back to Categories</h4>
                      </a>
                      @else
                       <a href="{{route('front.vendor',[Request::route('shop_name')])}}" class="back-to d-inline-flex">
                        <span class="arrow text-red"><i class="fa fa-long-arrow-left"></i></span>
                        <h4> Back to Categories</h4>
                      </a>
                      @endif


                   </div>
                </div>
                <div class="row prod_srch">
                  @foreach($prods as $key=>$productt)
                   <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom" id="{{$productt->id}}">
                     <div class="product-card">
                       @if($productt->discount_check==1)
                       <div class="ribbon-corner" data-tor-position="left top">Buy {{$productt->buy_quantity}} for {{$productt->convertPrice($productt->offer_amount)}} </div>
                       @endif


                       <div class="img">
                         <img src="{{ empty($productt->photo) ? asset('assets/images/noimage.png') : 
                         ( filter_var($productt->photo, FILTER_VALIDATE_URL) ?  $productt->photo : 

                      (file_exists(public_path().'/assets/images/products/'.$productt->photo)?asset('assets/images/products/'.$productt->photo) : asset('assets/images/noimage.png') )
                          )}}">
                       </div>
                       <div class="product-content">
                         
                         <p class="prod-desc">
                             <a href="javascript:;" data-name="{{$productt->name}}" class="product-modal-show" data-href="{{route('front.product.load',$productt->slug)}}" data-toggle="modal" data-target="#product_modal">{{$productt->showName()}} </a>
                          </p>
                          <p class="text-red price-on-prodpg"> {{$productt->showPrice()}} </p>
                        <div class="qty mt-5 prod-qty-3">
                           @if($productt->emptyStock())
                           <span><strong>{{ $langg->lang78 }}</strong></span>
                           @elseif(!empty($productt->size))

                           <a  href="javascript:;" data-name="{{$productt->name}}" class="product-modal-show" data-href="{{route('front.product.load',$productt->slug)}}" data-toggle="modal" data-target="#product_modal"> 
                              <span class="minus spn " data-class="minus1">-</span>
                                
                                  <input type="number"  class="count inp qttotal qty"  min="0" name="qty" value="0">     
                              
                              <span class="plus spn">+</span>
                           </a>
                           




                           @else
                            <span class="minus spn reducing" data-class="minus1">-</span>
                                @php $ck=0; @endphp
                                @if(Session::has('cart'))
                                   @foreach(Session::get('cart')->items as $prodttt)
                                     @if($prodttt['item']['id']==$productt->id)
                                       <input type="number"  class="count inp qttotal qty{{$productt->id}}"  min="0" name="qty" value="{{$prodttt['qty']}}"> 
                                        @php $ck=$ck+1; @endphp
                                        @break  
                                     @endif
                                   @endforeach
                                @endif
                                @if($ck==0)
                                <input type="number"  class="count inp qttotal qty{{$productt->id}}"  min="0" name="qty" value="0">    
                                @endif  
                            
                            <span class="plus spn  adding">+</span>
                            @endif
                        </div>

                        <input type="hidden" class="prodid" value="{{$productt->id}}">
                        <input type="hidden" class="itemid" value="{{$productt->id}}">
                        <input type="hidden" class="size_qty" value="">
                        <input type="hidden" class="size_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                          @php
                          $stck = (string)$productt->stock;
                          @endphp
                          @if($stck != null)
                          <input type="hidden" class="stock{{$productt->id}}" value="{{ $stck }}">
                          @elseif($productt->type != 'Physical')
                          <input type="hidden" class="stock{{$productt->id}}" value="1">
                          @else
                          <input type="hidden" class="stock{{$productt->id}}" value="">
                          @endif

                         {{--  <input type="hidden" class="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                          <input type="hidden" class="product_id" value="{{ $productt->id }}">
                          <input type="hidden" class="curr_pos" value="{{ $gs->currency_format }}">
                          <input type="hidden" class="curr_sign" value="{{ $curr->sign }}"> --}}


                       </div>
                     </div>
                   </div>


                 

                   @endforeach

                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-8 sticky-bucket" id="sidebar">
               @include('includes.front.bucket')
            </div>
           </div>
        </div>  
      </div> 
    </div>   



<!-- Modal -->
<div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="product_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="product_modalLabel">Product Detail</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="product-detail-modal" style="padding: 20px">
       
      </div>
     
    </div>
  </div>
</div>


@endsection
@section('pagelevel_scripts')

<script type="text/javascript">
  $(document).ready(function () {
    // var sprod_id=$.session.get("sprod_id");
    // if(sprod_id!=null){

    // }
    function GetUrlParameter(sParam)

    {
        var sPageURL = window.location.search.substring(1);

        var sURLVariables = sPageURL.split('&');

        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] == sParam)

            {
                return sParameterName[1];
            }
        }
    }

   var tech = GetUrlParameter('sprod_id');

        if(tech){
          $('html,body').animate({
          scrollTop: $('.prod_srch').find("#"+tech).offset().top-270},
          'slow');

          $('.prod_srch').find("#"+tech).find('.product-card').css('border','1px solid #c1c1bb');


        }
        

     
  });   
    

</script>

{{--   <script type="text/javascript" src="{{asset('assets/front/js/scroll.js')}}"></script>
  <script type="text/javascript">

    var stickySidebar = new StickySidebar('#sidebar', {
      topSpacing: 20,
      bottomSpacing: 20,
      containerSelector: '.container',
      innerWrapperSelector: '.sidebar__inner'
    });
  </script> --}}
  <script src="https://leafo.net/sticky-kit/src/jquery.sticky-kit.js"></script>
  <script type="text/javascript">
  $(function() {
    $(".sidebar").stick_in_parent({
      offset_top: 10
    });
    });
</script>
@endsection


