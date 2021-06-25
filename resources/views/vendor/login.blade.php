<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{$gs->title}}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	{{-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> --}}
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/login-form/css/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/custom.css')}}">
<!--===============================================================================================-->
<style type="text/css">
	.container-login100::before{
		    background: -webkit-linear-gradient(left, rgb(97 95 95 / 32%), rgb(101 29 29 / 9%));
    background: -o-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
    background: -moz-linear-gradient(left, rgba(0,168,255,0.5), rgba(185,0,255,0.5));
	}
.ls-login-form .ls-lg-grp i{
	margin-top: 0px;
}

p, a, button, strong, h1, h2, h3, h4, h5 {
    height: 100%;
    font-family: SourceSansPro-Regular, sans-serif;
}

</style>
</head>
<body>
	
	@include('includes.front.modals')
	<div class="container-login100" style="background-image: url('{{asset('assets/images/vlogin.jpg')}}');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30 signin-form">
           
            <form id="loginform"  class="login100-form validate-form" action="{{ route('user.login.submit') }}" method="POST">
              {{ csrf_field() }}

				   <div class="logo" style="width: 200px;">
						<a href="{{ route('front.index') }}">
							<img style="width: 100%" src="{{asset('assets/images/'.$gs->logo)}}" alt="">
						</a>
					</div>
                
				<span class="login100-form-title p-t-15 p-b-15">
					 @include('includes.admin.form-login')
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
					<input class="input100" type="email" name="email" placeholder="Enter username or email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" autocomplete="off" name="password" placeholder="password">
					<span class="focus-input100"></span>
				</div>
                <input type="hidden" name="modal" value="1">
                <input type="hidden" name="vendor" value="1">
                <input id="authdata" type="hidden" value="{{ $langg->lang177 }}">

				<div class="container-login100-form-btn">
					<button class="login100-form-btn submit-btn">
						LOGIN AS STORE
					</button>
				</div>


				<div class="text-center m-t-50">
					
						<span>Not a Member ? <a href="#" class="txt2 hov1">LetsConnect</a><span>
					
				</div>
			</form>

			
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('assets/vendor/login-form/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/vendor/login-form/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/vendor/login-form/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('assets/vendor/login-form/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->

<!--===============================================================================================-->


<!--===============================================================================================-->

    <script type="text/javascript">
      var mainurl = "{{url('/')}}";
      var gs      = {!! json_encode($gs) !!};
      var langg    = {!! json_encode($langg) !!};

    </script>
	<script src="{{asset('assets/vendor/login-form/js/main.js')}}"></script>
	<script src="{{asset('assets/front/js/custom.js')}}"></script>


</body>
</html>