@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
  <div class="ls-content-bg mt-100">    
    <div class="section-product" style="min-height: 350px;">
      <div class="container ls-content-2">
         <h1 class="text-center text-red mb-50">SHOP BY  CATEGORY</h1>
         <div class="row">
          <div class="col-lg-8 ">
            <div class="prod-left-cont">
              <div class="sticky-header">
                 <div class="mb-30">
                    <form>
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
                     <h4>{{$cat->name}}</h4>
                      <a href="{{route('front.vendor',[Request::route('shop_name')])}}" class="back-to d-inline-flex">
                        <span class="arrow text-red"><i class="fa fa-long-arrow-left"></i></span>
                        <h4> Back to Categories</h4>
                      </a>
                   </div>
              </div>
              <div class="row ">
                  @foreach($cat->subs()->orderBy('position', 'ASC')->get() as $data)
                    <a  href="{{route('front.vendor.subcategory', [Request::route('shop_name'),Request::route('category'),$data->slug])}}">
                     <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                       <div class="category-card2 " >
                         <div class="img  width-img" >
                           <img src="{{ $data->photo ? asset('assets/images/categories/'.$data->photo):asset('assets/images/noimage.png') }}">
                         </div>
                         <div class="category-content text-center mt-10" >                        
                           
                               <a class="cat-title" href="{{route('front.vendor.subcategory', [Request::route('shop_name'),Request::route('category'),$data->slug])}}">{{$data->name}} </a>
                            
                         </div>
                       </div>
                     </div>
                   </a>
                  @endforeach

              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 sticky-bucket">
           @include('includes.front.bucket')
          </div>
         </div>
      </div>  
    </div> 
  </div>   
@endsection
@section('pagelevel_scripts')
@endsection

