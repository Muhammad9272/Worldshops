
@extends('front.layouts.app')
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/dist/slimselect.min.css')}}" rel="stylesheet" />
@section('pagelevel_css')

@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-product" style="min-height: 350px;">
        <div class="ls-content-2">
           <div class="row">
             <div class="col-12">
               
               <div class="store-list">
                <div class="ls-hm-head wsp-head">
                  <div class="container mt-20">
                    {{-- <h4>
                      @if(!empty($location))
                         Search Store In {{$location}}
                      @else
                       Search Stores
                      @endif
                    </h4> --}}
                    <form action="javascript:;" id="search-store-pg" method="get">
                      <div class="row"> 
                        <div class="col-md-4">                      
                           <div class="from-group gnrl-searchbar-parent">
                             <input type="text" class="form-control gnrl-searchbar" placeholder="Search stores near you" name="store_name" value="{{$store_name}}">
                             <button class="gnrl-searchbar-btn name_srch">Search</button>
                           </div>
                        </div>
                        {{-- <div class="col-md-1"></div> --}}

                        <div class="col-md-4 mbl-top-margin">
                          <div class="from-group">                         
                            <select id="select2" name="category" class="store_cat "  >
                              <option selected="" value="" > Select Store Category</option>
                              @foreach($store_cats as $store_cat)
                              <option value="{{$store_cat->id}}" {{$store_cat->id==$category?'selected':''}} >{{$store_cat->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="from-group d-inline-flex str-methodofcllect">
                            
                              {{-- <div class="form-check" >
                                <input class="form-check-input str_methodofcollect "  type="radio" name="str_methodofcollect" id="deliverychk" value="1" {{ $methodofcollect!=null?($methodofcollect==1?"checked":''):''}} checked="">
                                <label class="form-check-label" for="deliverychk">
                                  Delivery 
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input str_methodofcollect" type="radio" name="str_methodofcollect" id="collectionchk" {{$methodofcollect!=null?($methodofcollect==5?"checked":''):''}} value="5">
                                <label class="form-check-label" for="collectionchk">
                                  Collection
                                </label>
                              </div> --}}
                            <div class="form-check  form-check-inline">
                              <label class="container-radio">Delivery
                                 <input class="str_methodofcollect "  type="radio" name="str_methodofcollect" id="deliverychk" value="1" {{ $methodofcollect!=null?($methodofcollect==1?"checked":''):''}} checked="">
                                <span class="checkmark"></span>
                              </label>
                            </div>
                            <div class="form-check ml-30 form-check-inline">
                              <label class="container-radio">Collection
                                <input class="str_methodofcollect" type="radio" name="str_methodofcollect" id="collectionchk" {{$methodofcollect!=null?($methodofcollect==5?"checked":''):''}} value="5">
                                <span class="checkmark"></span>
                              </label>
                            </div>


                          </div>
                        </div>
                        <div class="col-md-3 ls-op-st mt-10">
                          <div class="form-group d-inline-flex ">
                             <input class="ls-shop-sw-in opened" name="opened" {{$opened==1?'checked':''}} value="1" type="checkbox" id="switch" /><label for="switch" class="ls-shop-switch"></label>
                             <p class="ls-shop-sw-text">Show only open</p>
                          </div>
                        </div>                                         
                      </div>
                    </form>
                  </div>
                </div>

                <div class="ls-hm-content container">
                  <h4 class="text-center text-red">
                    @if(!empty($location))
                    Stores available near {{$location}}
                    @else
                    {{$gs->title}} Stores
                    @endif
                  </h4>
                  <div class="ls-hm-list">
                    <div class="row">
                      @foreach($stores as $key=>$data)
                      <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                        <div class="ls-store-card">
                            <div class="st-card-img">
                               <img style="" src="{{asset('assets/images/vendor/'.$data->shop_image)}}" >
                            </div>
                          <div class="upper-c-area">
                            
                            <div class="align-self-center ">
                              <ul class="ls-st-ul">
                                <li><strong>Store:</strong> {{$data->shop_name}} ({{$data->IsStoreOpen()?'Open':'Closed'}})</li>
                                <li><strong>Distance:</strong> {{round($data->distance,2)}} miles </li>
                                
                                @if(!$data->delivery_method==0)
                                   @if($data->earliest_delivery)
                                   <li><strong>Earliest Delivery:</strong>{{$data->earliest_delivery}} </li>
                                   @endif
                                <li><strong>Delivery Cost:</strong> {{$data->setCurrency()}}</li>
                                @endif
                                @if($data->delivery_method==2)
                                <li>Pickup Service also Available</li>
                                @endif
                                @if($key<3)
                                <li><p class="text-green nr-t-u"><i class="icon-map-marker"></i> <span>Closest to you</span> </p></li>
                                @endif
                              </ul>
                            </div>
                          </div>
                          <div class="abslt-btn">
                              <a href="{{route('front.vendor',str_replace(' ', '-', $data->shop_name))}}" class="ws-btn">Enter shop</a>
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
      </div>    
    </div>
@endsection
@section('pagelevel_scripts')
    <script>
      setTimeout(function() {
        new SlimSelect({
          select: '#select2',
          selectByGroup: true,
          placeholder: 'Select Store Category'
        })
      }, 300)
    </script>
    <script src="{{asset('assets/admin/dist/slimselect.min.js')}}"></script>

      <script type="text/javascript">
              $(document).on('click','.name_srch,.opened',function(e){
                e.preventDefault();
                var url="{{route('front.stores', [Request::route('location')])}}";
                $("#search-store-pg").attr('action',url);
                $("#search-store-pg").submit();
              });

              $(document).on('change','.store_cat',function(e){
                e.preventDefault();
                var url="{{route('front.stores', [Request::route('location')])}}";
                $("#search-store-pg").attr('action',url);
                $("#search-store-pg").submit();
              });

              $(document).on('change','.str_methodofcollect',function(e){
                e.preventDefault();
                var url="{{route('front.stores', [Request::route('location')])}}";
                $("#search-store-pg").attr('action',url);
                $("#search-store-pg").submit();
              });

      </script>

@endsection