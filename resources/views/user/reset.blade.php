@extends('front.layouts.app')
@section('pagelevel_css')
<style type="text/css">
  .chpasform .ws-chpas{
        margin-bottom: 15px;
    border-radius: 30px;
    background-color: var(--content-bg-color);
    border-color: white;
  }
</style>
@endsection
@section('page_content')
    <div class="ls-content-bg">
      <div class="section-user-dashboard" style="min-height: 350px;">
        <div class="container ls-content-2">
           <div class="row user-orders-pg ">
              <div class="col-xl-4 col-lg-4 col-md-6 pdc-40">
                @include('includes.front.user-dashboard-sidebar')
              </div>
              <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="mt-10 mb-100">
                   <h4>Account Details</h4>
                   <p class="text-dark mb-30">Change Your Password</p>
                  <div class="row">
                    <div class="col-12 ws-card-white">
                       <div class="gocover"
                          style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                      </div>
                      <form id="userform" action="{{route('user-reset-submit')}}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('includes.admin.form-both')
                        <h5 class="mt-20 mb-20">Enter Your Credentials</h5>
                          <div class="row chpasform">
 
                                <div class="col-md-6">
                                  <label  class="col-form-label">Current Password:</label>
                                  <input type="password" placeholder="Enter Current Password" class="form-control ws-chpas" name="cpass" required="">
                                </div>
                                <div class="col-md-6">
                                  <label  class="col-form-label">{{ $langg->lang274 }}:</label>
                                  <input type="password" placeholder="{{ $langg->lang274 }}" class="form-control ws-chpas" name="newpass" required="">
                                </div>
                                <div class="col-md-6">
                                  <label  class="col-form-label">{{ $langg->lang275 }}:</label>
                                  <input type="password" placeholder="{{ $langg->lang275 }}" class="form-control ws-chpas" name="renewpass" required="">
                                </div>

                          </div>      

                        <div class="from-group text-right mt-20">
                          <button class="ws-btn submit-btn ">Update</button>
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
