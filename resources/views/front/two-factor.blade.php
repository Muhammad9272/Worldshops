@extends('front.layouts.app')
@section('pagelevel_css')
@endsection

@section('page_content')
    <div class="ls-content-bg">
      <div class="section-product mt-70" style="min-height: 350px;">
        <div class="container ls-content-2">
           @if($checkverify==1)
           <div class="row vf-email">
             <div class="col-md-6 col-12">
               <div class="contint">
                 <h1 class="fm-cir">2 Factor Authentication</h1>
                 <p class="text-dark pd-lr">We have send 5 digit code to <strong>{{$userdata->email}}</strong>. Please enter that code to verify your email address</p>
                 <div class="vf-content mt-50">
                  @include('includes.admin.form-login')
                   <form method="post" id="verify_account" action="{{route('authentication-code-submit')}}">
                    {{ csrf_field() }}
                     <div class="form-group">
                       <label><strong>Authentication Code</strong> </label>
                       <input type="text" name="token_code" class="form-control input-radius" placeholder="Authentication code">
                     </div>
                     <input type="hidden" name="email" value="{{$userdata->email}}">
                     <div class="form-group vf-btn-margin">
                       <button type="submit" class="ws-btn ws-btn-lg submit-btn">Verify</button>
                     </div>
                     <input class="authdata" type="hidden" value="{{ $langg->lang188 }}">
                    </form>
                     <div class="snd-again end-t-end">
                       <p> <a href="{{route('resend-authentication-code',$userdata->email)}}" ><strong>Resend Code </strong></a>  </p><p id="verfication-timer" class=" text-dark"></p>
                     </div>
                   
                   <div class="verify-info mt-10">
                     <p class="text-dark">Not received your code? Make sure you check your junk or spam folders{{--  <a href="https://accounts.google.com/login" class="primary-link">Inbox</a> --}} </p>
                    
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-md-6 col-12">
                <div class="text-center mt-10">
                  <img src="{{asset('assets/front/img/vf-email.png')}}">
                </div>
             </div>

           </div>
           @else
           <div class="text-center">
             <h3>Sorry, Your Verification Link Expired  </h3>
             <span><a href="{{route('resend-authentication-code',$userdata->email)}}" ><strong>Resend Code </strong></a></span>

           </div>
           @endif
        </div>  
      </div>
    </div>    

@endsection
@section('pagelevel_scripts')

@if($checkverify==1)
<script>
// Set the date we're counting down to
  var countDownDate = new Date('{{$userdata->authentication_expire}}').getTime();

 // Update the count down every 1 second
 var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
  
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
  console.log(distance);
  // Time calculations for days, hours, minutes and seconds
  // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("verfication-timer").innerHTML =minutes + ": " + seconds + " sec" ;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    location.reload();
  }
}, 1000);
</script>
@endif

@endsection