<!doctype html>
<html lang="en" dir="ltr">

<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="author" content="GeniusOcean">
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Title -->
		<title>Admin Panel - {{$gs->title}}</title>
		<!-- favicon -->
		<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
		<!-- Bootstrap -->
		<link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome.css')}}">
		<!-- icofont -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/icofont.min.css')}}">
		<!-- Sidemenu Css -->
		<link href="{{asset('assets/admin/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />

		<link href="{{asset('assets/admin/css/plugin.css')}}" rel="stylesheet" />

		<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" />
		<link href="{{ asset('assets/admin/img_upload/imgUpload.css') }}" rel="stylesheet" type="text/css" />




    	<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-coloroicker.css') }}">
    	<link href="{{asset('assets/admin/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
		<!-- Main Css -->




		<!-- stylesheet -->
		@if(DB::table('admin_languages')->where('is_default','=',1)->first()->rtl == 1)

		<link href="{{asset('assets/admin/css/rtl/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/rtl/custom.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/rtl/responsive.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/css/common.css')}}" rel="stylesheet" />

		@else

		<link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/css/common.css')}}" rel="stylesheet" />
		@endif

		@yield('styles')

<style type="text/css">
	.menu-toggle-button {
    position: relative;
    font-size: 20px;
    color: #fff;
    margin-left: 200px;
    margin-top: -25px;}
    .header, #sidebar::after ,.sub-categori .modal .modal-dialog .modal-header ,.sub-categori .modal .contact-form .submit-btn{
      background: #1b1c21;
    }
    #sidebar ul > li > ul > li a:hover{
    	  background: #bb1a1ade!important;
    	  color: #ccc5c5;
    }
    #sidebar ul li.active>a{
    	  background: #bb1a1ade!important;
    }

	#sidebar ul > li > ul > li a {
	    color: #ccc5c5;
	}

	.add-btn ,.mr-table .action-list a,.action-list a ,.add-product-content .product-description .body-area .addProductSubmit-btn ,.mr-table .action-list .nice-select .list ,.mr-table .page-item.active .page-link ,.godropdown .go-dropdown-toggle ,.btn.sendEmail ,.special-box .footer-area .mybtn1 ,div.modal button.btn.btn-secondary ,.add-logo-area .submit-btn ,.social-links-area .submit-btn{
	  background-color:#bd2130;
	  border-color: #bd2130;
	}

  .add-product-content .product-description .body-area .addProductSubmit-btn:hover ,.mr-table .action-list .nice-select .list :hover ,.btn.sendEmail:hover ,.special-box .footer-area .mybtn1:hover ,div.modal button.btn.btn-secondary:hover ,.add-logo-area .submit-btn:hover ,.social-links-area .submit-btn:hover{
	  background-color:#d41413;
	  border-color: #d41413;
	}


	.mr-table .action-list .nice-select .option.focus, .mr-table .action-list .nice-select .option.selected.focus, .mr-table .action-list .nice-select .option:hover{
         background-color: #7d201c
	}
	.mr-table .action-list .edit {
		background-color: #3598dc;
	}
	.mr-table .godropdown  .action-list{
        background-color: white;
	}
    .mr-table .godropdown  .action-list a ,.mr-table .godropdown  .action-list .edit{
        background-color: white;
	}
	.mr-table .godropdown  .action-list a:hover{
		background-color: #ccc5c5;
	}
	.social-links-area input:checked + .slider ,.body-area input:checked + .slider{
		background-color: #3598dc;
	}

    
</style>

	</head>
	<body>
		<div class="page">
			<div class="page-main">
				<!-- Header Menu Area Start -->
				<div class="header">
					<div class="container-fluid">
						<div class="d-flex justify-content-between">
							<div>
								<div class="ps-logo"><a href="{{route('front.index')}}"><img style="   width: 200px; margin-top: 12px;" src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
							   </div>
	                            <div class="menu-toggle-button">
									<a class="nav-link" href="javascript:;" id="sidebarCollapse">
										<div class="my-toggl-icon">
												<span class="bar1"></span>
												<span class="bar2"></span>
												<span class="bar3"></span>
										</div>
									</a>
								</div>


							</div>
							

							<div class="right-eliment">
								<ul class="list">

									<li class="bell-area">
									<a id="notf_conv" class="dropdown-toggle-1" target="_blank" href="{{ route('front.index') }}">
										<i class="fas fa-globe-americas"></i>
										</a>

									</li>

									<li class="bell-area">
										<a id="notf_user" class="dropdown-toggle-1" href="javascript:;">
											<i class="far fa-user"></i>
											<span data-href="{{ route('user-notf-count') }}" id="user-notf-count">{{ App\Models\Notification::countRegistration() }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('user-notf-show') }}" id="user-notf-show">
										</div>
										</div>
									</li>

									<li class="bell-area">
										<a id="notf_order" class="dropdown-toggle-1" href="javascript:;">
											<i class="far fa-newspaper"></i>
											<span data-href="{{ route('order-notf-count') }}" id="order-notf-count">{{ App\Models\Notification::countOrder() }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('order-notf-show') }}" id="order-notf-show">
										</div>
										</div>
									</li>

									<li class="login-profile-area">
										<a class="dropdown-toggle-1" href="javascript:;">
											<div class="user-img">
												<img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/admins/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
											</div>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper">
													<ul>
														<h5>{{ __('Welcome!') }}</h5>
															<li>
																<a href="{{ route('admin.profile') }}"><i class="fas fa-user"></i> {{ __('Edit Profile') }}</a>
															</li>
															<li>
																<a href="{{ route('admin.password') }}"><i class="fas fa-cog"></i> {{ __('Change Password') }}</a>
															</li>
															<li>
																<a href="{{ route('admin.logout') }}"><i class="fas fa-power-off"></i> {{ __('Logout') }}</a>
															</li>
														</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Header Menu Area End -->
				<div class="wrapper">
					<!-- Side Menu Area Start -->
					<nav id="sidebar" class="nav-sidebar">
						<ul class="list-unstyled components" id="accordion">
							<li>
								<a href="{{ route('admin.dashboard') }}" class="wave-effect active"><i class="fa fa-home mr-2"></i>{{ __('Dashboard') }}</a>
							</li>
							@if(Auth::guard('admin')->user()->IsSuper())
							@include('includes.admin.roles.super')
							@else
							@include('includes.admin.roles.normal')
							@endif

						</ul>
					{{-- @if(Auth::guard('admin')->user()->IsSuper())
					<p class="version-name"> Version: 1.7.1</p>
					@endif --}}
					</nav>
					<!-- Main Content Area Start -->
					@yield('content')
					<!-- Main Content Area End -->
					</div>
				</div>
			</div>

			@php
				$curr = \App\Models\Currency::where('is_default','=',1)->first();
			@endphp
			<script type="text/javascript">
			  var mainurl = "{{url('/')}}";
			  var admin_loader = {{ $gs->is_admin_loader }};
			  var whole_sell = {{ $gs->wholesell }};
				var getattrUrl = '{{ route('admin-prod-getattributes') }}';
				var curr = {!! json_encode($curr) !!};
				// console.log(curr);
			</script>

		<!-- Dashboard Core -->
		<script src="{{asset('assets/admin/js/vendors/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/vendors/vue.js')}}"></script>
		<script src="{{asset('assets/admin/js/vendors/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>
		<!-- Fullside-menu Js-->
		<script src="{{asset('assets/admin/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>






		<script src="{{asset('assets/admin/plugins/fullside-menu/waves.min.js')}}"></script>

		<script src="{{asset('assets/admin/js/plugin.js')}}"></script>
		<script src="{{asset('assets/admin/js/Chart.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/tag-it.js')}}"></script>
		<script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
        <script src="{{asset('assets/admin/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{asset('assets/admin/js/notify.js') }}"></script>

        <script src="{{asset('assets/admin/js/jquery.canvasjs.min.js')}}"></script>

		<script src="{{asset('assets/admin/js/load.js')}}"></script>
		<!-- Custom Js-->
		<script src="{{asset('assets/admin/js/custom.js')}}"></script>
		<!-- AJAX Js-->
		<script src="{{asset('assets/admin/js/myscript.js')}}"></script>

        <script src="{{ asset('assets/admin/img_upload/imgUpload.js') }}" type="text/javascript"></script>

        <script src="{{asset('assets/admin/bootstrap-summernote/summernote.min.js')}}" type="text/javascript"></script>

        {{-- <script type="text/javascript">
        	$('.summernote').summernote();
        </script> --}}
		@yield('scripts')

@if($gs->is_admin_loader == 0)
<style>
	div#geniustable_processing {
		display: none !important;
	}
</style>
@endif

	</body>

</html>
