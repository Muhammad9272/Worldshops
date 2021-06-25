@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')

    <div class="ls-content-bg">
      <div class="section-product" style="min-height: 350px;">
        <div class="container content-margin">
           <div class="row">
            <div class="col-xl-4 col-lg-3 col-md-2"></div>
             <div class="col-xl-4 col-lg-6 col-md-8 ">
              @if(Session::has('cart') )
               @include('includes.front.bucket');
               @else
               <div class="text-center">
                 <h3 class="mt-5 ">Cart</h3>
                 <h4 class="text-center"> Cart is empty</h4>
                 <div class="mt-60">
                   <a href="{{route('front.index')}}" class="ws-btn">Shop Now</a>
                 </div>
               </div>
               @endif
             </div>
             <div class="col-xl-4 col-lg-3 col-md-2"></div>
           </div>
        </div>  
      </div>
    </div>




@endsection
@section('pagelevel_scripts')


<script type="text/javascript">
  
  @if (\Session::has('chkoutmsg'))
       var msg="{!! \Session::get('chkoutmsg') !!}";
       toastr.info(msg); 
  @endif


</script>
  

@endsection
 