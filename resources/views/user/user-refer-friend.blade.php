@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-user-dashboard" style="min-height: 350px;">
        <div class="container ls-content-2">
           <div class="row user-orders-pg user-refer-friend-pg">
              <div class="col-xl-4 col-lg-4 col-md-6 pdc-40">
                 @include('includes.front.user-dashboard-sidebar')
              </div>
              <div class="col-xl-8 col-lg-8 col-md-12">
                 <div class="mt-10">
                   <h4>Refer a Friend</h4>
                   <p class="text-dark">Refer & Earn</p>

                   
                   <div class="ws-rfr-frnd ws-card-white mt-30">

                     <div class="row mt-20">
                       <div class="col-xl-4 col-lg-6 col-md-6 pd-bottom">
                          <div class=""> 
                            <img class="box-shadow" src="{{asset('assets/front/img/refer.png')}}">
                          </div>                   
                       </div>
                       <div class="col-xl-8">
                         <div>
                          <h4 >20% off for you, 20% off for your friends</h4>
                          <p>Treat your friends we will treat you! Any of your friends or family
                          who shop using your unique link will recieve 20% off their first order and then to say thank you, we will give 20% off too.</p>    
                         </div>
                       </div>                       
                     </div>
                     <div class="row">
                       <div class="col-12 text-center mt-20">
                         <h3>Total Signups <span class="text-red">0</span></h3>
                         <h4>Share link with your friends</h4>
                       </div>
                       <div class="col-12 mt-30">

                              <div class="form-group gnrl-searchbar-parent">
                                 <input class="form-control gnrl-searchbar" type="text" id="referlink" placeholder="Copy Link" value="https://worldshops.co.uk?ref=567433"  required="">
                                 <button class="gnrl-searchbar-btn" onclick="copyreferlink()" > <i class="fa fa-copy"></i> Copy</button>
                              </div>

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
<script type="text/javascript">
  
  function copyreferlink() {
  /* Get the text field */
  var copyText = document.getElementById("referlink");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

}
</script>

@endsection

 