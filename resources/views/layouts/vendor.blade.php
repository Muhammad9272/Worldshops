<!doctype html>
<html lang="en" dir="ltr">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="GeniusOcean">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Title -->
        <title>Vendor Panel - {{$gs->title}}</title>
        <!-- favicon -->
        <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
        <!-- Bootstrap -->
        <link href="{{asset('assets/vendor/css/bootstrap.min.css')}}" rel="stylesheet" />
        <!-- Fontawesome -->
        <link rel="stylesheet" href="{{asset('assets/vendor/css/fontawesome.css')}}">
        <!-- icofont -->
        <link rel="stylesheet" href="{{asset('assets/vendor/css/icofont.min.css')}}">
        <!-- Sidemenu Css -->
        <link href="{{asset('assets/vendor/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/vendor/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />

        <link href="{{asset('assets/vendor/css/plugin.css')}}" rel="stylesheet" />

        <link href="{{asset('assets/vendor/css/jquery.tagit.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap-coloroicker.css') }}">
        <!-- Main Css -->

    @if($langg->rtl == "1")

    <link href="{{asset('assets/vendor/css/rtl/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/css/rtl/custom.css')}}" rel="stylesheet"/>\
    <link href="{{ asset('assets/vendor/css/common.css') }}" rel="stylesheet">
    <link href="{{asset('assets/vendor/css/rtl/responsive.css')}}" rel="stylesheet" />

    @else

    <link href="{{asset('assets/vendor/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/css/custom.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/css/common.css') }}" rel="stylesheet">
    <link href="{{asset('assets/vendor/css/responsive.css')}}" rel="stylesheet" />

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

    .add-btn ,.mr-table .action-list a,.action-list a ,.add-product-content .product-description .body-area .addProductSubmit-btn ,.mr-table .action-list .nice-select .list ,.mr-table .page-item.active .page-link ,.godropdown .go-dropdown-toggle ,.btn.sendEmail ,.special-box .footer-area .mybtn1 ,div.modal button.btn.btn-secondary ,.add-logo-area .submit-btn ,.social-links-area .submit-btn ,.mybtn1{
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
                                    <a id="notf_order" class="dropdown-toggle-1" href="javascript:;">
                                        <i class="icofont-cart"></i>
                                        <span data-href="{{ route('vendor-order-notf-count',Auth::guard('web')->user()->id) }}" id="order-notf-count">{{ App\Models\UserNotification::countOrder(Auth::guard('web')->user()->id) }}</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdownmenu-wrapper" data-href="{{ route('vendor-order-notf-show',Auth::guard('web')->user()->id) }}" id="order-notf-show">
                                        </div>
                                    </div>
                                </li>

                                <li class="login-profile-area">
                                    <a class="dropdown-toggle-1" href="javascript:;">
                                        <div class="user-img">
                                            @if(Auth::user()->is_provider == 1)
                                            <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png') }}" alt="">
                                            @else
                                            <img src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo ):asset('assets/images/noimage.png') }}" alt="">
                                            @endif
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdownmenu-wrapper">
                                            <ul>
                                                <h5>{{ $langg->lang431 }}</h5>

                                                <li>
                                                    <a target="_blank" href="{{ route('front.index') }}"><i class="fas fa-eye"></i> {{ $langg->lang432 }}</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('user-dashboard') }}"><i class="fas fa-sign-in-alt"></i> {{ $langg->lang433 }}</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('vendor-profile') }}"><i class="fas fa-user"></i> {{ $langg->lang434 }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('vendor-password') }}"><i class="fas fa-cog"></i> {{ __('Change Password') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user-logout') }}"><i class="fas fa-power-off"></i> {{ $langg->lang435 }}</a>
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
                            <a target="_blank" href="{{ route('front.index') }}" class="wave-effect active"><i class="fas fa-eye mr-2"></i> {{ $langg->lang440 }}</a>
                        </li>

                        <li>
                            <a href="{{ route('vendor-dashboard') }}" class="wave-effect active"><i class="fa fa-home mr-2"></i>{{ $langg->lang441 }}</a>
                        </li>

                        <li>
                            <a href="#menu5" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-sitemap"></i>{{ __('Manage Categories') }}</a>
                            <ul class="collapse list-unstyled" id="menu5" data-parent="#accordion">
                                <li class="@if( request()->input('type')=='category') active @endif">
                                    <a href="{{ route('vendor-cat-index') }}"><span>{{ __('Main Category') }}</span></a>
                                </li>
                                <li class="@if( request()->input('type')=='subcategory') active @endif">
                                    <a href="{{ route('vendor-subcat-index') }}"><span>{{ __('Sub Category') }}</span></a>
                                </li>
                                <li class="@if( request()->input('type')=='childcategory') active @endif">
                                    <a href="{{ route('vendor-childcat-index') }}"><span>{{ __('Child Category') }}</span></a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="#order" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i>{{ $langg->lang442 }}</a>
                            <ul class="collapse list-unstyled" id="order" data-parent="#accordion">
                                <li>
                                    <a href="{{route('vendor-order-index')}}"> {{ $langg->lang443 }}</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#menu2" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                                <i class="icofont-cart"></i>{{ $langg->lang444 }}
                            </a>
                            <ul class="collapse list-unstyled" id="menu2" data-parent="#accordion">
                                <li>
                                    <a href="{{ route('vendor-prod-physical-create') }}"><span>{{ $langg->lang445 }}</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('vendor-prod-index') }}"><span>{{ $langg->lang446 }}</span></a>
                                </li>
                                
                                <li>
                                    <a href="{{ route('vendor-prodcatwise-index') }}"><span>{{ $langg->lang785 }}</span></a>
                                </li> 
                                <li>
                                    <a href="{{ route('vendor-proddefective-index') }}"><span>Defective Products</span></a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('vendor-coupon-index') }}" class=" wave-effect"><i class="fas fa-percentage"></i>{{ __('Set Coupons') }}</a>
                        </li>

                        {{-- <li>
                            <a href="#affiliateprod" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                                <i class="icofont-cart"></i>{{ $langg->lang447 }}
                            </a>
                            <ul class="collapse list-unstyled" id="affiliateprod" data-parent="#accordion">
                                <li>
                                    <a href="{{ route('vendor-import-create') }}"><span>{{ $langg->lang448 }}</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('vendor-import-index') }}"><span>{{ $langg->lang449 }}</span></a>
                                </li>
                            </ul>
                        </li> --}}


                        <li>
                            <a href="{{ route('vendor-prod-import') }}"><i class="fas fa-upload"></i>{{ $langg->lang450 }}</a>
                        </li>
                        <li>
                            <a href="{{ route('vendor-wt-index') }}" class=" wave-effect"><i class="fas fa-list"></i>{{ $langg->lang451 }}</a>
                        </li>


                    </ul>
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
        var langg    = {!! json_encode($langg) !!};
        var getattrUrl = '{{ route('vendor-prod-getattributes') }}';
        var curr = {!! json_encode($curr) !!};

    </script>

 

        <!-- Dashboard Core -->
        <script src="{{asset('assets/vendor/js/vendors/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset('assets/vendor/js/vendors/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/vendor/js/jqueryui.min.js')}}"></script>
        <!-- Fullside-menu Js-->
        <script src="{{asset('assets/vendor/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/vendor/plugins/fullside-menu/waves.min.js')}}"></script>

        <script src="{{asset('assets/vendor/js/plugin.js')}}"></script>

        <script src="{{asset('assets/vendor/js/Chart.min.js')}}"></script>
        <script src="{{asset('assets/vendor/js/tag-it.js')}}"></script>
        <script src="{{asset('assets/vendor/js/nicEdit.js')}}"></script>
        <script src="{{asset('assets/vendor/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{asset('assets/vendor/js/notify.js') }}"></script>
        <script src="{{asset('assets/vendor/js/load.js')}}"></script>
        <!-- Custom Js-->
        <script src="{{asset('assets/vendor/js/custom.js')}}"></script>
        <!-- AJAX Js-->
        <script src="{{asset('assets/vendor/js/myscript.js')}}"></script>



        
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
