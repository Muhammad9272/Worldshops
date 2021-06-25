<!DOCTYPE html>
<html lang="en">
<head>
  <title>Coming Soon 2</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="{{asset('assets/front/coming_soon/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/front/coming_soon/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/front/coming_soon/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/front/coming_soon/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/front/coming_soon/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/front/coming_soon/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/front/coming_soon/css/main.css')}}">

<!--===============================================================================================-->

<style type="text/css">
  .ps-list--social{
    display: inline-flex;
    margin: 20px;
  }
  .ps-list--social li{

    padding: 10px;
    border: 1px solid white;
    border-radius: 40px;
    margin: 10px;
    width: 45px;
    text-align: center;
  }
  .ps-list--social li i{
    font-size: 20px;
  }
</style>

</head>
<body>
  
  <!--  -->
  <div class="simpleslide100">
    <div class="simpleslide100-item bg-img1" style="background-image: url({{asset('assets/front/coming_soon/images/bg01.jpg')}});"></div>
{{--     <div class="simpleslide100-item bg-img1" style="background-image: url('images/bg02.jpg');"></div>
    <div class="simpleslide100-item bg-img1" style="background-image: url('images/bg03.jpg');"></div> --}}
  </div>

  <div class="size1 overlay1">
    <!--  -->
    <div class="ps-logo" style="padding: 20px;"><a href="{{route('front.index')}}"> <img style="width: 250px;" src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a></div>
    <div class="size1 flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-50">
      <h3 class="l1-txt1 txt-center p-b-25">
        Coming Soon
      </h3>

      <p class="m2-txt1 txt-center p-b-48">
        Our website is under construction, follow us for update now!
      </p>

      <div class="flex-w flex-c-m cd100 p-b-33">
        <div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
          <span class="l2-txt1 p-b-9 days">35</span>
          <span class="s2-txt1">Days</span>
        </div>

        <div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
          <span class="l2-txt1 p-b-9 hours">17</span>
          <span class="s2-txt1">Hours</span>
        </div>

        <div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
          <span class="l2-txt1 p-b-9 minutes">50</span>
          <span class="s2-txt1">Minutes</span>
        </div>

        <div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
          <span class="l2-txt1 p-b-9 seconds">39</span>
          <span class="s2-txt1">Seconds</span>
        </div>
      </div>

{{--       <form class="w-full flex-w flex-c-m validate-form">

        <div class="wrap-input100 validate-input where1" data-validate = "Valid email is required: ex@abc.xyz">
          <input class="input100 placeholder0 s2-txt2" type="text" name="email" placeholder="Enter Email Address">
          <span class="focus-input100"></span>
        </div>
        
        
        <button class="flex-c-m size3 s2-txt3 how-btn1 trans-04 where1">
          Subscribe
        </button>             
      </form> --}}              <h4 class="text-center text-light">Follow us</h4>
                                <ul class="ps-list--social">
                                    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                            <i class="fa fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="instagram" target="_blank">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                                            <i class="fa fa-dribbble"></i>
                                        </a>
                                      </li>
                                      @endif
                            </ul>

        <a href="{{route('front.index')}}" class="flex-c-m size3 s2-txt3 how-btn1 trans-04 where1">
          Back
        </a>

    </div>
  </div>



  

<!--===============================================================================================-->  
  <script src="{{asset('assets/front/coming_soon/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/front/coming_soon/vendor/bootstrap/js/popper.js')}}"></script>
  <script src="{{asset('assets/front/coming_soon/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/front/coming_soon/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/front/coming_soon/vendor/countdowntime/moment.min.js')}}"></script>
  <script src="{{asset('assets/front/coming_soon/vendor/countdowntime/moment-timezone.min.js')}}"></script>
  <script src="{{asset('assets/front/coming_soon/vendor/countdowntime/moment-timezone-with-data.min.js')}}"></script>
  <script src="{{asset('assets/front/coming_soon/vendor/countdowntime/countdowntime.js')}}"></script>
  <script>
    $('.cd100').countdown100({
      /*Set Endtime here*/
      /*Endtime must be > current time*/
      endtimeYear: 2021,
      endtimeMonth: 6,
      endtimeDate: 28,
      endtimeHours: 18,
      endtimeMinutes: 0,
      endtimeSeconds: 0,
      timeZone: "" 
      // ex:  timeZone: "America/New_York"
      //go to " http://momentjs.com/timezone/ " to get timezone
    });
  </script>
<!--===============================================================================================-->
  <script src="{{asset('assets/front/coming_soon/vendor/tilt/tilt.jquery.min.js')}}"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
<!--===============================================================================================-->
  <script src="{{asset('assets/front/coming_soon/js/main.js')}}"></script>

</body>
</html>