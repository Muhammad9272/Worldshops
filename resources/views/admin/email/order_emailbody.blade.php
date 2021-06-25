<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light dark" />
    <meta name="supported-color-schemes" content="light dark" />
    <title></title>
    <style type="text/css" rel="stylesheet" media="all">
        /* Base ------------------------------ */

        @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
        body {
            width: 100% !important;
            height: 100%;
            margin: 0;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #3869D4;
        }

        a img {
            border: none;
        }

        td {
            word-break: break-word;
        }

        .logo{
            width: 200px;
        }

        .preheader {
            display: none !important;
            visibility: hidden;
            mso-hide: all;
            font-size: 1px;
            line-height: 1px;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
        }
        /* Type ------------------------------ */

        body,
        td,
        th {
            font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
        }

        h1 {
            margin-top: 0;
            color: #333333;
            font-size: 22px;
            font-weight: bold;
            text-align: left;
        }


        h2 {
            margin-top: 0;
            color: #333333;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }

        h3 {
            margin-top: 0;
            color: #333333;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        td,
        th {
            font-size: 16px;
        }

        p,
        ul,
        ol,
        blockquote {
            margin: .4em 0 1.1875em;
            font-size: 16px;
            line-height: 1.625;
        }

        p.sub {
            font-size: 13px;
        }
        /* Utilities ------------------------------ */

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .align-center {
            text-align: center;
        }
        /* Buttons ------------------------------ */

        .button {
            background-color: #3869D4;
            border-top: 10px solid #3869D4;
            border-right: 18px solid #3869D4;
            border-bottom: 10px solid #3869D4;
            border-left: 18px solid #3869D4;
            display: inline-block;
            color: #FFF;
            text-decoration: none;
            border-radius: 3px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
            -webkit-text-size-adjust: none;
            box-sizing: border-box;
        }

        .button--green {
            background-color: #22BC66;
            border-top: 10px solid #22BC66;
            border-right: 18px solid #22BC66;
            border-bottom: 10px solid #22BC66;
            border-left: 18px solid #22BC66;
        }


        .button--black {
            border: none;
            background-color: black;
            color: white;
            border-radius: 50px;
            font-weight: bold;
            box-shadow: none;
            font-size: 14px;
            padding: 7px 20px;
        }

        .button--red {

            border: none;
            background-color: #c61211;
            padding: 10px 36px;
            border-radius: 50px;
            font-size: 22px;
            font-weight: bold;
            box-shadow: none;
        }

        @media (max-width: 767px) {
            .button--red {
                font-size: 18px;
                padding: 13px 36px;
            }
        }

        .button--red:hover,.button--black{
            opacity: 0.8;
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
                text-align: center !important;
            }
        }
        /* Attribute list ------------------------------ */

        .attributes {
            margin: 0 0 21px;
        }

        .attributes_content {
            background-color: #F4F4F7;
            padding: 16px;
        }

        .attributes_item {
            padding: 0;
        }
        /* Related Items ------------------------------ */

        .related {
            width: 100%;
            margin: 0;
            padding: 25px 0 0 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .related_item {
            padding: 10px 0;
            color: #CBCCCF;
            font-size: 15px;
            line-height: 18px;
        }

        .related_item-title {
            display: block;
            margin: .5em 0 0;
        }

        .related_item-thumb {
            display: block;
            padding-bottom: 10px;
        }

        .related_heading {
            border-top: 1px solid #CBCCCF;
            text-align: center;
            padding: 25px 0 10px;
        }
        /* Discount Code ------------------------------ */

        .discount {
            width: 100%;
            margin: 0;
            padding: 24px;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            background-color: #F4F4F7;
            border: 2px dashed #CBCCCF;
        }

        .discount_heading {
            text-align: center;
        }

        .discount_body {
            text-align: center;
            font-size: 15px;
        }
        /* Social Icons ------------------------------ */

        .social {
            width: auto;
        }

        .social td {
            padding: 0;
            width: auto;
        }

        .social_icon {
            height: 20px;
            margin: 0 8px 10px 8px;
            padding: 0;
        }
        /* Data table ------------------------------ */

        .purchase {
            width: 100%;
            margin: 0;
            padding: 35px 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .purchase_content {
            width: 100%;
            margin: 0;
            padding: 25px 0 0 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .purchase_item {
            padding: 10px 0;
            color: #51545E;
            font-size: 15px;
            line-height: 18px;
        }

        .purchase_heading {
            padding-bottom: 8px;
            border-bottom: 1px solid #EAEAEC;
        }

        .purchase_heading p {
            margin: 0;
            color: #85878E;
            font-size: 12px;
        }

        .purchase_footer {
            padding-top: 15px;
            border-top: 1px solid #EAEAEC;
        }

        .purchase_total {
            margin: 0;
            text-align: right;
            font-weight: bold;
            color: #333333;
        }

        .purchase_total--label {
            padding: 0 15px 0 0;
        }

        body {
            background-color: #EFEFEF;
            color: #51545E;
        }

        p {
            color: #51545E;
        }

        .email-wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            background-color: #F2F4F6;
        }

        .email-content {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }
        /* Masthead ----------------------- */

        .email-masthead {
            padding: 25px 0;
            text-align: center;
        }

        .email-masthead_logo {
            width: 94px;
        }

        .email-masthead_name {
            font-size: 16px;
            font-weight: bold;
            color: #A8AAAF;
            text-decoration: none;
            text-shadow: 0 1px 0 white;
        }
        /* Body ------------------------------ */

        .email-body {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .email-body_inner {
            width: 700px;
            margin: 0 auto;
            padding: 0;
            -premailer-width: 570px;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            background-color: #FFFFFF;
        }

        .email-footer {
            width: 570px;
            margin: 0 auto;
            padding: 0;
            -premailer-width: 570px;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            text-align: center;
        }

        .email-footer p {
            color: #51545E;
        }

        .body-action {
            width: 100%;
            margin: 30px auto;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            text-align: center;
        }

        .body-sub {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #EAEAEC;
        }

        .content-cell {
            padding: 45px;
        }
        /*Media Queries ------------------------------ */

        @media only screen and (max-width: 600px) {
            .email-body_inner,
            .email-footer {
                width: 100% !important;
            }
        }

        @media (prefers-color-scheme: dark) {
            body,
            .email-body,
            .email-body_inner,
            .email-content,
            .email-wrapper,
            .email-masthead,
            .email-footer {
                background-color: #333333 !important;
                color: #FFF !important;
            }
            p,
            ul,
            ol,
            blockquote,
            h1,
            h2,
            h3,
            span,
            .purchase_item {
                color: #FFF !important;
            }
            .attributes_content,
            .discount {
                background-color: #222 !important;
            }
            .email-masthead_name {
                text-shadow: none !important;
            }
        }

        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }


        .purchase {
            width: 100%;
            margin: 0;
            padding: 35px 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .purchase_content {
            width: 100%;
            margin: 0;
            padding: 25px 0 0 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .purchase_item {
            padding: 10px 0;
            color: #51545E;
            font-size: 15px;
            line-height: 18px;
        }

        .purchase_heading {
            padding-bottom: 8px;
            border-bottom: 1px solid #EAEAEC;
        }

        .purchase_heading p {
            margin: 0;
            color: black;
            font-size: 14px;
            font-weight: bold;
        }

        .purchase_footer {
            padding-top: 15px;
            border-top: 1px solid #EAEAEC;
        }

        .purchase_total {
            margin: 0;
            text-align: right;
            font-weight: bold;
            color: #333333;
        }

        .purchase_total--label {
            padding: 0 15px 0 0;
        }



        .main-heading{
            color: white;
            margin: 35px 0;
            text-align: center;
        }

        .bg-image{
            background:url({{ asset('assets/images/icons/email/background.png') }});
            background-size: cover;
        }

        .bg-image-2{
            background:url({{ asset('assets/images/icons/email/background_2.png') }});
            background-size: 100% 100%;
        }

        .text-center{
            text-align: center;
        }

        .font-size-13{
            font-size: 13px;
        }
        .grey-link{
            color:#a09d9d;
        }

        .red-link{
            color:#c61211;
        }
        .font-link{
            color:#51545E;
            text-decoration: none;
        }
        .custom-social-icons{
            list-style-type: none;
            padding:0;
            margin:0;
            margin-bottom: 15px;
        }
        .custom-social-icons li{
            display: inline-block;
            margin: 0 3px;
        }

        .custom-social-icons li .social-icon{
            width: 28px;
        }

        .padding-10{
            padding:20px;
        }

        .rider{
            width: 100%;
            text-align: center;
            max-width: 200px;
        }

        .font-big{
            font-size: 40px;
        }

        @media (max-width: 767px) {
            .font-big {
                font-size: 25px;
            }
        }
        .opacity-8{
            opacity: 0.8;
        }

        .no-margin-bottom{
            margin-bottom: 0;
        }
        .no-margin-top{
            margin-top: 0;
        }

        .no-padding-bottom{
            padding-bottom: 0;
        }
        .no-text-decoration{
            text-decoration: none;
        }
        .no-padding-top{
            padding-top: 0;
        }

        .color-red{
            color:#c61211;
        }
        .color-black{
            color:#000;
        }
        .font-bold{
            font-weight: bold;
        }

        .direction .col-1, .direction .col-2, .direction .col-3{
            width: 33%;
        }

        .direction .col-3{
            text-align: right;
        }

        @media (max-width:767px) {
            .direction .col-1, .direction .col-3{
                width: 100%;
                text-align: center;
                display: block;
                margin: auto;
            }
            .direction .col-2{
                display: block;
                width: 100%;
                margin: auto;
                margin-bottom: 30px;
            }
            .direction .col-2 .rider{
                width: 55%;
                max-width: 100%;
            }
        }

        .hands{
            width: 150px;
            margin: auto;
        }

        .promotion .main-content{
            padding: 2px 50px 40px;
            text-align: center;
        }

        .purchase_item .f-fallback{
            font-weight: bold;
        }
        .purchase_sub_item .sub-text{
            margin-left: 20px;
            color:#7e7e7e;
        }
        .tr-spacer{
            height: 20px;
        }

        .purchase_footer .f-fallback{
            font-weight: bold;
            font-size: 18px;
        }

        .text-decoration{
            text-decoration: underline;
        }
    </style>
    <!--[if mso]>
    <style type="text/css">
        .f-fallback  {
            font-family: Arial, sans-serif;
        }
    </style>
    <![endif]-->
</head>
<body>
<span class="preheader">Use this link to reset your password.</span>



<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="email-masthead">
                        <p class="font-size-13 padding-10">World Shop has your order! <a href="" class="grey-link underline">No Images? view it in your browser</a></p>
                        <a href="https://worldshops.co.uk/" class="f-fallback email-masthead_name">
                            <img src="{{asset('assets/images/'.$gs->logo)}}" alt="" class="logo">
                        </a>
                    </td>
                </tr>
                <!-- Email Body -->

                <tr>
                    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <!-- Body content -->

                            <tr>
                                <td class="bg-image">
                                    <h1 class="main-heading font-big no-margin-bottom">We have your Order!</h1>
                                    <h1 class="main-heading opacity-8 no-margin-top">Great Choice, {{ $order->customer_name}}</h1>
                                </td>
                            </tr>

                            <tr>
                                <td class="content-cell">
                                    <div class="f-fallback">

                                        <table class="direction purchase no-padding-top" width="100%" cellpadding="0" cellspacing="0">

                                            <tr>
                                                <td class="col-1">
                                                    <p class="font-size-13"><span class="color-red font-bold">World Shops</span></p>
                                                    <p class="font-size-13 color-black"> 
                                                        <strong>{{  __('Invoice Number')}}</strong><br>
                                                        {{ sprintf("%'.08d", $order->id) }}
                                                        <br>
                                                        <strong>{{ __('Order Date') }}</strong>
                                                        <br>
                                                        {{ date('d-M-Y',strtotime($order->created_at)) }}
                                                        <br>
                                                        <strong>{{ __('Payment Method') }}</strong>
                                                        <br>
                                                         {{$order->method}}
                                                    </p>
                                                </td>
                                                <td class="col-2" align="center">
                                                    <img src="{{asset('assets/images/icons/email/rider.png')}}" alt="" class="rider">
                                                </td>
                                                <td class="col-3">
                                                    <p class=" font-size-13"><span class="color-red font-bold">{{ $order->customer_name}}</span></p>
                                                    <p class="font-size-13 color-black">
                                                        <strong>{{ __('Phone') }}</strong>
                                                        <br>
                                                        {{ $order->customer_phone }}
                                                        <br>
                                                        <strong>{{ __('Email') }}</strong>
                                                        <br>
                                                        {{ $order->customer_email }}
                                                        <br>
                                                        <strong>{{ __('Address') }}</strong>
                                                        
 
                                                     <br>
                                                        {{ $order->customer_address }}, {{ $order->customer_address_1 }}
                                                       </p>
                                                </td>
                                            </tr>


                                        </table>

                                        <h1 class="text-center">
                                            Follow your order straight to your door
                                        </h1>

                                        <!-- Action -->
                                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td align="center">
                                                    <!-- Border based button
                                 https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                                        <tr>
                                                            <td align="center">
                                                                <a href="{{route('user-orders')}}" class="f-fallback button button--red" target="_blank">Track in real time</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                        </table>

                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td class="promotion">
                                    <div class="bg-image-2">

                                        <div class="main-content">

                                            <img src="{{asset('assets/images/icons/email/hands.png')}}" alt="" class="hands">
                                            <h1 class="text-center">Introduce a friend to <a href="" class="red-link no-text-decoration">World shops</a></h1>
                                            <p class="color-black font-size-13 text-center">
                                                Get $10 off across your next 4 orders. <br>
                                                your friend will get $10 off across their first 4 orders, too!
                                            </p>

                                            <a href="" class="f-fallback button button--black" target="_blank">Get 10$ off</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="content-cell">
                                    <table class="purchase" width="100%" cellpadding="0" cellspacing="0">

                                        <tr>
                                            <div align="center">
                                                <h1 class="text-center color-red no-margin-bottom">Here’s your receipt</h1>
                                                <h1 class="text-center color-black no-margin-top">Order ID#{{ $order->order_number }} </h1>
                                            </div>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                                  @php
                                                  $subtotal = 0;
                                                  $tax = 0;
                                                  @endphp
                                                  @foreach($cart->items as $product)
                                                    <tr>
                                                        <td width="60%" class="purchase_item">
                                                        <span class="f-fallback">{{$product['qty']}} {{ $product['item']['measure'] }}X {{$product['item']['name']}}  

                                                        @if($product['size'])
                                                           <strong>{{ __('Size') }} :</strong> {{$product['size']}}
                                                        @endif 
                                                        </span></td>
                                                        <td class="align-right purchase_item" width="40%"><span class="f-fallback">{{$order->currency_sign}}{{ number_format($product['price'] * $order->currency_value , 2) }}</span></td>
                                                    </tr>
                                                @php
                                                 $subtotal += number_format($product['price'] * $order->currency_value, 2);
                                                 @endphp

                                                @endforeach

 

                                                    <tr class="tr-spacer"></tr>
                                                    <tr>
                                                        <td width="60%" class="purchase_item"><span class="f-fallback">Subtotal</span></td>
                                                        <td class="align-right purchase_item" width="40%"><span class="f-fallback">{{$order->currency_sign}}{{ number_format($subtotal, 2) }}</span></td>
                                                    </tr>
                                                    @if($order->shipping_cost != 0)
                                                    <tr>
                                                        <td width="60%" class="purchase_item"><span class="f-fallback">Delivery Charges</span></td>
                                                        <td class="align-right purchase_item" width="40%"><span class="f-fallback">{{$order->currency_sign}}{{ number_format($order->shipping_cost , 2) }}</span></td>
                                                    </tr>
                                                    @endif
                                                     @if($order->tax != 0)

                                                    <tr>
                                                        <td width="60%" class="purchase_item"><span class="f-fallback">Service Charges</span></td>
                                                        <td class="align-right purchase_item" width="40%"><span class="f-fallback">
                                                       @php
                                                     $tax = ($subtotal / 100) * $order->tax;
                                                     @endphp
                                                      {{$order->currency_sign}}{{number_format($tax, 2)}}
                                                        </span></td>
                                                    </tr>
                                                    @endif
                                                    @if($order->coupon_discount != null)

                                                    <tr>
                                                        <td width="60%" class="purchase_item"><span class="f-fallback">{{ __('Coupon Discount') }}</span></td>
                                                        <td class="align-right purchase_item" width="40%"><span class="f-fallback">
                                                            {{$order->currency_sign}}{{number_format($order->coupon_discount, 2)}}
                                                        </span></td>
                                                    </tr>
                                                    @endif

                                                    <tr class="tr-spacer"></tr>

                                                    <tr>
                                                        <td width="60%" class="purchase_footer"><span class="f-fallback">Total</span></td>
                                                        <td class="align-right purchase_footer" width="40%"><span class="f-fallback">{{$order->currency_sign}}{{ number_format($order->pay_amount * $order->currency_value , 2) }}</span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>

                                    <p class="text-center font-size-13 color-red font-bold">Questions about your order?</p>
                                    <p class="text-center font-size-13"> Call the restaurent on +0123456789 <br>
                                        Call your rider when they’re nearby on +0987654321</p>

                                    <p class="text-center font-size-13 color-red font-bold">Anything else we can help you with?</p>
                                    <div class="text-center">
                                        <a href="#" class="text-center font-size-13 font-link text-decoration">Go to Order help</a>
                                    </div>
                                    <!-- Sub copy -->
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="content-cell" align="center">

                                    <p class="text-center font-size-13"><a href="{{route('front.index')}}" class="red-link">{{$gs->title}}</a> is the Multi Vendor Ecommerce website where you can buy all grocery items. </p>

                                    <ul class="custom-social-icons">
                                        @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                        <li>
                                            <a href="{{ App\Models\Socialsetting::find(1)->facebook }}"><img src="{{asset('assets/images/icons/email/facebook.png')}}" alt="" class="social-icon"></a>
                                        </li>
                                        @endif

                                       @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                        <li>
                                            <a href="{{ App\Models\Socialsetting::find(1)->twitter }}"><img src="{{asset('assets/images/icons/email/twitter.png')}}" alt="" class="social-icon"></a>
                                        </li>
                                        @endif

                                       @if(App\Models\Socialsetting::find(1)->i_status == 1)
                                        <li>
                                            <a href="{{ App\Models\Socialsetting::find(1)->instagram }}"><img src="{{asset('assets/images/icons/email/instagram.png')}}" alt="" class="social-icon"></a>
                                        </li>
                                        @endif

                                        @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                        <li>
                                            <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}"><img src="{{asset('assets/images/icons/email/linkedin.png')}}" alt="" class="social-icon"></a>
                                        </li>
                                        @endif
                                    </ul>
                                    <a href="mailto:info@worldshops.co.uk" class="text-center font-size-13 font-link">info@worldshops.co.uk</a>
                                    <p class="text-center font-size-13">{!! $gs->copyright !!}</p>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>