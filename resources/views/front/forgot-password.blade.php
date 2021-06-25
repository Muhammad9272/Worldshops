@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-product" style="min-height: 350px;">
        <div class="container ">
           <div class="row">
             <div class="col-12  d-flex justify-content-center">
              <div class="modal-dialog modal-dialog-centered fg-modal  ls-login-content" >
                <div class="modal-content ">
                  <div class="modal-header forgot-header">
                    <h5 class="modal-title ls-title text-red mb-20 fm-cir" >
                      Forgot Password ?
                    </h5>   
                    <p>Please enter your registered email address below. We will email you a verification code to reset your password.</p> 
             
                  </div>
                  <div class="modal-body ls-content">
                    <div class="ls-login-form">
                      @include('includes.admin.form-login')
                      <form id="forgotform" action="{{route('user-forgot-submit')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="from-group ls-lg-grp">
                          <i class="fa fa-envelope-o"></i>
                          <input type="email" class="form-control ls-lg-form-control" name="email" placeholder="Email Address">
                        </div>

                        {{-- <div class="form-row google-cap ls-lg-grp">
                            <div class="g-recaptcha" data-sitekey="__Site_key__"></div>
                        </div> --}}
                        <input class="fauthdata" type="hidden" value="{{ $langg->lang195 }}">
                        
                        <div class="from-group ls-btn-login">
                          <button class="ws-btn ws-btn-lg submit-btn">Submit</button>
                        </div>
                        
                        <div class="ls-login-footer text-center mt-20">
                          <p> <span class="text-red"><a href="{{route('user.login')}}"  >Back to login</a></span></p>
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
    </div>    



@endsection
@section('pagelevel_scripts')

@endsection
