@extends('front.layouts.app')
@section('pagelevel_css')
@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-product" style="min-height: 350px;">
        <div class="container content-margin">
           <div class="row">
             <div class="col-12 d-flex justify-content-center">
               
              <div class="ls-login-content ls-reg"  >
                <div class="modal-content no-bordr">
                  <div class="modal-header1 mb-20">
                    <h2 class="modal-title text-center mt-30" >
                      Welcome back to
                    </h2>    
                    <div class="ps-logo text-center"><a href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" alt=""></a>
                    </div>                
                  </div>
                  <div class="modal-body ls-content">

                    
                    <div class="ls-login-form signup-form">
                     @include('includes.admin.form-login')
                      <form id="registerform" action="{{route('user-register-submit')}}"
                        method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="col-6 ls-lg-grp pr-5">
                            <i class="icon-user"></i>
                            <input type="text" class="form-control ls-lg-form-control" name="name" placeholder="First Name" required="">
                          </div>
                          <div class="col-6 ls-lg-grp pl-5">
                            <i class="icon-user"></i>
                            <input type="text" class="form-control ls-lg-form-control" name="lname" placeholder="Last Name">
                          </div>                                
                        </div>             
                        <div class="from-group ls-lg-grp">
                          <i class="fa fa-envelope-o"></i>
                          <input type="email" class="form-control ls-lg-form-control" required="" name="email" placeholder="Email">
                        </div>

                        <div class="from-group ls-lg-grp">
                          <i class="fa fa-phone"></i>
                          <input type="text"  class="form-control ls-lg-form-control" required="" name="phone" placeholder="Phone format eg +447244012333 ">
                        </div>
                        
                        <div class="from-group ls-lg-grp">
                          <i class="fa fa-key"></i>
                          <input type="password" class="form-control ls-lg-form-control" required="" name="password" placeholder="Password">
                        </div>


                        <div class="from-group ls-lg-grp">
                          <i class="fa fa-key"></i>
                          <input type="password" class="form-control ls-lg-form-control" name="password_confirmation" placeholder="Confirm Password" required="">
                        </div>
                        <input id="processdata" type="hidden" value="{{ $langg->lang188 }}">

                        <p class="mt-10">By joining us You agree to the our <a href="#" class="ls-link-no-border">User Agreement, </a> <a href="#" class="ls-link-no-border">Privacy Policy,</a> and 
                          <a href="#" class="ls-link-no-border">Cookie Policy</a>.</p>
                        <div class="from-group ls-btn-login">
                          <button class="ws-btn ws-btn-lg submit-btn">Agree & join</button>
                        </div>
                        
                      </form>
                          <p class="text-center text-dark mt-20"><strong>OR</strong></p>
                          @if(App\Models\Socialsetting::find(1)->f_check == 1)
                            <div class="form-group mb-10">
                              <a class="ws-btn-social facebooks" href="{{ route('social-provider','facebook') }}"><i style="width: 45px;" class="fa fa-facebook"></i>Continue with facebook</a>
                            </div>
                          @endif
                          @if(App\Models\Socialsetting::find(1)->g_check == 1)
                          <div class="form-group">
                            <a class="ws-btn-social googles"  href="{{ route('social-provider','google') }}">
                              <span class="pr-10">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg>
                              </span>
                              Continue with Google
                            </a>
                          </div>
                          @endif

                        <div class="ls-login-footer text-center">
                          <p>Already Registered ? <span class="text-red"><a href="{{route('user.login')}}"   >Sign In</a></span></p>
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
@endsection
 