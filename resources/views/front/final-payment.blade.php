@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-product" style="min-height: 350px;">
        <div class="container ls-content-2">
          <div class="row">
            <div class="col-lg-8 payment-left-cont">
                <h4 class="mt-20 mb-20">Do You have a Discount Code ?</h4>
                <form action="#">
                  <div class="payment-coupon-from ml-20">
                      <div class="row ">
                        <div class="col-md-8">
                         <div class="from-group st-search pmt-grp-1 d-inline-flex">
                           <input type="text" class="form-control bg-cl-in" name="coupon" value=>
                           <button href="" class="hm-btn-st-search">Apply</button>
                         </div>
                        </div>
                      </div>
                  </div>
                </form>
                <h4 class="mt-30 mb-20">Secure Card Payment</h4>
                <form action="{{route('front.payment.failed')}}" method="get">
                  <div class="payment-final-from ml-20">

                      <div class="row ">
                        <div class="col-md-12 mb-20 crdt-card-devi">
                          <i class="fa fa-credit-card"></i>
                          <label class="bold-label">Credit Card</label>
                           <input type="text" class="form-control final-pm-in" placeholder="Card Number" name="" value="" >                        
                        </div>
                        <div class="col-md-12 mb-20">
                          <label class="bold-label">Name on Card</label>
                           <input type="text"  class="form-control final-pm-in" name="" placeholder="Enter" value="" >                          
                        </div>
                        <div class="col-md-12 end-t-end mt-30 ">
                          <p><span>Total Payable : </span> <span class="text-dark bold-label"> $100.3 </span> </p>
                          <button type="submit" class="ls-md-btn">Pay Now</button>
                        </div>


                      </div>
                  </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-6 sticky-bucket">
                @include('includes.front.bucket')
            </div>
          </div>
        </div>  
      </div> 
    </div>   
@endsection
@section('pagelevel_scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $(".crdt-card-devi .final-pm-in").focus(function() {
        $(".crdt-card-devi .fa-credit-card").css("color", "black");
    }).blur(function() {
        $(".crdt-card-devi .fa-credit-card").css("color", "grey");
    });
});
</script>
<script type="text/javascript">
  $(function(){
   $('.display-on-other').hide();
  });
</script>
@endsection      





