            <div class="buck-right-cont sidebar">
              <div class="bucket1">
                {{-- <h3 class="text-red">Your Order </h3> --}}
                <h4 class="mt-20">Store :</h4>
                <div class="end-t-end">
                  @php
                  $seller_store=App\Models\User::where('shop_name',Session::get('shop_name') )->where('ban','!=',1)->first();
                  @endphp
                  <p class="fw-bold mt-5">{{Session::get('shop_name')}} ({{$seller_store->IsStoreOpen()?"Open":"Closed"}})</p>
                  @if(Session::has('location'))
                      <a href="{{route('front.stores',Session::get('location') )}}" class="ws-btn cstch">Change</a>
                  @endif
                </div>
                @if(!isset($chkoutpg))
                    <div class="mb-10">
                      @if($seller_store->delivery_method==1 || $seller_store->delivery_method==2)
                      <div class="form-check  form-check-inline">
                        <input class="form-check-input methodofcollect" data-href="{{route('product.shipchange',1)}}" type="radio" name="methodofcollect" id="deliverychk" {{ ( Session::has('cart')?  ( Session::get('cart')->methodofcollect==1?'checked' :'' ) :'checked' )}}    value="1">
                        <label class="form-check-label text-dark fm-cir ml-10 fw-bold" for="deliverychk">Delivery</label>
                      </div>
                      @endif
                      @if($seller_store->delivery_method==0 || $seller_store->delivery_method==2)
                      <div class="form-check ml-30 form-check-inline">
                        <input class="form-check-input methodofcollect" data-href="{{route('product.shipchange',0)}}" type="radio" name="methodofcollect" id="collectionchk" {{Session::has('cart')? (Session::get('cart')->methodofcollect==0?'checked':'') :($seller_store->delivery_method==0?'checked':'')}}    value="0">
                        <label class="form-check-label text-dark fm-cir ml-10 fw-bold" for="collectionchk">Collection</label>
                      </div>
                      @endif
                    </div>
                @endif
              </div>
                <div  id="bucket-load">
                   @include('includes.front.bucket-load')
                </div>                  
            </div>