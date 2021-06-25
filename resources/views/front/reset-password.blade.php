@extends('front.layouts.app')
@section('pagelevel_css')

@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-product" style="min-height: 350px;">
        <div class="container ">
           <div class="row">
             <div class="col-12  d-flex justify-content-center">
              <div class="modal-dialog modal-dialog-centered fg-modal  ls-login-content" style="width: 400px;">
                <div class="modal-content ">
                    <div class="modal-header forgot-header">
                      <h5 class="modal-title ls-title text-red mb-20 fm-cir" >
                        Reset Password
                      </h5>   
                      <p>Please enter your new password.</p> 
               
                    </div>
                    <div class="ls-login-form">
                      @include('includes.admin.form-login')
                      <form action="{{route('user-password-rreset-sub')}}" method="post" id="f-reset-password">
                       {{csrf_field()}}
                       <input type="hidden" name="token" value="{{ $token }}">

                        <div class="from-group ls-lg-grp">
                          <i class="fa fa-envelope-o"></i>
                          <input type="email" class="form-control ls-lg-form-control" name="email" placeholder="Email Address" value="{{$email}}" readonly="">
                        </div>

                        <div class="from-group ls-lg-grp">
                          <i class="fa fa-key"></i>
                          <input type="password" class="form-control ls-lg-form-control" name="password" placeholder="Password" required="">
                        </div>
                        <input class="authdata" type="hidden" value="{{ $langg->lang195 }}">

                        <div class="from-group ls-lg-grp">
                          <i class="fa fa-key"></i>
                          <input type="password" class="form-control ls-lg-form-control" name="password_confirmation" placeholder="Confirm Password" required="">
                        </div>

                        
                        <div class="from-group ls-btn-login">
                          <button class="ws-btn ws-btn-lg submit-btn">Reset Password</button>
                        </div>
                        
                      </form>
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

@endsection
